<?php

// Action par default 'aucune' 
$action = ( (isset($_REQUEST['action'])) ? $_REQUEST['action'] : null );
include("vues/v_site_sommaire.php");
switch ($action) {

    
    case "saisir":
        $errors=array();
        $lesPraticiens = $pdo->getLesPraticiens();
        $lesMedicaments = $pdo->getLesMedicaments();
        include("vues/v_compte-rendu_saisie.php");
        break;
    
    
    case "valider":
        var_dump($_POST);
        
        $errors=array();
        
        // Test valeur
        if(empty($_POST['numero'])) array_push($errors, "NumÃ©ro introuvable");
        if(empty($_POST['datevisite'])) array_push($errors, "Date visite introuvable");
        
        if(empty($_POST['coefficient'])) array_push($errors, "Coefficient introuvable");
        if(empty($_POST['date'])) array_push($errors, "Date introuvable");
        if(empty($_POST['modif'])) array_push($errors, "Modification introuvable");
        if(empty($_POST['bilan'])) array_push($errors, "Bilan introuvable");
        
        
        
        
        if(empty($_POST['choixPraticiens'])) array_push($errors, "Praticien introuvable");
        else if(!is_array($pdo->getLePraticienDetailNom($_POST['choixPraticiens']))) array_push($errors, "Praticiens inconnu");    
        
        if(empty($_POST['choixProduit1'])) array_push($errors, "Choix du produit 1 introuvable");        
        else if(!is_array($pdo->getInfoMedicament($_POST['choixProduit1']))) array_push($errors, "Produit1 inconnu");
        
        if(empty($_POST['choixProduit2'])) array_push($errors, "Choix du produit 2 introuvable");
        else if(!is_array($pdo->getInfoMedicament($_POST['choixProduit2']))) array_push($errors, "Produit2 inconnu");
        
        
        
        
        if(count($errors)>0){
            $lesPraticiens = $pdo->getLesPraticiens();
            $lesMedicaments = $pdo->getLesMedicaments();
            include("vues/v_compte-rendu_saisie.php");
        }
        else{
        insererCR();
        }
        
        
        
        
        
        
        
        break;
    
    /*
        include("vues/v_compterendu_saisie.php");
        break;
    */
    
    case "consulter":
        $lesComptesRendusDuVisiteur = $pdo->getLesComptesRendusDuVisiteur($_SESSION['id']);
        include("vues/v_compte-rendu_consulter.php");
        break;
    
   
}
//include(v_compterendu_saisie.setCompteRendu();
?>
