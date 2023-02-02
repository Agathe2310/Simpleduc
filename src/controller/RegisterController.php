<?php

use PHPMailer\PHPMailer\PHPMailer;

function registerController($twig, $db, $nbNotifs)
{

    include_once '../src/model/ProjetModel.php';
    include_once '../src/model/MailModel.php';

    $erreur = 0;

    if (isset($_POST['registerBtn'])) {
        if (
            isset($_POST['registerEmail']) && isset($_POST['registerPassword'])  &&
            isset($_POST['registerNom']) && isset($_POST['registerPrenom'])  &&
            $_POST['registerEmail'] != "" && $_POST['registerPassword'] != "" &&
            $_POST['registerNom'] != "" && $_POST['registerPrenom'] != ""
        ) {
            if (strlen($_POST['registerPassword']) >= 3) {

                $email = $_POST['registerEmail'];
                $password = $_POST['registerPassword'];
                $nom = $_POST['registerNom'];
                $prenom = $_POST['registerPrenom'];

                if (!testEmailExists($db, $email)) {
                    addPersonneComplet($db, $nom, $prenom, $email, password_hash($password, PASSWORD_DEFAULT));
                    $erreur = "compte cree";

                    $idUser = getOneUser($db, $email)['IDPersonne'];

                    envoyerVerification($db, $twig, $idUser, $email);
                    
                } else $erreur = "existe deja";
            } else $erreur = "mdp trop court";
        } else $erreur = "remplir champs";
    }

    echo $twig->render('register.html.twig', ['erreur' => $erreur]);
}
