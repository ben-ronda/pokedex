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
        $user = User::findUserById($id);
        return $app['twig']->render('onepokemon.html.twig', array('pokemon'=>$pokemon, 'types'=>Type::getAll(), 'pokemons'=>Pokemon::getAll(), 'user' => $user));
    });

    $app->get("/user/{id}", function($id) use ($app)
    {
        $user = User::findUserById($id);
        return $app['twig']->render('profile.html.twig', array('pokemon'=>$pokemon, 'types'=>Type::getAll(), 'pokemons'=>Pokemon::getAll()));
    });

    // $app->post("{id}/addPokemon", function($id) use ($app) {
    //     $pokemon = Pokemon::findPokemon($_POST['pokemon_id']);
    //     // $user = User::findUserById($_POST['user_id']);
    //     $user->addPokemon($pokemon);
    //     return $app['twig']->render('profile.html.twig', array('user' => $user, 'users' => User::getAll(), 'pokemons'=>$user->getPokemons(), 'all_pokemons'=> Pokemon::getAll()));
    // });

    $app->get("/pokemon_all", function() use ($app)
    {
        return $app['twig']->render('pokemon.html.twig', array('pokemons'=>Pokemon::getAll()));
    });


    ////////User UI//////////
    $app->post("/register", function() use ($app)
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $users = User::getAll();
        foreach($users as $user) {
            if($username == $user->getUsername()) {
              return $app['twig']->render('home.html.twig', array('alert_register'=>true, 'alert_login'=>false, 'failed_register' => 'That username already exists. Please choose another.'));
            }
        }
        $new_user = new User($username, $password);
        $new_user->save();
        return $app['twig']->render('profile.html.twig', array('username' => $new_user->getUsername(), 'pokemons' => $new_user->getPokemon()));
    });

    $app->post("/login", function() use ($app) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $users = User::getAll();
        foreach($users as $user) {
            if(($username == $user->getUsername()) && ($password == $user->getPassword())) {
              $_SESSION['user']['username'] = $user->getUsername();
              $_SESSION['user']['id'] = $user->getId();
              return $app['twig']->render('profile.html.twig', array('username' => $user->getUsername(), 'pokemons' => $user->getPokemon()));
            }
        }
        return $app['twig']->render('home.html.twig', array('alert_login'=>true, 'failed_login' => 'You used LOGIN! It is not very effective... Please try again.', 'alert_register'=>false));
    });

    $app->post("/logout", function() use ($app) {
        $_SESSION['user'] = array('username'=> null, 'password'=> null);
        return $app['twig']->render('home.html.twig', array('alert_register' => false, 'alert_login' => false));
    });

    return $app;
?>
