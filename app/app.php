<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Type.php";
    require_once __DIR__."/../src/Pokemon.php";

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
        return $app['twig']->render('index.html.twig', array('types'=>Type::getAll(), 'pokemon'=>Pokemon::getALl()));
    });
