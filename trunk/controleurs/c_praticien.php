<?php

// Action par default 'aucune' 
$action =  ( (isset($_REQUEST['action'])) ? $_REQUEST['action'] : NULL ) ;
include("vues/v_site_sommaire.php");

switch($action)
{
case 'Liste':	
	
    $lesPraticiens = $pdo->getLesPraticiens();
    $choixPraticien=null;
    if(isset($_REQUEST['choix']))
    {
            $lePraticien = $pdo->getLePraticienDetailNom($_REQUEST['choix']);
            if(is_array($lePraticien))
                $choixPraticien=$lePraticien;
    }
    include("vues/v_praticien_consulterDetails.php");
    break;
        
default:
case 'Tous':
    $lesPraticiens=$pdo->getLesPraticiens();
    include("vues/v_praticien_consulter.php");
    break;
}

?>
