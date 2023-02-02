<?php

function lireMessageController($twig, $db, $nbNotifs)
{
    include_once '../src/model/ProjetModel.php';  ##on inclut pour apres
    include_once '../src/model/MessagerieModel.php';  ##on inclut pour apres
    $messages = getMessageFromDest($db, $_SESSION['iduser']);

    if (isset($_GET['id'])) {
        $idMessage = $_GET['id'];

        for ($i = 0; $i < count($messages); $i++) {
            $messages[$i]['Emetteur'] = getOneUserFromID($db, $messages[$i]['Emetteur']);
        }

        $message = getMessageFromID($db, $idMessage);
        $message['Emetteur'] = getOneUserFromID($db, $message['Emetteur']);

        if (isset($_GET['lire'])) setMessageLu($db, $idMessage, 1);

        echo $twig->render("lireMessage.html.twig", [
            'message' => $message, 'nbNotifs' => $nbNotifs
        ]);
    } else {
        echo $twig->render("messagerie.html.twig", [
            'nbNotifs' => $nbNotifs
        ]);
    }
}
