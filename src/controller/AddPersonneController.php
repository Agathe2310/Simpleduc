<?php
function addPersonneController($twig, $db, $nbNotifs) {
    include_once '../src/model/ProjetModel.php';
    $erreur = "";
    if (isset($_POST['btnAddDev'])) {
        $nom = htmlspecialchars($_POST["nom"]);
        $prenom = htmlspecialchars($_POST["prenom"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        
        if (!testEmailExists($db, $email)) {
            addDev($db, $nom, $prenom, $email, password_hash($password, PASSWORD_DEFAULT));
    
        } else {
            $erreur = "existe deja";}

        if (isset($_POST['btnAddClient'])) {
            $nom = htmlspecialchars($_POST["nom"]);
            $prenom = htmlspecialchars($_POST["prenom"]);
            $email = htmlspecialchars($_POST["email"]);
            $password = htmlspecialchars($_POST["password"]);
            if (!testEmailExists($db, $email)) {
                addClient($db, $nom, $prenom, $email, password_hash($password, PASSWORD_DEFAULT));
                
            } else {
                $erreur = "existe deja";}
        }
    }   
    

    echo $twig->render('addPersonne.html.twig', [
    'nbNotifs' => $nbNotifs,
    "erreur" => $erreur
]);
}
