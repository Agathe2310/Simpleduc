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
    $liste = listePersonnes($db);
    $listeDev = array();
    $listeContact = array();
    foreach ($liste as $i){
        $var1 = isDev($db, $i[0]);
        #var_dump( $var);
        if ($var1 !== false){
            array_push($listeDev, $i);
        }
        $var2 = isContact($db, $i[0]);
        if ($var2 !== false){
            if ($var1 == false){
                array_push($listeContact, $i);
            }
        }
        
    }


    if (isset($_POST['btnModifPersonne'])) {
        echo $twig->render('modifPersonne.html.twig', []);
}
if (isset($_POST['btnModifDev'])) {
    echo $twig->render('modifDev.html.twig', []);
}
    echo $twig->render('listePersonnes.html.twig', ["liste"=> $liste, "listeDev"=>$listeDev, "listeContact"=>$listeContact,]);


}
?>
