<?php
/** 
 * Controleur des visiteurs gsb de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */

// Verifie que l'utilisateur est connecté
Controleur::doitValiderAutorisation( GsbUtilisateur::estConnecte() );

switch(Controleur::$action)
{
case "liste":	
	// Verifie que l'utilisateur est délégué
	Controleur::doitValiderAutorisation( GsbUtilisateur::estRoleResponsable(), "Vous devez être responsable" );
	//
	Vue::$title = "Consulter les visiteurs";
	Vue::configToDataTable("DataTableVisiteur");
	$lesVisiteurs = GsbModele::getLesVisiteurs();
	$lesVisiteursSontVide = count($lesVisiteurs) == 0;
	Controleur::composeVue("vues/visiteur/liste.php");
	break;

/*
case "details":	
	$lesPraticiens = GsbModele::getLesPraticiens();
	$lesPraticiensSontVide = count($lesPraticiens) == 0;
	$lePraticien = null;
	$lePraticienNum = null;
	if(isset($_GET["num"])) {
		$lePraticien = GsbModele::getLePraticienDetails($_GET["num"]);
		if($lesPraticiens) 
			$lePraticienNum = $lePraticien["PRA_NUM"];
		else
			$lePraticien = null;
	}
	
	$lesPraticiens = GsbModele::getLesPraticiens();
	$lesPraticiensSontVide = count($lesPraticiens) == 0;
	$lePraticien = null;
	$lePraticienDepot = null;
	$lePraticienPrecedant = null;
	$lePraticienSuivant = null;
	if(isset($_GET["num"])) {
		$lePraticien = GsbModele::getLePraticienDetails($_GET["num"]);
		if($lePraticien && $lesPraticiens) {
			$lePraticienNum = $lePraticien["PRA_NUM"];
			$lesPraticiensTaille = count($lesPraticiens);
			for($i=0; $i<$lesPraticiensTaille; $i++)
			{
				if($lePraticien["PRA_NUM"]==$lesPraticiens[$i]["PRA_NUM"])
				{
					if($i>0) $lePraticienPrecedant = $lesPraticiens[$i-1];
					if(($i+1)<$lesPraticiensTaille) $lePraticienSuivant = $lesPraticiens[$i+1];
					break; // Arrète le FOR
				}
			}
		}
		else
			$lePraticien = null;
	}
	Vue::$title = "Details praticiens";
	Controleur::composeVue("vues/praticien/details.php");
	break;
*/

}

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
	
}

include("vues/v_site_sommaire.php");
$lesVisiteurs=$pdo->getLesVisiteurs();
include("vues/v_visiteur_consulter.php");
*/
