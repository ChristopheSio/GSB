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
	Vue::$title = "Consulter les medicaments";
	Vue::configToDataTable("DataTableMedicaments");
	Vue::$donnees["lesMedicaments"] = GsbModele::getLesMedicaments();
	Vue::$donnees["lesMedicamentsSontVide"] = count(Vue::$donnees["lesMedicaments"]) == 0;
	Controleur::composeVue("vues/medicament/liste.php");
	break;

case "details":	
	Vue::$donnees["lesMedicaments"] = GsbModele::getLesMedicaments();
	Vue::$donnees["lesMedicamentsSontVide"] = count(Vue::$donnees["lesMedicaments"]) == 0;
	Vue::$donnees["leMedicament"] = null;
	Vue::$donnees["leMedicamentDepot"] = null;
	Vue::$donnees["leMedicamentPrecedant"] = null;
	Vue::$donnees["leMedicamentSuivant"] = null;
	if(isset($_GET["depot"])) {
		Vue::$donnees["leMedicament"] = GsbModele::getLeMedicamentDetails($_GET["depot"]);
		if(Vue::$donnees["leMedicament"] && Vue::$donnees["lesMedicaments"]) {
			Vue::$donnees["leMedicamentDepot"] = Vue::$donnees["leMedicament"]["MED_DEPOTLEGAL"];
			$lesMedicamentsTaille = count(Vue::$donnees["lesMedicaments"]);
			for($i=0; $i<$lesMedicamentsTaille; $i++)
			{
				if(Vue::$donnees["leMedicament"]["MED_DEPOTLEGAL"]==Vue::$donnees["lesMedicaments"][$i]["MED_DEPOTLEGAL"])
				{
					if($i>0) Vue::$donnees["leMedicamentPrecedant"] = Vue::$donnees["lesMedicaments"][$i-1];
					if(($i+1)<$lesMedicamentsTaille) Vue::$donnees["leMedicamentSuivant"] = Vue::$donnees["lesMedicaments"][$i+1];
					break; // Arrète le FOR
				}
			}
		}
		else
			Vue::$donnees["leMedicament"] = null;
	}
	Vue::$title = "Details medicament";
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
