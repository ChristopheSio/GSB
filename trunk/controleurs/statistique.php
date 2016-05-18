<?php
/** 
 * Controleur des statistiques gsb de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */

// Verifie que l'utilisateur est connecté
Controleur::doitValiderAutorisation( GsbUtilisateur::estConnecte() );

switch(Controleur::$action)
{
    case "famille-medicaments":	
	Vue::$title = "Famille de médicaments";
	Vue::configToDataTable("DataTableStatistique");
	$familleMedicament = GsbModele::statFamilleMedicament();
	// 
	$graphiqueData = array();
	foreach($familleMedicament["stat"] as $uneFamille) {
		$graphiqueData[] = array(
			"label"=>($uneFamille["FAM_CODE"]." : ".$uneFamille["FAM_LIBELLE"]), 
			"data" => $uneFamille["nb"]   
		);
	}
	Vue::configToGraphiqueCamembert("CamembertStatistique",$graphiqueData); // Ajoute un cammember
	//
	Controleur::composeVue("vues/statistique/famille-medicaments.php");
	break;

    /*case "medicaments-offerts":	
	Vue::$title = "Famille de médicaments";
	Vue::configToDataTable("DataTablePraticien");
	$lesPraticiens = GsbModele::getLesPraticiens();
	$lesPraticiensSontVide = count($lesPraticiens) == 0;
	Controleur::composeVue("vues/praticien/liste.php");
	break;

    
    case "localisation-praticiens":	
	Vue::$title = "Famille de médicaments";
	Vue::configToDataTable("DataTablePraticien");
	$lesPraticiens = GsbModele::getLesPraticiens();
	$lesPraticiensSontVide = count($lesPraticiens) == 0;
	Controleur::composeVue("vues/praticien/liste.php");
	break;

    case "laboratoires":	
	Vue::$title = "Famille de médicaments";
	Vue::configToDataTable("DataTablePraticien");
	$lesPraticiens = GsbModele::getLesPraticiens();
	$lesPraticiensSontVide = count($lesPraticiens) == 0;
	Controleur::composeVue("vues/praticien/liste.php");
	break;
    
    case "rapports-visite":	
	Vue::$title = "Famille de médicaments";
	Vue::configToDataTable("DataTablePraticien");
	$lesPraticiens = GsbModele::getLesPraticiens();
	$lesPraticiensSontVide = count($lesPraticiens) == 0;
	Controleur::composeVue("vues/praticien/liste.php");
	break;
    
    case "roles":	
	Vue::$title = "Famille de médicaments";
	Vue::configToDataTable("DataTablePraticien");
	$lesPraticiens = GsbModele::getLesPraticiens();
	$lesPraticiensSontVide = count($lesPraticiens) == 0;
	Controleur::composeVue("vues/praticien/liste.php");
	break; */

    case "type-praticiens":	
	Vue::$title = "Types de praticien";
	Vue::configToDataTable("DataTableStatistique");
	$lesPraticiens = GsbModele::statPraticienType();
	$lesPraticiensSontVide = count($lesPraticiens) == 0;
	Controleur::composeVue("vues/statistique/type-praticiens.php");
	break;
    
    case "visite-labo":	
	Vue::$title = "Visites de labo";
	Vue::configToDataTable("DataTableStatistique");
	$lesVisiteurs = GsbModele::statVisiteLabo();
	$lesVisiteursSontVide = count($lesVisiteurs) == 0;
	Controleur::composeVue("vues/statistique/visite-labo.php");
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