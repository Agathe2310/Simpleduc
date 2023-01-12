<?php

function modifModuleController($twig, $db)
{
    include_once '../src/model/ProjetModel.php';
    var_dump($_POST);

    $id = 1;
    if (isset($_POST["btnModModule"])) {
        $id = $_POST["btnModModule"];
    }

    if (isset($_POST['btnModifModule'])) {
        updateModule(
            $db,
            $_POST["btnModifModule"],
            $_POST["IDContrat"],
            $_POST["IDEquipe"],
            $_POST["Etat"]
        );
    }

    echo $twig->render('modifModule.html.twig', [
        "module" => getModule($db, $id),
        "equipes" => getAllEquipes($db),
        "contrats" => getAllContrats($db)
    ]);
}
