<?php

function homeController($twig, $db) {
    echo $twig->render('home.html.twig',[]);

}