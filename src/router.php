<?php

function initRouter($routes, $db)
{
    //if (isset($_SESSION['username']) || (isset($_GET['page']) && $_GET['page'] == 'register')) {
    //Si la variable page existe donc dans l'url on a mis ?page=truc alors $page devient ?page
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else $page = "home";

    //Si page est dans le tableau des routes alors $route devient la route (homeController)
    if (isset($routes[$page])) {
        $route = $routes[$page];
    } else {
        $route = $routes["home"];
    }

    if ($db == null) {
        $route = $routes["dbError"];
    }

    //test de si l'utilisateur a acces à la page
    $routeParameters = explode(':', $route);
    $controller = ucfirst($routeParameters[0]);
    $access = $routeParameters[1] ?? 0;
    if ($access != 0) {
        if (!isset($_SESSION['login']) || $_SESSION['role'] < $access) {
            $controller = "HomeController";
        }
    }


    //Require le fichier controller HomeController.php
    require_once 'controller/' . $controller . '.php';
    return $controller;
    /*
    } else {
        $route = $routes['login'];

        if ($db == null) {
            $route = $routes["dbError"];
        }

        $controller = ucfirst($route);

        require_once 'controller/' . $controller . '.php';
        return $controller;
    }*/
}
