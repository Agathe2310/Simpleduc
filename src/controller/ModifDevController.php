<?php
function ModifDevController($twig, $db){
    include_once '../src/model/ProjetModel.php';

    if (isset($_GET["id"])) {
        $IDPersonne = $_GET["id"];
    }
    if (isset($_POST['btnModifierDev'])) {
        updateDev(
            $db,
            $_POST["Nom"],
            $_POST["Prénom"],
            $_POST["Equipe"],
            $IDPersonne,
        );
    }
    if (isset($_POST['btnDeleteDev'])){
        deleteDev($db, $IDPersonne);
    }

    $Equipe = getEquipe($db, $IDPersonne);

    
    echo $twig->render('modifDev.html.twig', [
        "personne" => getPersonne($db, $IDPersonne),"Equipe" => $Equipe
   ]);
}

?>