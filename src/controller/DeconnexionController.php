<?php

function deconnexionController($twig, $db) {
    $_SESSION['deconnexion'] = 0;
    echo $twig -> render('login.html.twig', []);
}