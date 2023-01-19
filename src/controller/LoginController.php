<?php

function loginController($twig, $db)
{
    include_once '../src/model/ProjetModel.php';

    var_dump(" / POST : ");
    var_dump($_POST);
    var_dump(password_hash("yyy", PASSWORD_DEFAULT));
    $user = 1;
    if (isset($_POST['submitLogin'])) {
        if (isset($_POST['emailLogin']) && isset($_POST['passwordLogin']) && 
        $_POST['emailLogin'] != "" && $_POST['passwordLogin'] != "" ) {

            $email = $_POST['emailLogin'];
            $password = $_POST['passwordLogin'];


            $user = getOneUser($db, $email);

            if ($user != null) {

                if (password_verify($password, $user['PasswordUser'])) {
                    $_SESSION['login'] = $email;
                    $user = "connecte";
                    header("Location: index.php");
                } else $user = "faux";
            } else $user = "faux";
        } else $user = "remplir champs";
    }

    echo $twig->render('login.html.twig', ['user' => $user]);
}
