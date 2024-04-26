<?php
function ModifPersonneController($twig, $db, $nbNotifs){
    include_once '../src/model/ProjetModel.php';

    if (isset($_GET["id"])) {
        $IDPersonne = $_GET["id"];
    }
    $email = getPersonne($db, $IDPersonne);
    
    if (isset($_POST['btnModifierPersonne'])) {
        updatePersonne(
            $db,
            $_POST["Nom"],
            $_POST["Prénom"],
            $IDPersonne,
        );
    }
    if (isset($_POST['btnDev'])) {
        transformerenDev(
            $db,
            $IDPersonne,
            $email[2]
        );
    }
    
    echo $twig->render('modifPersonne.html.twig', [
        "personne" => $email,
        'nbNotifs' => $nbNotifs
   ]);
}

?>