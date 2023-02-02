<?php

function homeController($twig, $db)
{
    include_once '../src/model/ProjetModel.php';  ##on inclut pour apres

    $role = 0;

    if (isset($_SESSION['role'])) $role = $_SESSION['role'];

    $role = getOneRole($db, $role)['Label'];
    $infos = getOneUser($db, $_SESSION['login']);
    $equipes = getEquipeIDUser($db, $_SESSION['iduser']);
    $outils = getAllOutils($db);
    $outilsuser = getOutilsUser($db, $_SESSION['iduser']);

    if (isset($_POST['ajouterOutil'])){
        ajouterMaitriserOutil($db, $_SESSION['iduser'], $_POST['CodeOutil']);
    }

    if (isset($_POST['RechercherOutil']) && isset($_POST['NomOutil'])){
        if (!empty($_POST['NomOutil'])){
            $outilsuser = getOutilsRechercher($db, $_SESSION['iduser'], $_POST['NomOutil']);
        }
    }

    if (isset($_GET['idequipe'])){
        $membres = getMembresFromEquipe($db, $_GET['idequipe']);
        $chef = getChefFromEquipe($db, $_GET['idequipe']);
        $module = getModulesFromEquipe($db, $_GET['idequipe']);
        var_dump($module);
        echo $twig->render('home.html.twig', [
            'role' => $role,
            'date' =>  date('Y-m-d H:i:s'),
            'infos' => $infos,
            'equipes' => $equipes,
            'equipeselectionner' => $_GET['idequipe'],
            'membres' => $membres,
            'chef' => $chef,
            'modules' => $module,
            'outils' => $outils,
            'outilsuser' => $outilsuser
        ]);
    }
    else {
    echo $twig->render('home.html.twig', [
        'role' => $role,
        'date' =>  date('Y-m-d H:i:s'),
        'infos' => $infos,
        'equipes' => $equipes,
        'outils' => $outils,
        'outilsuser' => $outilsuser,
        'equipeselectionner' => -1 // Pour qu'on puisse voir le groupe 'Voir tout' les membres du groupes 0
    ]);
    }
}
