<?php

function addDev($db, $nom, $prenom, $email, $password)
{
    $query = $db->prepare("INSERT INTO Personne (Nom, Prenom, Email, PasswordUser, idRole, CompteVerifie) VALUES (:Nom, :Prenom, :Email, :PasswordUser, :idRole, :CompteVerifie);");
    $query2 = $db ->prepare("INSERT INTO Dev(IDPersonne, IDIndice) VALUES((SELECT IDPersonne FROM Personne WHERE Email = :Email), :IDIndice);");
    $query3 = $db -> prepare("INSERT INTO regrouper(IDPersonne, IDEquipe) VALUES((SELECT IDPersonne FROM Personne WHERE Email = :Email), :IDEquipe);");
    $query->execute([
        'Nom' => $nom,
        'Prenom' => $prenom,
        'Email' => $email,
        'PasswordUser' => $password,
        'idRole' => 1,
        'CompteVerifie' => 1,
    ]);
    $query2->execute([
        'Email' => $email,
        'IDIndice' => 1,
    
    ]);
    return $query3->execute([
        'Email' => $email,
        'IDEquipe' => 0
    
    ]);
}


function transformerenDev($db, $IDPersonne, $email)
{
    $query = $db ->prepare("INSERT INTO Dev(IDPersonne, IDIndice) VALUES(:IDPersonne, :IDIndice);");
    $query2 = $db -> prepare("INSERT INTO regrouper(IDPersonne, IDEquipe) VALUES((SELECT IDPersonne FROM Personne WHERE Email = :Email), :IDEquipe);");
    $query->execute([
        'IDPersonne' => $IDPersonne,
        'IDIndice' => 1
    
    ]);
    return $query2->execute([
        'Email' => $email,
        'IDEquipe' => 0,
    
    ]);
}

function addClient($db, $nom, $prenom, $email, $password)
{
    $query = $db->prepare("INSERT INTO Personne (Nom, Prenom, Email, PasswordUser, idRole, CompteVerifie) VALUES (:Nom, :Prenom, :Email, :PasswordUser, :idRole, :CompteVerifie);");
    $query2 = $db->prepare("INSERT INTO Contact(IDPersonne) VALUES((SELECT IDPersonne FROM Personne WHERE Email = :Email));");
    $query->execute([
        'Nom' => $nom,
        'Prenom' => $prenom,
        'Email' => $email,
        'PasswordUser' => $password,
        'idRole' => 1,
        'CompteVerifie' => 1,
    ]);
    return $query2->execute([
        'Email' => $email,
    
    ]);
}

