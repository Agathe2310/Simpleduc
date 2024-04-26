<?php

function messagerieController($twig, $db, $nbNotifs)
{
    include_once '../src/model/ProjetModel.php';  ##on inclut pour apres
    include_once '../src/model/MessagerieModel.php';  ##on inclut pour apres

    if ((isset($_POST["btnNonLu"]) || isset($_POST["btnLu"]) || isset($_POST["btnSupp"])) && isset($_POST['selectionne'])) {
        $selection = $_POST["selectionne"];

        if (isset($_POST["btnNonLu"])) {
            foreach ($selection as $message) {
                setMessageLu($db, $message, 0);
            }
        }
        if (isset($_POST["btnLu"])) {
            foreach ($selection as $message) {
                setMessageLu($db, $message, 1);
            }
        }
        if (isset($_POST["btnSupp"])) {
            foreach ($selection as $message) {
                suppMessage($db, $message);
            }
        }
    }

    $messages = getMessageFromDest($db, $_SESSION['iduser']);


    for ($i = 0; $i < count($messages); $i++) {
        $messages[$i]['Emetteur'] = getOneUserFromID($db, $messages[$i]['Emetteur']);
    }

    echo $twig->render("messagerie.html.twig", [
        'messages' => $messages,
        'nbNotifs' => $nbNotifs,
        'messagesEnvoyes' => getMessageFromEmet($db, $_SESSION['iduser'])
    ]);
}
