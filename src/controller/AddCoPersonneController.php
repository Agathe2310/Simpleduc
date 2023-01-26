<?php
function addCoPersonneController($twig, $db, $nbNotifs) {
    include_once '../src/model/ProjetModel.php';

    
    if (isset($_GET["id"])) {
        $IDPersonne = $_GET["id"];
    }

    if (isset($_POST['btnAddCoPersonne'])) {
        $Rue = htmlspecialchars($_POST["Rue"]);
        $Ville = htmlspecialchars($_POST["Ville"]);
        $CodePostal = htmlspecialchars($_POST["CodePostal"]);
        $Email= htmlspecialchars($_POST["Email"]);

        addCoPersonne($db, $Rue, $Ville, $CodePostal, $Email, $IDPersonne);

    }

    echo $twig->render('addCoPersonne.html.twig', [
        "personne" => getPersonne($db, $IDPersonne),
        'nbNotifs' => $nbNotifs
        ]);
}