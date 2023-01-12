<?php 

function addModuleController($twig,$db){
    include_once '../src/model/ProjetModel.php';  ##on inclut pour apres

    if(isset($_POST['moduleEtat']) && isset($_POST['moduleEquipe']) && isset($_POST['moduleContrat']) && isset($_POST['btnAddModule'])){ ##determiner si le tableau est definit btnAddProduct nom du bouton on regarde s'il existe lors d'un envoi de formulaire
        $etat = htmlspecialchars($_POST['moduleEtat']);
        $equipe = $_POST['moduleEquipe'];
        $contrat = $_POST['moduleContrat'];
        addModule($db,$etat, $equipe, $contrat);
    
    }else{
        if(isset($_POST['btnAddModule'])==true){
            echo '<script language="Javascript">
                alert ("Tu as oublié de saisir un ou des champs." )
                </script>';
        }
    }

    if (isset($_POST["btnASuppModule"]) && isset($_POST["suppModuleSelect"])) {
        while (in_array("supp", $_POST)) {
            $module = array_search("supp", $_POST);
            suppModule($db, $module);
            $_POST[$module] = null;
        }
    }

    echo $twig -> render("addModule.html.twig", [
        "modules" => getAllModules($db),
        "equipes" => getAllEquipes($db),
        "contrats" => getAllContrats($db)
    ]);
}

?>