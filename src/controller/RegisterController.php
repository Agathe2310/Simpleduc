<?php

use PHPMailer\PHPMailer\PHPMailer;

function registerController($twig, $db)
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
                var_dump($_POST);

                $email = $_POST['registerEmail'];
                $password = $_POST['registerPassword'];
                $nom = $_POST['registerNom'];
                $prenom = $_POST['registerPrenom'];

                if (!testEmailExists($db, $email)) {
                    addPersonneComplet($db, $nom, $prenom, $email, password_hash($password, PASSWORD_DEFAULT));
                    $erreur = "compte cree";

                    $idUser = getOneUser($db, $email)['IDPersonne'];

                    $mail2 = new Mail();

                    //Création vérif
                    $idRegister = addConfirmationCompte($db, $idUser);
                    var_dump("ID REGISTER :");
                    var_dump($idRegister);

                    //Envoyer mail
                    if ($idRegister != null) {
                        $mail2->envoyerMailer(
                            $email,
                            "Confirmer le compte PHP",
                            $twig->render("mail/register_message.html.twig", [
                                'email' => $email,
                                'idRegister' => $idRegister
                            ]),
                            null
                        );
                    }
                } else $erreur = "existe deja";
            } else $erreur = "mdp trop court";
        } else $erreur = "remplir champs";
    }

    echo $twig->render('register.html.twig', ['erreur' => $erreur]);
}
