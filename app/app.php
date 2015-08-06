<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cd.php";

    session_start();
    //constructing home library
    $first_cd = new CD("Master of Reality", "Black Sabbath", "images/reality.jpg", 10.99);
    $second_cd = new CD("Electric Ladyland", "Jimi Hendrix", "images/ladyland.jpg", 10.99);
    $third_cd = new CD("Nevermind", "Nirvana", "images/nevermind.jpg", 10.99);
    $fourth_cd = new CD("I don't get it", "Pork Lion", "images/porklion.jpg", 49.99);

    //checking for empty array
    if (empty($_SESSION['all_albums']))
    {
        $_SESSION['all_albums'] = array($first_cd, $second_cd, $third_cd, $fourth_cd);
    }

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {

        return $app['twig']->render('albums.html.twig', array('albums' => CD::getAll()));
    });

    //$app->get("/")

    return $app;
?>
