<?php

require_once '../vendor/autoload.php';
require_once '../config/routes.php';
require_once '../config/config.php';
require_once '../src/router.php';
require_once '../src/twig.php';
require_once '../src/database.php';
require_once '../src/model/MailModel.php';
include_once '../src/model/MessagerieModel.php';  ##on inclut pour apres


session_start();


if (isset($_SESSION['deconnexion'])) {
    session_destroy();
    session_start();
}


$db = getConnection($config);

$twig = initTwig('../template/');

$nbNotifs = 0;
if (isset($_SESSION['idUser'])) $nbNotifs = count(getMessagesNonLu($db, $_SESSION['idUser']));

$actionController = initRouter($routes, $db);
$actionController($twig, $db, $nbNotifs);
