<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Type.php";
    require_once __DIR__."/../src/Pokemon.php";
    require_once __DIR__."/../src/User.php";

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
        return $app['twig']->render('index.html.twig', array('types'=>Type::getAll(), 'pokemons'=>Pokemon::getALl()));
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
        return $app['twig']->render('onepokemon.html.twig', array('pokemon'=>$pokemon, 'types'=>Type::getAll(), 'pokemons'=>Pokemon::getAll()));
    });

    return $app;
?>
