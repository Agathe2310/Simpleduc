<?php 

function modifierContratController($twig,$db){
    include_once '../src/model/ProjetModel.php';  ##on inclut pour apres


    var_dump($_GET['id']);
    if(!empty($_GET['id'])){
        $id = $_GET['id'];
        $Contrat = getOneContrat($db,$id);
    }
    else {
        echo "ID n'a pas été trouvé";
    }

    if (isset($_POST['modifierContrat']) && isset ($_POST['modifierDateSignature']) && isset ($_POST['modifierCoutGlobal']) && isset ($_POST['modifierDateDebut'])&& isset ($_POST['modifierDateFin'])&& isset ($_POST['modifierIDPersonne'])&& isset ($_POST['modifierIDEntre'])){
        modifierContrat($db, $id, $_POST['modifierDateSignature'], $_POST['modifierCoutGlobal'], $_POST['modifierDateDebut'], $_POST['modifierDateFin'], $_POST['modifierIDPersonne'], $_POST['modifierIDEntre']);
    }

    if (isset ($id)){
        $Contrat = getOneContrat($db, $id);
        echo $twig -> render("modifierContrat.html.twig", [
            'Contrat' => $Contrat,
            'IDContrat' => $id,
            'nbNotifs' => $nbNotifs
        ]);
    }

}

?>