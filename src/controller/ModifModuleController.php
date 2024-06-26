<?php

function modifModuleController($twig, $db, $nbNotifs)
{
    include_once '../src/model/ProjetModel.php';

    $id = 1;
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
    }

    if (isset($_POST['IDModule'])) {
        updateModule(
            $db,
            $_POST["IDModule"],
            $_POST["IDContrat"],
            $_POST["IDEquipe"],
            $_POST["Etat"]
        );
    }

    echo $twig->render('modifModule.html.twig', [
        "module" => getModule($db, $id),
        "equipes" => getAllEquipes($db),
        "contrats" => getAllContrats($db),
        'nbNotifs' => $nbNotifs
    ]);
}
