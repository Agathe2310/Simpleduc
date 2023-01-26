<?php
function addPersonneController($twig, $db, $nbNotifs) {
    include_once '../src/model/ProjetModel.php';
    

    if (isset($_POST['btnAddPersonne'])) {
        $nom = htmlspecialchars($_POST["nom"]);
        $prenom = htmlspecialchars($_POST["prenom"]);

        addPersonne($db, $nom, $prenom);

    }

    echo $twig->render('addPersonne.html.twig', [
    'nbNotifs' => $nbNotifs]);
}
