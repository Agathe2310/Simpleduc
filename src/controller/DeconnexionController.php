<?php

function deconnexionController($twig, $db) {
    $_SESSION['deconnexion'] = 0;
    header("Location: index.php");
}