<?php
function listePersonnesController($twig, $db){
    include_once '../src/model/ProjetModel.php';
   
    
        
    if (isset($_POST['btnDeletePersonne'])) {
        if (!empty($_POST['liste'])){
            foreach($_POST['liste'] as $valeur){
                deletePersonne($db, $valeur);
        }
        }
}
    
    echo $twig->render('listePersonnes.html.twig', ["liste"=> listePersonnes($db),]);
}
?>

