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
            if (true) {
                confirmerCompte($db, $confCompte['IDPersonne']);
                $message = "Votre compte a été vérifié !";
            }
        }
    } else {
        $message = "Pas d'identifiant à vérifier";
    }

    echo $twig->render("confirmRegister.html.twig", ['message' => $message]);
}
