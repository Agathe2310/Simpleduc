<?php

function loginController($twig, $db)
{
    var_dump(" / POST : ");
    var_dump($_POST);
    $user = 0;
    if (isset($_POST['submitLogin'])) {
        if (isset($_POST['usernameLogin']) && isset($_POST['passwordLogin'])) {
            $email = $_POST['emailLogin'];
            $password = $_POST['passwordLogin'];

            $user = testOneUser($db, $email, $password);

            if ($user != null) {
                $_SESSION['login'] = $email;
            } else {
                
            }

        }
    }

    echo $twig->render('login.html.twig', [$user]);
}
