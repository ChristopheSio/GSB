<?php
/** 
 * Controleur des practiciens gsb de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */

switch(Controleur::$action)
{
case "liste":	
	Vue::$title = "Consulter les praticiens";
	Vue::configToDataTable("DataTablePraticien");
	$lesPraticiens = GsbModele::getLesPraticiens();
	$lesPraticiens = GsbModele::getLesPraticiens();
	$lesPraticiensSontVide = count($lesPraticiens) == 0;
	Controleur::composeVue("vues/praticien/liste.php");
	break;

case "details":	
	$lesPraticiens = GsbModele::getLesPraticiens();
	$lesPraticiensSontVide = count($lesPraticiens) == 0;
	$lePraticien = null;
	$lePraticienNum = null;
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
}