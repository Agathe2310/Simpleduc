<?php 

function addOutilController($twig,$db){
    include_once '../src/model/ProjetModel.php';  ##on inclut pour apres

    if(isset($_POST['Libelle']) && isset($_POST['Version']) && isset($_POST['btnAddOutil'])){
        $Libelle = $_POST['Libelle'];
        $Version = $_POST['Version'];
        addOutil($db,$Libelle, $Version);
    
    }
    if (isset($_POST['submitSupprimerOutil'])){
        supprimerContrat($db, $_POST['supprimerOutil']);
    }
    $allOutils = getAllOutils($db);
    echo $twig -> render("addOutil.html.twig", [
        'allOutils' => $allOutils
    ]);
}

?>