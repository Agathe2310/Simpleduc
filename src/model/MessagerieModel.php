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
    $query = $db->prepare("SELECT * 
                            FROM `Message` 
                            WHERE :id = Destinataire");
    $query->execute([
        'id' => $id
    ]);
    $message = $query->fetchAll();
    return $message;
}

function getMessageFromEmet($db, $id)
{
    $query = $db->prepare("SELECT * 
                            FROM `Message` 
                            WHERE :id = Emetteur");
    $query->execute([
        'id' => $id
    ]);
    $message = $query->fetch();
    return $message;
}