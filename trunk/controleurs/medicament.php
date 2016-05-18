<?php
/** 
 * Controleur des médicaments gsb de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */
switch(Controleur::$action)
{
case "liste":	
	Vue::$title = "Consulter les médicaments";
	Vue::configToDataTable("DataTableMedicaments");
	$lesMedicaments = GsbModele::getLesMedicaments();
	$lesMedicamentsSontVide = count($lesMedicaments) == 0;
	Controleur::composeVue("vues/medicament/liste.php");
	break;

case "details":	
	$lesMedicaments = GsbModele::getLesMedicaments();
	$lesMedicamentsSontVide = count($lesMedicaments) == 0;
	$leMedicament = null;
	$leMedicamentDepot = null;
	$leMedicamentPrecedant = null;
	$leMedicamentSuivant = null;
	if(isset($_GET["depot"])) {
		$leMedicament = GsbModele::getLeMedicamentDetails($_GET["depot"]);
		if($leMedicament && $lesMedicaments) {
			$leMedicamentDepot = $leMedicament["MED_DEPOTLEGAL"];
			$lesMedicamentsTaille = count($lesMedicaments);
			for($i=0; $i<$lesMedicamentsTaille; $i++)
			{
				if($leMedicament["MED_DEPOTLEGAL"]==$lesMedicaments[$i]["MED_DEPOTLEGAL"])
				{
					if($i>0) $leMedicamentPrecedant = $lesMedicaments[$i-1];
					if(($i+1)<$lesMedicamentsTaille) $leMedicamentSuivant = $lesMedicaments[$i+1];
					break; // Arrète le FOR
				}
			}
		}
		else
			$leMedicament = null;
	}
	Vue::$title = "Details médicament";
	Controleur::composeVue("vues/medicament/details.php");
	break;
	
case "saisir":
	break;
	
}

/*
// Action par default 'aucune' 
$action =  ( (isset($_REQUEST['action'])) ? $_REQUEST['action'] : null ) ;
include("vues/v_site_sommaire.php");
switch($action)
{



case "consulter":	
default:	
	$lesMedicaments = $pdo->getLesMedicaments();
	$choixMedicament=null;
	$choixMedicamentBefore=null;
	$choixMedicamentAfter=null;
	if(isset($_REQUEST['choix']))
	{
		$leMedicament = $pdo->getInfoMedicament($_REQUEST['choix']);
		if(is_array($leMedicament)) 
		{
			$choixMedicament=$leMedicament;
			for($i=0; $i<count($lesMedicaments); $i++)
			{
				if($choixMedicament["MED_DEPOTLEGAL"]==$lesMedicaments[$i]["MED_DEPOTLEGAL"])
				{
					if($i>0) $choixMedicamentBefore = $lesMedicaments[$i-1];
					if(($i+1)<count($lesMedicaments)) $choixMedicamentAfter = $lesMedicaments[$i+1];
					break;
				}
			}
		}
	}
	include "vues/v_medicament_consulterDetails.php";
}



?>*/
