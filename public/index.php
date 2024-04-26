<?php

require_once '../vendor/autoload.php';
require_once '../config/routes.php';
require_once '../config/config.php';
require_once '../src/router.php';
require_once '../src/twig.php';
require_once '../src/database.php';
require_once '../src/model/MailModel.php';
include_once '../src/model/MessagerieModel.php';  ##on inclut pour apres

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();


if (isset($_SESSION['deconnexion'])) {
    session_destroy();
    session_start();
}


$db = getConnection($config);

$twig = initTwig('../template/');

$nbNotifs = 0;
if (isset($_SESSION['iduser'])) $nbNotifs = count(getMessagesNonLu($db, $_SESSION['iduser']));

$actionController = initRouter($routes, $db);
$actionController($twig, $db, $nbNotifs);
