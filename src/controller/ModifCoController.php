<?php
function ModifCoController($twig, $db){
    include_once '../src/model/ProjetModel.php';

    if (isset($_GET["id"])) {
        $IDPersonne = $_GET["id"];
    }
    if (isset($_POST['btnModCo'])) {
        updateCoPersonne(
            $db,
            $_POST["Rue"],
            $_POST["CodePostal"],
            $_POST["Ville"],
            $_POST["email"],
            $IDPersonne,
        );
    }
    
    echo $twig->render('modifCoPersonne.html.twig', [
        "co" => getCo($db, $IDPersonne),
   ]);
}

?>