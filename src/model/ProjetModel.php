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

#function addCoPersonne($db, $rue, $ville, $code_postal, $email)
#{
#    $query = $db->prepare("INSERT INTO Coordonnees (Rue, Ville, Code_Postal, email, IDPersonne) VALUES (:Rue, :Ville, :Code_Postal, :email, ")
#
#}
