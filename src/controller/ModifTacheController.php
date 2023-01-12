<?php

function modifTacheController($twig, $db)
{
    include_once '../src/model/ProjetModel.php';
    
    $id = 1;
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
    }

    if (isset($_POST['IDTache'])) {
        updateTache(
            $db,
            $id,
            $_POST["Libelle"],
            $_POST["Etat"],
            $_POST["DateDebut"],
            $_POST["DateFin"],
            $_POST["IDModule"],
        );
    }

    echo $twig->render('modifTache.html.twig', [
        "tache" => getTache($db, $id),
        "modules" => getAllModules($db),
    ]);
}
