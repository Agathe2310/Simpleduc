<?php

function confirmRegisterController($twig, $db)
{
    include_once '../src/model/ProjetModel.php';
    include_once '../src/model/MailModel.php';

    $message = 0;

    if (isset($_GET['idRegister'])) {
        $idRegister = $_GET['idRegister'];

        $confCompte = getConfirmationCompte($db, $idRegister);

        if ($confCompte == false) {
            $message = "Identifiant éroné";
        } else {
            if (verifyDateConfirmation($confCompte['dateConf'])) {

                confirmerCompte($db, $confCompte['IDPersonne']);
                $message = "Votre compte a été vérifié !";
            } else {
                $message = "Votre identifiant de vérification est expiré !";
                $user = getOneUserFromID($db, $confCompte['IDPersonne']);
                delConfirmation($db, $confCompte['IDPersonne']);
                var_dump($user);
                envoyerVerification($db, $twig, 
                $user['IDPersonne'], $user['Email']);
            }
        }
    } else {
        $message = "Pas d'identifiant à vérifier";
    }

    echo $twig->render("confirmRegister.html.twig", ['message' => $message]);
}
