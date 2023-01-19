<?php

function loginController($twig, $db)
{
    include_once '../src/model/ProjetModel.php';

    var_dump(" / POST : ");
    var_dump($_POST);
    $user = 1;
    if (isset($_POST['submitLogin'])) {
        if (isset($_POST['emailLogin']) && isset($_POST['passwordLogin'])) {

            $email = $_POST['emailLogin'];
            $password = $_POST['passwordLogin'];

            $user = testOneUser($db, $email, $password);

            if ($user != null) {
                $_SESSION['login'] = $email;
                $user = "connecte";
            } else {
                $user = "faux";
            }

        }
    }

    echo $twig->render('login.html.twig', ['user' => $user]);
}
