<?php 

function addRenduController($twig,$db){
    include_once '../src/model/ProductModel.php';  ##on inclut pour apres

    if((!empty($_POST['renduGroupe'])) && (!empty($_POST['trip-end'])) && (!empty($_POST['trip-start'])) && (!empty($_POST['renduLabel'])) && (!empty($_POST['renduDescription'])) && (isset($_POST['btnAddRendu']))){ ##determiner si le tableau est definit btnAddProduct nom du bouton on regarde s'il existe lors d'un envoi de formulaire
        $label = htmlspecialchars($_POST['renduLabel']);
        $description = htmlspecialchars($_POST['renduDescription']);
        $idgroupe = htmlspecialchars($_POST['renduGroupe']);
        $datecreation = htmlspecialchars($_POST['trip-start']);
        $dateline = htmlspecialchars($_POST['trip-end']);
        $prof = $_SESSION['username'];
        saveRendu($db,$label,$description,$idgroupe,$prof,$datecreation,$dateline);
    
    }else{
        if(isset($_POST['btnAddRendu'])==true){
            echo '<script language="Javascript">
                alert ("Tu as oublié de saisir un ou des champs." )
                </script>';
        }
    }
    echo $twig -> render("addRendu.html.twig", [

    ]);
}

?>