function addPersonneComplet($db, $nom, $prenom, $email, $password)
{
    $query = $db->prepare("INSERT INTO Personne (Nom, Prenom, Email, PasswordUser, idRole) VALUES (:Nom, :Prenom, :Email, :PasswordUser, :idRole)");
    $query2 = $db->prepare("INSERT INTO Contact(IDPersonne) VALUES((SELECT IDPersonne FROM Personne WHERE Email = :Email));");
    $query->execute([
        'Nom' => $nom,
        'Prenom' => $prenom,
        'Email' => $email,
        'PasswordUser' => $password,
        'idRole' => 1
    ]);
    return $query2->execute([
        'Email' =>$email
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
    $query = $db->prepare("SELECT IDEquipe FROM Equipe");
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
    $query = $db->prepare("SELECT Nom, Prenom, Email FROM Personne WHERE :IDPersonne = IDPersonne");
    $query ->execute([
        'IDPersonne' => $IDPersonne,
    ]);
    $product = $query->fetch();

    return $product;
}

function updateDev($db, $nom, $prenom, $IDEquipe, $IDPersonne){
    $query = $db -> prepare("UPDATE Personne SET Nom = :Nom, Prenom = :Prenom WHERE IDPersonne = :IDPersonne; "); 
    $query2 = $db->prepare("UPDATE regrouper SET IDEquipe = :IDEquipe WHERE IDPersonne = :IDPersonne");
    $query2->execute([
        'IDEquipe' => $IDEquipe,
        'IDPersonne' => $IDPersonne
    ]);
    return $query->execute([
        'Nom' => $nom,
        'Prenom' => $prenom,
        'IDPersonne' => $IDPersonne
    ]);
}
function updatePersonne($db, $nom, $prenom, $IDPersonne){
    $query = $db -> prepare("UPDATE Personne SET Nom = :Nom, Prenom = :Prenom WHERE IDPersonne = :IDPersonne; "); 
    return $query->execute([
        'Nom' => $nom,
        'Prenom' => $prenom,
        'IDPersonne' => $IDPersonne
    ]);
}

function getEquipeIDPersonne($db, $IDPersonne){
    $query = $db -> prepare("SELECT IDEquipe FROM regrouper WHERE IDPersonne = :IDPersonne "); 
    $query->execute([
        "IDPersonne" => $IDPersonne
    ]);
    $product = $query->fetch();
    return $product;
}
function listePersonnes($db){
    $query = $db -> prepare("SELECT IDPersonne, Nom, Prenom, Email FROM Personne"); 
    $query -> execute([]);
    $liste = $query->fetchAll();
    return $liste;
}

function listeEntreprises($db){
    $query = $db -> prepare("SELECT IDEntre, Nom FROM Entreprise_Cliente"); 
    $query -> execute([]);
    $listeEntre = $query->fetchAll();
    return $listeEntre;
}


function deletePersonne($db, $IDPersonne){
    $query = $db -> prepare("DELETE FROM Personne WHERE IDPersonne = :IDPersonne "); 
    return $query->execute([
        'IDPersonne' => $IDPersonne
    ]);
}
function deleteDev($db, $IDPersonne){
    $query = $db -> prepare("DELETE FROM regrouper WHERE IDPersonne = :IDPersonne");
    $query2 = $db -> prepare("DELETE FROM Equipe WHERE IDPersonne = :IDPersonne");
    $query3 = $db -> prepare("DELETE FROM Dev WHERE IDPersonne = :IDPersonne");
    $query4 = $db -> prepare("DELETE FROM Personne WHERE IDPersonne = :IDPersonne"); 
    $query->execute([
        'IDPersonne' => $IDPersonne]);
    $query2->execute([
            'IDPersonne' => $IDPersonne]);
    $query3->execute([
                'IDPersonne' => $IDPersonne]);
    return $query4->execute([
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

function isDev($db, $IDPersonne){
    $query = $db->prepare("SELECT IdIndice FROM Dev WHERE IDPersonne = :IDPersonne ;");
    $query ->execute([
        'IDPersonne'=> $IDPersonne
    ]);
    $user = $query->fetch();

    return $user;   
}
function isContact($db, $IDPersonne){
    $query = $db->prepare("SELECT IDPersonne FROM Contact WHERE IDPersonne = :IDPersonne ;");
    $query ->execute([
        'IDPersonne'=> $IDPersonne
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

function updateMdp($db, $email, $nouveaumdp)
{
$query = $db -> prepare("UPDATE Personne SET PasswordUser = :nouveaumdp WHERE Email = :email"); 
    return $query->execute([
        'email' => $email,
        'nouveaumdp' => $nouveaumdp
    ]);
}

function getEquipeIDUser($db, $iduser){
    $query = $db->prepare("SELECT IDEquipe FROM regrouper WHERE IDPersonne = :iduser");
    $query ->execute([
        'iduser'=> $iduser,
    ]);
    $equipes = $query->fetchAll();
    return $equipes;
}

function getMembresFromEquipe($db, $idequipe){
    $query = $db->prepare("SELECT Nom, Prenom, Email FROM Personne 
                            INNER JOIN regrouper ON Personne.IDPersonne = regrouper.IDPersonne
                            WHERE regrouper.IDEquipe = :idequipe");
    $query ->execute([
        'idequipe'=> $idequipe,
    ]);
    $membres = $query->fetchAll();
    return $membres;
}

function getChefFromEquipe($db, $idequipe){
    $query = $db->prepare("SELECT Nom, Prenom, Email FROM Personne 
                            INNER JOIN Equipe ON Personne.IDPersonne = Equipe.IDChef
                            WHERE Equipe.IDEquipe = :idequipe");
    $query ->execute([
        'idequipe'=> $idequipe,
    ]);
    $chef = $query->fetch();
    return $chef;
}

function getModulesFromEquipe($db, $idequipe){
    $query = $db->prepare("SELECT IDModule, Etat, IDContrat FROM Module
                            WHERE Module.IDEquipe = :idequipe");
    $query ->execute([
        'idequipe'=> $idequipe,
    ]);
    $chef = $query->fetchAll();
    return $chef;
}

function addOutil($db, $libelle, $version)
{
    $query = $db->prepare("INSERT INTO Outil (Libelle, `Version`) VALUES (:Libelle, :versionlogiciel)");
    return $query->execute([
        'Libelle' => $libelle,
        'versionlogiciel' => $version
    ]);
}

function getAllOutils($db)
{
    $query = $db->prepare("SELECT Code, Libelle, `Version`
                            FROM Outil ");
    $query->execute([]);
    $allOutils = $query->fetchAll();
    return $allOutils;
}

function getOutilsUser($db, $iduser)
{
    $query = $db->prepare("SELECT Outil.Code, Libelle, `Version`
                            FROM Outil 
                            INNER JOIN Maitriser ON Outil.Code = Maitriser.Code
                            WHERE Maitriser.IDPersonne = :idpersonne");
    $query->execute([
        'idpersonne' => $iduser
    ]);
    $OutilsUser = $query->fetchAll();
    return $OutilsUser;
}

function getOutilsRechercher($db, $iduser, $libelleOutil){
    $query = $db->prepare("SELECT Outil.Code, Libelle, `Version`
                            FROM Outil 
                            INNER JOIN Maitriser ON Outil.Code = Maitriser.Code
                            WHERE Maitriser.IDPersonne = :idpersonne AND Outil.Libelle = :libelleOutil");
    $query->execute([
        'idpersonne' => $iduser,
        'libelleOutil' => $libelleOutil
    ]);
    $OutilsUserRechercher = $query->fetchAll();
    return $OutilsUserRechercher;
}

function ajouterMaitriserOutil($db, $iduser, $code)
{
    $query = $db->prepare("INSERT INTO Maitriser (IDPersonne, Code) VALUES (:idpersonne, :code)");
    $query->execute([
        'idpersonne' => $iduser,
        'code' => $code
    ]);
}