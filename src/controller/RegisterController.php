<?php

function registerController($twig, $db)
{
    include_once '../src/model/ProjetModel.php';

    $erreur = 0;

    if (isset($_POST['registerBtn'])) {
        if (
            isset($_POST['registerEmail']) && isset($_POST['registerPassword'])  &&
            isset($_POST['registerNom']) && isset($_POST['registerPrenom'])  &&
            $_POST['registerEmail'] != "" && $_POST['registerPassword'] != "" &&
            $_POST['registerNom'] != "" && $_POST['registerPrenom'] != ""
        ) {
            var_dump($_POST);

            $email = $_POST['registerEmail'];
            $password = $_POST['registerPassword'];
            $nom = $_POST['registerNom'];
            $prenom = $_POST['registerPrenom'];

            if (!testEmailExists($db, $email)) {
                addPersonneComplet($db, $nom, $prenom, $email, password_hash($password, PASSWORD_DEFAULT));
                $erreur = "compte cree";
            } else $erreur = "existe deja";
        } else $erreur = "remplir champs";
    }

    echo $twig->render('register.html.twig', ['erreur' => $erreur]);
}
