<?php

function addModuleController($twig, $db, $nbNotifs)
{
    include_once '../src/model/ProjetModel.php';  ##on inclut pour apres

    if (isset($_POST['moduleEtat']) && isset($_POST['moduleEquipe']) && isset($_POST['moduleContrat']) && isset($_POST['btnAddModule'])) { ##determiner si le tableau est definit btnAddProduct nom du bouton on regarde s'il existe lors d'un envoi de formulaire
        $etat = htmlspecialchars($_POST['moduleEtat']);
        $equipe = $_POST['moduleEquipe'];
        $contrat = $_POST['moduleContrat'];
        addModule($db, $etat, $equipe, $contrat);
    } else {
        if (isset($_POST['btnAddModule']) == true) {
            echo '<script language="Javascript">
                alert ("Tu as oublié de saisir un ou des champs." )
                </script>';
        }
    }

    if (isset($_POST["btnSuppModule"]) && isset($_POST["cocheSupp"])) {
        foreach ($_POST["cocheSupp"] as $module) {
            suppModule($db, $module);
        }
    }

    echo $twig->render("addModule.html.twig", [
        "modules" => getAllModules($db),
        "equipes" => getAllEquipes($db),
        "contrats" => getAllContrats($db),
        'nbNotifs' => $nbNotifs
    ]);
}
