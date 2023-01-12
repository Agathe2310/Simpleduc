<?php 

function addContratController($twig,$db){
    include_once '../src/model/ProjetModel.php';  ##on inclut pour apres

    if(isset($_POST['DateSignature']) && isset($_POST['CoutGlobal']) && isset($_POST['DateDebut']) && isset($_POST['DateFin']) && isset($_POST['idPersonne']) && isset($_POST['idEntre']) && isset($_POST['btnAddContrat'])){
        $DateSignature = htmlspecialchars($_POST['DateSignature']);
        $CoutGlobal = htmlspecialchars($_POST['CoutGlobal']);
        $DateDebut = htmlspecialchars($_POST['DateDebut']);
        $DateFin = htmlspecialchars($_POST['DateFin']);
        $IDPersonne = htmlspecialchars($_POST['idPersonne']);
        $IDEntre = htmlspecialchars($_POST['idEntre']);
        
    
    }
    $allContrat = getAllContrat($db);
    echo $twig -> render("addContrat.html.twig", [
        'allContrat' => $allContrat
    ]);
}

?>