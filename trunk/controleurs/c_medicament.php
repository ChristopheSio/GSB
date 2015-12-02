<?php

// Action par default 'aucune' 
$action =  ( (isset($_REQUEST['action'])) ? $_REQUEST['action'] : null ) ;
include("vues/v_site_sommaire.php");
switch($action)
{
case "saisir":
	
	break;

case "liste":
	$lesMedicaments = $pdo->getLesMedicaments();
	include "vues/v_medicament_consulter.php";
	break;


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



?>
