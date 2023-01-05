<?php

function addPersonne($db, $nom, $prenom)
{
<<<<<<< Updated upstream
    $query = $db->prepare("INSERT INTO Personne (Nom, Prenom) VALUES (:Nom, :Prenom)");
    return $query->execute([
        'Nom' => $nom,
        'Prenom' => $prenom
    ]);
}
=======
    $query = $db->prepare("INSERT INTO Personne (Nom, Prénom) VALUES (:nom, :prenom)");
    return $query->execute([
        'Nom' => $nom,
        'Prénom' => $prenom,
    ]);
}

function addContrat($db, $DateSignature, $CoutGlobal, $DateDebut, $DateFin, $IDPersonne, $IDEntre)
>>>>>>> Stashed changes
