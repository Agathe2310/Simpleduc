<?php

function homeController($twig, $db, $nbNotifs)
{
    include_once '../src/model/ProjetModel.php';  ##on inclut pour apres

    $role = 0;

    if (isset($_SESSION['iduser'])) {

        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role'];
            $role = getOneRole($db, $role)['Label'];
        }

        if (isset($_POST['ajouterOutil'])) {
            ajouterMaitriserOutil($db, $_SESSION['iduser'], $_POST['CodeOutil']);
        }

        if (isset($_POST['RechercherOutil']) && isset($_POST['NomOutil'])) {
            if (!empty($_POST['NomOutil'])) {
                $outilsuser = getOutilsRechercher($db, $_SESSION['iduser'], $_POST['NomOutil']);
            }
        }

        if (isset($_POST['submitSupprimerOutil'])){
            deleteMaitriserOutil($db, $_SESSION['iduser'], $_POST['supprimerOutil']);
        }


        $infos = getOneUser($db, $_SESSION['login']);
        $equipes = getEquipeIDUser($db, $_SESSION['iduser']);
        $outils = getAllOutils($db);
        $outilsuser = getOutilsUser($db, $_SESSION['iduser']);
        $isdev = isDev($db, $_SESSION['iduser']);

        if (isset($_GET['idequipe'])) {
            $membres = getMembresFromEquipe($db, $_GET['idequipe']);
            $chef = getChefFromEquipe($db, $_GET['idequipe']);
            $module = getModulesFromEquipe($db, $_GET['idequipe']);
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
                'outilsuser' => $outilsuser,
                'isdev' => $isdev
            ]);
        } else {
            echo $twig->render('home.html.twig', [
                'role' => $role,
                'date' =>  date('Y-m-d H:i:s'),
                'infos' => $infos,
                'equipes' => $equipes,
                'outils' => $outils,
                'outilsuser' => $outilsuser,
                'nbNotifs' => $nbNotifs,
                'isdev' => $isdev
            ]);
        }
    } else {

        echo $twig->render('home.html.twig', [
            'date' =>  date('Y-m-d H:i:s'),
            'nbNotifs' => $nbNotifs
        ]);
    }
}
