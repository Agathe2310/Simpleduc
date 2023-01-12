<?php 

function modifierEntrepriseController($twig,$db){
    include_once '../src/model/ProjetModel.php';  ##on inclut pour apres


    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $nomEntreprise = getOneEntreprise($db,$id);
        
    }

    if (isset($_POST['modifierEntreprise']) && isset ($_POST['modifierIDEntreprise']) && isset ($_POST['modifierNomEntreprise'])){
        $nouvelleIDEntreprise = $_POST['modifierIDEntreprise'];
        $nouveauNomEntreprise = $_POST['modifierNomEntreprise'];
        modifierEntreprise($db, $id, $nouvelleIDEntreprise, $nouveauNomEntreprise);
    }

    if (isset ($id) && isset ($nomEntreprise)){
        $nomEntreprise = getOneEntreprise($db,$id);
        echo $twig -> render("modifierEntreprise.html.twig", [
            'IDEntreprise' => $id,
            'NomEntreprise' => $nomEntreprise
        ]);
    }
    else {
        echo "ID n'a pas été trouvé";
    }

}

?>