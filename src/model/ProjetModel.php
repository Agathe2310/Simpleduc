<?php

function addPersonne($db, $nom, $prenom)
{
    $query = $db->prepare("INSERT INTO Personne (Nom, Prenom) VALUES (:Nom, :Prenom)");
    return $query->execute([
        'Nom' => $nom,
        'Prenom' => $prenom
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

function addTache($db, $libelle, $etat, $dateDebut, $dateFin)
{
    $query = $db->prepare("INSERT INTO Module (Etat, IDEquipe, IDContrat) VALUES (:Etat, :IDEquipe, :IDContrat)");
    return $query->execute([
        'Etat' => $etat,
        'IDEquipe' => $dateDebut,
        'IDContrat' => $dateFin
    ]);
}

function getAllModules($db)
{
    $query = $db->prepare("SELECT IDModule, Etat, IDEquipe, IDContrat FROM Module");
    $query->execute([]);

    $product = $query->fetchAll();

    return $product;
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