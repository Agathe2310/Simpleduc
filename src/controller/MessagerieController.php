<?php

function messagerieController($twig, $db)
{
    include_once '../src/model/ProjetModel.php';  ##on inclut pour apres
    include_once '../src/model/MessagerieModel.php';  ##on inclut pour apres

    $messages = getMessageFromDest($db, $_SESSION['idUser']);

    echo $twig->render("messagerie.html.twig", [
        'messages' => $messages
    ]);
}