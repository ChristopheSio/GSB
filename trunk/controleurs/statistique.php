<?php
/** 
 * Controleur des statistiques gsb de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */
switch(Controleur::$action)
{
case "famille-medicaments":	
	Vue::$title = "Famille de médicaments";
	Vue::configToDataTable("DataTableStatistique");
	Vue::$donnees["familleMedicament"] = GsbModele::statFamilleMedicament();
	Controleur::composeVue("vues/statistique/famille-medicaments.php");
	break;

/*case "medicaments-offerts":	
	Vue::$title = "Famille de médicaments";
	Vue::configToDataTable("DataTablePraticien");
	Vue::$donnees["lesPraticiens"] = GsbModele::getLesPraticiens();
	Vue::$donnees["lesPraticiensSontVide"] = count(Vue::$donnees["lesPraticiens"]) == 0;
	Controleur::composeVue("vues/praticien/liste.php");
	break;

    
case "localisation-praticiens":	
	Vue::$title = "Famille de médicaments";
	Vue::configToDataTable("DataTablePraticien");
	Vue::$donnees["lesPraticiens"] = GsbModele::getLesPraticiens();
	Vue::$donnees["lesPraticiensSontVide"] = count(Vue::$donnees["lesPraticiens"]) == 0;
	Controleur::composeVue("vues/praticien/liste.php");
	break;

    case "laboratoires":	
	Vue::$title = "Famille de médicaments";
	Vue::configToDataTable("DataTablePraticien");
	Vue::$donnees["lesPraticiens"] = GsbModele::getLesPraticiens();
	Vue::$donnees["lesPraticiensSontVide"] = count(Vue::$donnees["lesPraticiens"]) == 0;
	Controleur::composeVue("vues/praticien/liste.php");
	break;
    
    case "rapports-visite":	
	Vue::$title = "Famille de médicaments";
	Vue::configToDataTable("DataTablePraticien");
	Vue::$donnees["lesPraticiens"] = GsbModele::getLesPraticiens();
	Vue::$donnees["lesPraticiensSontVide"] = count(Vue::$donnees["lesPraticiens"]) == 0;
	Controleur::composeVue("vues/praticien/liste.php");
	break;
    
    case "roles":	
	Vue::$title = "Famille de médicaments";
	Vue::configToDataTable("DataTablePraticien");
	Vue::$donnees["lesPraticiens"] = GsbModele::getLesPraticiens();
	Vue::$donnees["lesPraticiensSontVide"] = count(Vue::$donnees["lesPraticiens"]) == 0;
	Controleur::composeVue("vues/praticien/liste.php");
	break;

     case "type-praticiens":	
	Vue::$title = "Famille de médicaments";
	Vue::configToDataTable("DataTablePraticien");
	Vue::$donnees["lesPraticiens"] = GsbModele::getLesPraticiens();
	Vue::$donnees["lesPraticiensSontVide"] = count(Vue::$donnees["lesPraticiens"]) == 0;
	Controleur::composeVue("vues/praticien/liste.php");
	break; */
    
    
    
    
    
case "details":	
	Vue::$donnees["lesPraticiens"] = GsbModele::getLesPraticiens();
	Vue::$donnees["lesPraticiensSontVide"] = count(Vue::$donnees["lesPraticiens"]) == 0;
	Vue::$donnees["lePraticien"] = null;
	Vue::$donnees["lePraticienNum"] = null;
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
}