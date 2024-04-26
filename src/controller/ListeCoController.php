<?php
function listeCoController($twig, $db, $nbNotifs){
    include_once '../src/model/ProjetModel.php';
        
    echo $twig->render('listeCo.html.twig', ["liste"=> getAllCo($db)]);

    if (isset($_POST['btnModifPersonne'])) {
        echo $twig->render('modifPersonne.html.twig', ["co"=> getCo($db, $IDPersonne),
        'nbNotifs' => $nbNotifs]);
}

}
?>