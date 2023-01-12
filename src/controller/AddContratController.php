<?php 

function addContratController($twig,$db){
    include_once '../src/model/ProjetModel.php';  ##on inclut pour apres

    if(isset($_POST['DateSignature']) && isset($_POST['CoutGlobal']) && isset($_POST['DateDebut']) && isset($_POST['DateFin']) && isset($_POST['idPersonne']) && isset($_POST['idEntre']) && isset($_POST['btnAddContrat'])){
        $DateSignature = $_POST['DateSignature'];
        $CoutGlobal = $_POST['CoutGlobal'];
        $DateDebut = $_POST['DateDebut'];
        $DateFin = $_POST['DateFin'];
        $IDPersonne = $_POST['idPersonne'];
        $IDEntre = $_POST['idEntre'];
        addContrat($db,$DateSignature, $CoutGlobal, $DateDebut, $DateFin, $IDPersonne, $IDEntre);
    
    }
    if (isset($_POST['submitSupprimerContrat'])){
        supprimerContrat($db, $_POST['supprimerContrat']);
    }
    $allContrat = getAllContrat($db);
    echo $twig -> render("addContrat.html.twig", [
        'allContrat' => $allContrat
    ]);
}

?>