<?php
function addPersonneController($twig, $db) {
    include_once '../src/model/ProjetModel.php';
    

    if (isset($_POST['btnAddDev'])) {
        $nom = htmlspecialchars($_POST["nom"]);
        $prenom = htmlspecialchars($_POST["prenom"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);

        addDev($db, $nom, $prenom, $email, password_hash($password, PASSWORD_DEFAULT));

    }
    if (isset($_POST['btnAddClient'])) {
        $nom = htmlspecialchars($_POST["nom"]);
        $prenom = htmlspecialchars($_POST["prenom"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);

        addClient($db, $nom, $prenom, $email, password_hash($password, PASSWORD_DEFAULT));

    }

    echo $twig->render('addPersonne.html.twig', []);
}
