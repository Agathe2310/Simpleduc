<?php

function getAllMessages($db)
{
    $query = $db->prepare("SELECT *
                            FROM `Message` ");
    $query->execute([]);
    $allMessages = $query->fetchAll();
    return $allMessages;
}

function getMessageFromDest($db, $id)
{
    $query = $db->prepare(
        "SELECT * 
                            FROM `Message` 
                            WHERE :id = Destinataire
                            ORDER BY Lu"
    );
    $query->execute([
        'id' => $id
    ]);
    $message = $query->fetchAll();
    return $message;
}

function getMessageFromEmet($db, $id)
{
    $query = $db->prepare(
        "SELECT * 
                            FROM `Message` 
                            WHERE :id = Emetteur
                            ORDER BY Lu DESC"
    );
    $query->execute([
        'id' => $id
    ]);
    $message = $query->fetchAll();
    return $message;
}

function getMessageFromID($db, $id)
{
    $query = $db->prepare("SELECT * 
                            FROM `Message` 
                            WHERE :id = IDMessage");
    $query->execute([
        'id' => $id
    ]);
    $message = $query->fetch();
    return $message;
}

function setMessageLu($db, $id, $bool)
{
    $query = $db->prepare("UPDATE `Message`
                            SET Lu=:bool
                            WHERE :id = IDMessage");
    $query->execute([
        'id' => $id,
        'bool' => $bool
    ]);
}

function suppMessage($db, $id)
{
    $query = $db->prepare("DELETE FROM `Message`
                            WHERE IDMessage = :id ");
    $query->execute([
        'id' => $id
    ]);
}

function getMessagesNonLu($db, $id)
{
    $query = $db->prepare("SELECT * 
                            FROM `Message` 
                            WHERE :id = Destinataire AND Lu=0");
    $query->execute([
        'id' => $id
    ]);
    $message = $query->fetchAll();
    return $message;
}

function addMessage($db, $emet, $dest, $obj, $message)
{
    $query = $db->prepare("INSERT INTO `Message`(Destinataire, Emetteur, Objet, Sujet, `Date`, Lu) VALUES (:Destinataire, :Emetteur, :Objet, :Sujet, NOW(), :Lu)");
    $query->execute([
        'Destinataire' => $dest,
        'Emetteur' => $emet,
        'Objet' => $obj,
        'Sujet' => $message,
        'Lu' => 0
    ]);
}
