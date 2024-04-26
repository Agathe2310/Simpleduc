<?php
function ModificationMdpController($twig, $db){
    include_once '../src/model/ProjetModel.php';

    $msg = "";

    if (isset($_GET["email"])) {
        $email = $_GET["email"];
    }
    if (isset($_POST['btnModMdp'])) {
        if (password_verify($_POST['AncienMdp'], getOneUser($db, $email)['PasswordUser']))
        {
           updateMdp($db, $email, password_hash($_POST['NouveauMdp'], PASSWORD_DEFAULT));
           $msg = "Mot de passe mis à jour";
        }
        else{
            $msg= "Erreur lors de la mis à jour du mot de passe";
        }
    }

    echo $twig->render('modifMdp.html.twig', [
        'message' => $msg
    ]);
}

?>