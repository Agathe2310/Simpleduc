<?php 

function addEntrepriseController($twig,$db){
    include_once '../src/model/ProjetModel.php';  ##on inclut pour apres

    if(isset($_POST['nomEntreprise']) && isset($_POST['btnAddEntreprise'])){
        $nomEntreprise = htmlspecialchars($_POST['nomEntreprise']);
        addEntreprise($db,$nomEntreprise);
    }else{
        if(isset($_POST['btnAddEntreprise'])==true){
            echo '<script language="Javascript">
                alert ("Tu as oublié de saisir un ou des champs." )
                </script>';
        }
    }
    if (isset($_POST['submitSupprimerEntreprise'])){
        supprimerEntreprise($db, $_POST['supprimerEntreprise']);
    }
    $AllEntreprise = getAllEntreprise($db);
    echo $twig -> render("addEntreprise.html.twig", [
        'allEntreprise' => $AllEntreprise
    ]);
}

?>