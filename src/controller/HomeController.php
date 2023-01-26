<?php

function homeController($twig, $db)
{
    include_once '../src/model/ProjetModel.php';  ##on inclut pour apres

    $role = 0;

    if (isset($_SESSION['role'])) $role = $_SESSION['role'];

    $role = getOneRole($db, $role)['Label'];
    $infos = getOneUser($db, $_SESSION['login']);

    echo $twig->render('home.html.twig', [
        'role' => $role,
        'date' =>  date('Y-m-d H:i:s'),
        'infos' => $infos
    ]);
}
