<?php
function ModifPersonneController($twig, $db){
    include_once '../src/model/ProjetModel.php';

    if (isset($_GET["id"])) {
        $IDPersonne = $_GET["id"];
    }
    if (isset($_POST['btnModifierPersonne'])) {
        updatePersonne(
            $db,
            $_POST["Nom"],
            $_POST["Prénom"],
            $IDPersonne,
        );
    }
    
    
    echo $twig->render('modifPersonne.html.twig', [
        "personne" => getPersonne($db, $IDPersonne),
   ]);
}

?>