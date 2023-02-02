<?php
function listePersonnesController($twig, $db, $nbNotifs){
    include_once '../src/model/ProjetModel.php';
   
    
        
    if (isset($_POST['btnDeletePersonne'])) {
        if (!empty($_POST['liste'])){
            foreach($_POST['liste'] as $valeur){
                $estundev = isDev($db, $valeur);
                if ($estundev !== false){
                    deleteDev($db, $valeur);
                }
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
        echo $twig->render('modifPersonne.html.twig', [
        'nbNotifs' => $nbNotifs]);
}
if (isset($_POST['btnModifDev'])) {
    echo $twig->render('modifDev.html.twig', []);
}

if (isset($_POST['btnCo'])){
    $valeur = $_POST['btnCo'];
    $personne = getPersonne($db, $valeur);
    $co = hasco($db, $valeur);
    var_dump($valeur);
    var_dump($co);
    if (count($co) ==0){
        header("location: ?page=addCoPersonne&id=".$valeur."");
    }else{
        header("location: ?page=modifCoPersonne&id=".$valeur."");
    }
}else{
    echo $twig->render('listePersonnes.html.twig', ["liste"=> $liste, "listeDev"=>$listeDev, "listeContact"=>$listeContact,]);
}



}
?>
