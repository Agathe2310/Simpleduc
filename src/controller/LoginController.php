<?php

function loginController($twig, $db, $nbNotifs)
{
    include_once '../src/model/ProjetModel.php';

    $user = 1;
    if (isset($_POST['submitLogin'])) {
        if (
            isset($_POST['emailLogin']) && isset($_POST['passwordLogin']) &&
            $_POST['emailLogin'] != "" && $_POST['passwordLogin'] != ""
        ) {

            $email = $_POST['emailLogin'];
            $password = $_POST['passwordLogin'];


            $user = getOneUser($db, $email);

            if ($user != null) {

                if (password_verify($password, $user['PasswordUser'])) {
                    if ($user['CompteVerifie'] == 1) {
                        $_SESSION['login'] = $email;
                        $_SESSION['role'] = $user['idRole'];
                        $_SESSION['iduser'] = $user['IDPersonne'];
                        $user = "connecte";
                        header("Location: index.php");
                    } else $user = "pas verifie";
                } else $user = "faux";
            } else $user = "faux";
        } else $user = "remplir champs";
    }

    echo $twig->render('login.html.twig', ['user' => $user]);
}