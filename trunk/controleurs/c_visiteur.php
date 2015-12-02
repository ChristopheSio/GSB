<?php
/*include("vues/v_sommaire.php");
// Action par default 'aucune' 
$action =  ( (isset($_REQUEST['action'])) ? $_REQUEST['action'] : 'aucune' ) ;

switch($action)
{
	case 'saisir':
	break;

	case 'consulter':
		$lesVisiteur=$pdo->getLesVisiteurs();
		include("vues/v_visiteur_consulter.php");
	break;
	
}*/

include("vues/v_site_sommaire.php");
$lesVisiteurs=$pdo->getLesVisiteurs();
include("vues/v_visiteur_consulter.php");



?>
