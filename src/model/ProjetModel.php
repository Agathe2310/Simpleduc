<?php

function addPersonne($db, $nom, $prenom)
{
    $query = $db->prepare("INSERT INTO Personne (Nom, Prenom) VALUES (:Nom, :Prenom)");
    return $query->execute([
        'Nom' => $nom,
        'Prenom' => $prenom
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