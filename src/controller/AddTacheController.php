<?php

function addTacheController($twig, $db)
{
    include_once '../src/model/ProjetModel.php';  ##on inclut pour apres

    if (
        isset($_POST['tacheEtat'])
        && isset($_POST['tacheModule'])
        && isset($_POST['tacheLibelle'])
        && isset($_POST['tacheDateDebut'])
        && isset($_POST['tacheDateFin'])
    ) {
        $etat = htmlspecialchars($_POST['tacheEtat']);
        $libelle = htmlspecialchars($_POST['tacheLibelle']);
        $dateDebut = $_POST['tacheDateDebut'];
        $dateFin = $_POST['tacheDateFin'];
        $module = $_POST['tacheModule'];

        addTache($db, $libelle, $etat, $dateDebut, $dateFin, $module);
    } else {
        if (isset($_POST['btnAddTache']) == true) {
            echo '<script language="Javascript">
                alert ("Tu as oublié de saisir un ou des champs." )
                </script>';
        }
    }

    if (isset($_POST["btnSuppTache"]) && isset($_POST['cocheSupp'])) {
        foreach ($_POST["cocheSupp"] as $tache) {
            suppTache($db, $tache);
        }
    }

    echo $twig->render("addTache.html.twig", [
        "taches" => getAllTaches($db),
        "modules" => getAllModules($db)
    ]);
}
