<?php
/** 
 * Controleur des visiteurs gsb de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */
switch(Controleur::$action)
{
case "liste":	
	Vue::$title = "Consulter les praticiens";
	Vue::configToDataTable("DataTableVisiteur");
	Vue::$donnees["lesVisiteurs"] = GsbModele::getLesVisiteurs();
	Vue::$donnees["lesVisiteursSontVide"] = count(Vue::$donnees["lesVisiteurs"]) == 0;
	Controleur::composeVue("vues/visiteur/liste.php");
	break;

/*
case "details":	
	Vue::$donnees["lesPraticiens"] = GsbModele::getLesPraticiens();
	Vue::$donnees["lesPraticiensSontVide"] = count(Vue::$donnees["lesPraticiens"]) == 0;
	Vue::$donnees["lePraticien"] = null;
	Vue::$donnees["lePraticienNum"] = null;
	if(isset($_GET["num"])) {
		Vue::$donnees["lePraticien"] = GsbModele::getLePraticienDetails($_GET["num"]);
		if(Vue::$donnees["lesPraticiens"]) 
			Vue::$donnees["lePraticienNum"] = Vue::$donnees["lePraticien"]["PRA_NUM"];
		else
			Vue::$donnees["lePraticien"] = null;
	}
	
	Vue::$donnees["lesPraticiens"] = GsbModele::getLesPraticiens();
	Vue::$donnees["lesPraticiensSontVide"] = count(Vue::$donnees["lesPraticiens"]) == 0;
	Vue::$donnees["lePraticien"] = null;
	Vue::$donnees["lePraticienDepot"] = null;
	Vue::$donnees["lePraticienPrecedant"] = null;
	Vue::$donnees["lePraticienSuivant"] = null;
	if(isset($_GET["num"])) {
		Vue::$donnees["lePraticien"] = GsbModele::getLePraticienDetails($_GET["num"]);
		if(Vue::$donnees["lePraticien"] && Vue::$donnees["lesPraticiens"]) {
			Vue::$donnees["lePraticienNum"] = Vue::$donnees["lePraticien"]["PRA_NUM"];
			$lesPraticiensTaille = count(Vue::$donnees["lesPraticiens"]);
			for($i=0; $i<$lesPraticiensTaille; $i++)
			{
				if(Vue::$donnees["lePraticien"]["PRA_NUM"]==Vue::$donnees["lesPraticiens"][$i]["PRA_NUM"])
				{
					if($i>0) Vue::$donnees["lePraticienPrecedant"] = Vue::$donnees["lesPraticiens"][$i-1];
					if(($i+1)<$lesPraticiensTaille) Vue::$donnees["lePraticienSuivant"] = Vue::$donnees["lesPraticiens"][$i+1];
					break; // Arrète le FOR
				}
			}
		}
		else
			Vue::$donnees["lePraticien"] = null;
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
