<?php

function creerMessageController($twig, $db, $nbNotifs)
{
    include_once '../src/model/ProjetModel.php';  ##on inclut pour apres
    include_once '../src/model/MessagerieModel.php';  ##on inclut pour apres

    $users = listePersonnes($db);

    var_dump("POST : ");
    var_dump($_POST);

    if (isset($_POST['btnEnvoyerMessage'])) {
        if ($_POST['Objet'] != "" && $_POST['Message'] != "" && $_POST['Destinataire'] != "0") {
            addMessage(
                $db,
                $_SESSION['idUser'],
                $_POST['Destinataire'],
                $_POST['Objet'],
                $_POST['Message']
            );
        }
    }

    echo $twig->render("creerMessage.html.twig", [
        'nbNotifs' => $nbNotifs,
        'users' => $users
    ]);
}
