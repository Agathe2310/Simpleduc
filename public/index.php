<?php

require_once '../vendor/autoload.php';
require_once '../config/routes.php';
require_once '../config/config.php';
require_once '../src/router.php';
require_once '../src/twig.php';
require_once '../src/database.php';

session_start();

$_SESSION['username'] = "Le futur username mis par agathe et antoine";

var_dump("Session :");
var_dump($_SESSION);

$db = getConnection($config);

$twig = initTwig('../template/');

$actionController = initRouter($routes, $db);
$actionController($twig, $db);