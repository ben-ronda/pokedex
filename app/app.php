<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Type.php";
    require_once __DIR__."/../src/Pokemon.php";
    require_once __DIR__."/../src/User.php";

    session_start();
    if (empty($_SESSION['user'])) {
          $_SESSION['user'] = array('username' => null, 'password' => null, 'id' => null);
    }

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=pokedex';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app['debug'] = true;

    $app->get("/", function() use ($app)
    {
        return $app['twig']->render('home.html.twig', array('types'=>Type::getAll(), 'pokemons'=>Pokemon::getALl(), 'alert_register'=>false, 'alert_login'=>false));
    });

    $app->get("/types", function() use ($app)
    {
        return $app['twig']->render('type.html.twig', array('types'=>Type::getAll()));
    });

    $app->get("/type/{id}", function($id) use ($app)
    {
        $type = Type::findTypeById($id);
        return $app['twig']->render('onetype.html.twig', array('type' => $type, 'types'=>Type::getAll(), 'pokemons'=>Pokemon::getAll()));
    });

    $app->get("/pokemon/{id}", function($id) use ($app)
    {
        $pokemon = Pokemon::findPokemon($id);
        $parentPokemon = $pokemon->getParentPokemon();
        return $app['twig']->render('onepokemon.html.twig', array('pokemon'=>$pokemon, 'parentPokemon'=>$parentPokemon, 'types'=>Type::getAll(), 'pokemons'=>Pokemon::getAll()));
    });

    $app->post("{id}/addPokemon", function($id) use ($app)
    {
        $pokemon = Pokemon::findPokemon($_POST['pokemon_id']);
        $user = User::findUserById($_POST['user_id']);
        $user->addPokemon($pokemon);
        return $app['twig']->render('profile.html.twig', array('user' => $user, 'users' => User::getAll(), 'pokemons'=>$user->getPokemons(), 'all_pokemons'=> Pokemon::getAll()));
    });

    $app->get("/pokemon_all", function() use ($app)
    {
        if(isset($_GET['search'])){
            $pokemon = Pokemon::searchName($_GET['search']);
        } else {
            $pokemon = Pokemon::getAll();
        }
        return $app['twig']->render('pokemon.html.twig', array('pokemons'=>$pokemon));
    });


    ////////User UI//////////
    $app->post("/register", function() use ($app)
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $users = User::getAll();
        foreach($users as $user) {
            if($username == $user->getUsername()) {
              return $app['twig']->render('home.html.twig', array('alert_register'=>true, 'alert_login'=>false, 'user' => $user, 'failed_register' => 'That username already exists. Please choose another.'));
            }
        }
        $new_user = new User($username, $password);
        $new_user->save();
        return $app['twig']->render('profile.html.twig', array('username' => $new_user->getUsername(), 'user' => $new_user, 'pokemons' => $new_user->getPokemon(), 'all_pokemons' => Pokemon::getAll()));
    });

    $app->post("/login", function() use ($app)
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $users = User::getAll();
        $all_pokemons = Pokemon::getAll();
        foreach($users as $user) {
            if(($username == $user->getUsername()) && ($password == $user->getPassword())) {
              $_SESSION['user']['username'] = $user->getUsername();
              $_SESSION['user']['id'] = $user->getId();
              return $app['twig']->render('profile.html.twig', array('username' => $user->getUsername(), 'pokemons' => $user->getPokemon(), 'user' => $user, 'all_pokemons' => $all_pokemons));
            }
        }
        return $app['twig']->render('home.html.twig', array('alert_login'=>true, 'failed_login' => 'You used LOGIN! It is not very effective... Please try again.', 'alert_register'=>false));
    });

    $app->post("/logout", function() use ($app)
    {
        $_SESSION['user'] = array('username'=> null, 'password'=> null);
        return $app['twig']->render('home.html.twig', array('alert_register' => false, 'alert_login' => false));
    });

    $app->get("/user", function() use ($app)
    {
        if($_SESSION['user']['id'] !== null) {
            $id = $_SESSION['user']['id'];
            $user = User::findUserById($id);
            $pokemon = $user->getPokemon();
                if (empty($pokemon)){
                    $all_pokemons = Pokemon::getAll();
                }
                else{
                    $all_pokemons = Pokemon::getAllBut(array_map(function($onepoke){return $onepoke->getId();},$pokemon));
                }
                return $app['twig']->render('profile.html.twig', array('pokemons'=>$pokemon, 'types'=>Type::getAll(), 'all_pokemons'=>$all_pokemons, 'user' => $user));
        } else {
            return $app['twig']->render('home.html.twig', array('types'=>Type::getAll(), 'pokemons'=>Pokemon::getALl(), 'alert_register'=>false, 'alert_login'=>false));
        }
    });

    ////////Add pokemon to user////////////
    $app->post("/add_pokemon", function() use ($app) {
        $user = User::findUserById($_POST['user_id']);
        $pokemon = Pokemon::findPokemon($_POST['pokemon_id']);
        $user->addPokemon($pokemon);
        if (empty($user->getPokemon())){
            $all_pokemons = Pokemon::getAll();
        }
        else{
            $all_pokemons = Pokemon::getAllBut(array_map(function($onepoke){return $onepoke->getId();},$user->getPokemon()));
        }
        return $app['twig']->render('profile.html.twig', array('username' => $user->getUsername(), 'pokemons' => $user->getPokemon(), 'user' => $user, 'all_pokemons' => $all_pokemons));
    });

    $app->delete("/delete_pokemon", function() use ($app) {
        $user = User::findUserById($_POST['user_id']);
        $pokemon = Pokemon::findPokemon($_POST['pokemon_id']);
        $user->deletePokemon($pokemon);
        if (empty($user->getPokemon())){
            $all_pokemons = Pokemon::getAll();
        }
        else{
            $all_pokemons = Pokemon::getAllBut(array_map(function($onepoke){return $onepoke->getId();},$user->getPokemon()));
        }
        return $app['twig']->render('profile.html.twig', array('username' => $user->getUsername(), 'pokemons' => $user->getPokemon(), 'user' => $user, 'all_pokemons' => $all_pokemons));
    });

    return $app;
?>
