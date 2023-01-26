<?php

function addPersonne($db, $nom, $prenom)
{
    $query = $db->prepare("INSERT INTO Personne (Nom, Prenom) VALUES (:Nom, :Prenom)");
    return $query->execute([
        'Nom' => $nom,
        'Prenom' => $prenom
    ]);
}

function addPersonneComplet($db, $nom, $prenom, $email, $password)
{
    $query = $db->prepare("INSERT INTO Personne (Nom, Prenom, Email, PasswordUser, idRole) VALUES (:Nom, :Prenom, :Email, :PasswordUser, :idRole)");
    return $query->execute([
        'Nom' => $nom,
        'Prenom' => $prenom,
        'Email' => $email,
        'PasswordUser' => $password,
        'idRole' => 1
    ]);
}

function addEntreprise ($db, $nom){
    $query = $db->prepare("INSERT INTO Entreprise_Cliente (Nom) VALUES (:nom)");
    return $query ->execute([
        'nom' => $nom
    ]);
}

function addContrat ($db, $DateSignature, $CoutGlobal, $DateDebut, $DateFin, $IDPersonne, $IDEntre){
    $query = $db -> prepare("INSERT INTO Contrat (DateSignature, CoutGlobal, DateDebut, DateFin, IDPersonne, IDEntre)
                            VALUES (:datesignature, :coutglobal, :datedebut, :datefin, :idpersonne, :identre)");
    return $query ->execute([
        'datesignature' => $DateSignature,
        'coutglobal' => $CoutGlobal,
        'datedebut' => $DateDebut,
        'datefin' => $DateFin,
        'idpersonne' => $IDPersonne,
        'identre' => $IDEntre
    ]);
}

function getAllContrat($db)
{
    $query = $db->prepare("SELECT IDContrat, DateSignature, CoutGlobal, DateDebut, DateFin, IDPersonne, IDEntre
                            FROM Contrat ");
    $query->execute([]);
    $allContrat = $query->fetchAll();
    return $allContrat;
}

function getOneContrat($db, $IDContrat){
    $query = $db->prepare("SELECT DateSignature, CoutGlobal, DateDebut, DateFin, IDPersonne, IDEntre 
                            FROM Contrat
                            WHERE IDContrat = :IDContrat ");
    $query->execute([
        'IDContrat' => $IDContrat
    ]);
    $oneContrat = $query->fetch();
    return $oneContrat;
}

function modifierContrat($db, $IDContrat, $DateSignature, $CoutGlobal, $DateDebut, $DateFin, $IDPersonne, $IDEntre) 
{
    $query = $db->prepare("UPDATE Contrat
                            SET DateSignature = :DateSignature, CoutGlobal = :CoutGlobal, DateDebut = :DateDebut, DateFin = :DateFin, IDPersonne = :IDPersonne, IDEntre = :IDEntre
                            WHERE IDContrat = :IDContrat ");
    $query->execute([
        'IDContrat' => $IDContrat,
        'DateSignature' => $DateSignature,
        'CoutGlobal' => $CoutGlobal,
        'DateDebut' => $DateDebut,
        'DateFin' => $DateFin,
        'IDPersonne' => $IDPersonne,
        'IDEntre' => $IDEntre,
    ]);
}

function supprimerContrat($db, $IDContrat)
{
    $query = $db->prepare("DELETE FROM Contrat
                            WHERE IDContrat = :IDContrat ");
    $query->execute([
        'IDContrat' => $IDContrat
    ]);
}

function getAllEntreprise($db)
{
    $query = $db->prepare("SELECT IDEntre, Nom
                            FROM Entreprise_Cliente ");
    $query->execute([]);
    $allEntreprise = $query->fetchAll();
    return $allEntreprise;
}

function getOneEntreprise($db, $IDEntre){
    $query = $db->prepare("SELECT Nom FROM Entreprise_Cliente
                            WHERE IDEntre = :IDEntre ");
    $query->execute([
        'IDEntre' => $IDEntre
    ]);
    $oneEntreprise = $query->fetch();
    return $oneEntreprise;
}

function supprimerEntreprise($db, $IDEntre)
{
    $query = $db->prepare("DELETE FROM Entreprise_Cliente
                            WHERE IDEntre = :IDEntreprise ");
    $query->execute([
        'IDEntreprise' => $IDEntre
    ]);
}

function modifierEntreprise($db, $IDEntreAncien, $IDEntreNouveau, $NomEntreNouveau){
    $query = $db->prepare("UPDATE Entreprise_Cliente
                            SET IDEntre = :IDEntreNouveau, `Nom` = :NomEntreNouveau
                            WHERE IDEntre = :IDEntreAncien ");
    $query->execute([
        'IDEntreAncien' => $IDEntreAncien,
        'IDEntreNouveau' => $IDEntreNouveau,
        'NomEntreNouveau' => $NomEntreNouveau
    ]);
}

function addModule($db, $etat, $equipe, $contrat)
{
    $query = $db->prepare("INSERT INTO Module (Etat, IDEquipe, IDContrat) VALUES (:Etat, :IDEquipe, :IDContrat)");
    return $query->execute([
        'Etat' => $etat,
        'IDEquipe' => $equipe,
        'IDContrat' => $contrat
    ]);
}

function suppModule($db, $id)
{
    $query = $db->prepare("DELETE FROM Module WHERE :IDModule = IDModule");
    return $query->execute([
        'IDModule' => $id
    ]);
}


function getAllModules($db)
{
    $query = $db->prepare("SELECT IDModule, Etat, IDEquipe, IDContrat FROM Module");
    $query->execute([]);

    $product = $query->fetchAll();

    return $product;
}

function getModule($db, $id)
{
    $query = $db->prepare("SELECT IDModule, Etat, IDEquipe, IDContrat FROM Module WHERE :IDModule = IDModule");
    $query->execute([
        'IDModule' => $id
    ]);

    $product = $query->fetch();

    if ($product != null ) return $product;
    else return "Ce module n'existe pas !";
}

function updateModule($db, $id, $contrat, $equipe, $etat)
{
    $query = $db->prepare("UPDATE Module SET IDContrat = :IDContrat, IDEquipe = :IDEquipe, Etat = :Etat WHERE IDModule = :IDModule ");
    $query->execute([
        'IDContrat' => $contrat,
        'IDEquipe' => $equipe,
        'IDModule' => $id,
        'Etat' => $etat,
    ]);
}


function getAllEquipes($db)
{
    $query = $db->prepare("SELECT IDEquipe, IDPersonne FROM Equipe");
    $query->execute([]);

    $product = $query->fetchAll();

    return $product;
}

function getAllContrats($db)
{
    $query = $db->prepare("SELECT IDContrat, IDEntre FROM Contrat");
    $query->execute([]);

    $product = $query->fetchAll();

    return $product;
}

function getPersonne($db, $IDPersonne){
    $query = $db->prepare("SELECT Nom, Prenom FROM Personne WHERE :IDPersonne = IDPersonne");
    $query ->execute([
        'IDPersonne' => $IDPersonne,
    ]);
    $product = $query->fetch();

    return $product;
}

function updatePersonne($db, $nom, $prenom, $IDPersonne){
    $query = $db -> prepare("UPDATE Personne SET Nom = :Nom, Prenom = :Prenom WHERE IDPersonne = :IDPersonne "); 
    return $query->execute([
        'Nom' => $nom,
        'Prenom' => $prenom,
        'IDPersonne' => $IDPersonne
    ]);
    }

function listePersonnes($db){
    $query = $db -> prepare("SELECT IDPersonne, Nom, Prenom FROM Personne"); 
    $query -> execute([]);
    $liste = $query->fetchAll();
    return $liste;
}


function deletePersonne($db, $IDPersonne){
    $query = $db -> prepare("DELETE FROM Personne WHERE IDPersonne = :IDPersonne "); 
    return $query->execute([
        'IDPersonne' => $IDPersonne
    ]);
    }



function addTache($db, $libelle, $etat, $dateDebut, $dateFin, $module)
{
    $query = $db->prepare("INSERT INTO Tache (Libelle, Etat, DateDebut, DateFin, IDModule) VALUES (:Libelle, :Etat, :DateDebut, :DateFin, :IDModule)");
    return $query->execute([
        'Libelle' => $libelle,
        'Etat' => $etat,
        'DateDebut' => $dateDebut,
        'DateFin' => $dateFin,
        'IDModule' => $module
    ]);
}

function getAllTaches($db) {
    $query = $db->prepare("SELECT IDTache, Libelle, Etat, DateDebut, DateFin, IDModule FROM Tache");
    $query->execute([]);

    $product = $query->fetchAll();

    return $product;
}

function addCoPersonne($db, $Rue, $Ville, $CodePostal, $Email, $IDPersonne)
{
    $query = $db->prepare("INSERT INTO Coordonnees(Rue, Ville, Code_Postal, email, IDPersonne) VALUES (:Rue, :Ville, :Code_Postal, :email, :IDPersonne)");
    return $query->execute([
        'IDPersonne' => $IDPersonne,
        'Rue' => $Rue,
        'Ville' => $Ville,
        'Code_Postal' => $CodePostal,
        'email' => $Email,
    ]);
    }

function getAllCo($db){
    $query = $db->prepare("SELECT Rue, Ville, Code_Postal, email, Personne.Nom, Personne.Prenom, Coordonnees.IDPersonne FROM Coordonnees, Personne WHERE Coordonnees.IDPersonne = Personne.IDPersonne");
    $query ->execute([
    ]);
    $product = $query->fetchAll();

    return $product;
}


function suppTache($db, $tache) {
    $query = $db->prepare("DELETE FROM Tache
                            WHERE IDTache = :IDTache ");
    $query->execute([
        'IDTache' => $tache
    ]);
}

function getTache($db, $id)
{
    $query = $db->prepare("SELECT IDTache, Libelle, Etat, DateDebut, DateFin, IDModule FROM Tache WHERE :IDTache = IDTache");
    $query->execute([
        'IDTache' => $id
    ]);

    $product = $query->fetch();

    if ($product != null ) return $product;
    else return "Cette tache n'existe pas !";
}

function updateTache($db, $id, $libelle, $etat, $dateDebut, $dateFin, $module)
{
    $query = $db->prepare("UPDATE Tache SET Libelle = :Libelle, Etat = :Etat, DateDebut = :DateDebut, DateFin = :DateFin, IDModule = :IDModule WHERE IDTache = :IDTache ");
    $query->execute([
        'Libelle' => $libelle,
        'Etat' => $etat,
        'DateDebut' => $dateDebut,
        'DateFin' => $dateFin,
        'IDModule' => $module,
        'IDTache' => $id
    ]);
}

function getCo($db, $IDPersonne){
    $query = $db->prepare("SELECT Rue, Ville, Code_Postal, email, Personne.Nom, Personne.Prenom, Coordonnees.IDPersonne FROM Coordonnees, Personne WHERE Coordonnees.IDPersonne = :IDPersonne AND Personne.IDPersonne");
    $query ->execute([
        'IDPersonne'=> $IDPersonne, ]);
    $product = $query->fetch();

    return $product;
}


function updateCoPersonne($db, $Rue, $CodePostal, $Ville, $Email, $IDPersonne){
    $query = $db -> prepare("UPDATE Coordonnees SET Rue = :Rue, Code_Postal = :CodePostal, Ville = :Ville, email = :email WHERE IDPersonne = :IDPersonne "); 
    return $query->execute([
        'Rue' => $Rue,
        'CodePostal' => $CodePostal,
        'Ville' => $Ville,
        'email' => $Email, 
        'IDPersonne' => $IDPersonne,
    ]);
}


function getOneUser($db, $email) {
    $query = $db->prepare("SELECT Nom, Prenom, PasswordUser, Email, IDPersonne, CompteVerifie, idRole FROM Personne WHERE :Email = Email");
    $query ->execute([
        'Email'=> $email
    ]);
    $user = $query->fetch();

    return $user;
}


function getOneUserFromID($db, $id) {
    $query = $db->prepare("SELECT Nom, Prenom, PasswordUser, Email, IDPersonne, CompteVerifie, idRole FROM Personne WHERE :id = IDPersonne");
    $query ->execute([
        'id'=> $id
    ]);
    $user = $query->fetch();

    return $user;
}


function getOneRole($db, $id) {
    $query = $db->prepare("SELECT idRole, Label FROM `Role` WHERE :id = idRole");
    $query ->execute([
        'id'=> $id
    ]);
    $user = $query->fetch();

    return $user;
}




function testEmailExists($db, $email) {
    $query = $db->prepare("SELECT Nom FROM Personne WHERE :Email = Email");
    $query ->execute([
        'Email'=> $email,
    ]);
    $user = $query->fetch();

    if ($user == null) return false;
    else return true;
}