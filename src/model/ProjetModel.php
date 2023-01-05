<?php

function addPersonne($db, $nom, $prenom)
{
    $query = $db->prepare("INSERT INTO Personne (Nom, Prenom) VALUES (:Nom, :Prenom)");
    return $query->execute([
        'Nom' => $nom,
        'Prenom' => $prenom
    ]);
}
