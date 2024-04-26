<?php

function dbErrorController($twig) {
    echo $twig -> render('dbError.html.twig', []);
}