<?php
/** 
 * Controleur des comptes-rendus gsb de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */
switch(Controleur::$action)
{
case "liste":	
	Vue::$title = "Consulter les comptes-rendus";
	Vue::configToDataTable("DataTableCompteRendu");
	Vue::$donnees["lesComptesRendusDuVisiteur"] = GsbModele::getLesComptesRendusDuVisiteur(GsbUtilisateur::$Matricule);
	Vue::$donnees["lesComptesRendusDuVisiteurSontVide"] = count(Vue::$donnees["lesComptesRendusDuVisiteur"]) == 0;
	Controleur::composeVue("vues/compte-rendu/liste.php");
	break;

case "valider":	
	// Initialise erreurs
	Vue::$donnees["erreurs"]=array();
	
	// Test l'existance des données envoyé
	if(empty($_POST['numero']))			array_push(Vue::$donnees["erreurs"], "Numéro introuvable");
	if(empty($_POST['datevisite']))		array_push(Vue::$donnees["erreurs"], "Date visite introuvable");
	if(empty($_POST['coefficient']))	array_push(Vue::$donnees["erreurs"], "Coefficient introuvable");
	if(empty($_POST['date']))			array_push(Vue::$donnees["erreurs"], "Date introuvable");
	if(empty($_POST['modif']))			array_push(Vue::$donnees["erreurs"], "Modification introuvable");
	if(empty($_POST['bilan']))			array_push(Vue::$donnees["erreurs"], "Bilan introuvable");
	
	// Test l'existance et la bonne corréspondance 
	if(empty($_POST['choixPraticiens'])) 
		array_push(Vue::$donnees["erreurs"], "Praticien introuvable");
	else if(!is_array(GsbModele::getLePraticienDetailNom($_POST['choixPraticiens']))) 
		array_push(Vue::$donnees["erreurs"], "Praticiens inconnu");    
	
	// Test l'existance et la bonne corréspondance 
	if(empty($_POST['choixProduit1'])) 
		array_push(Vue::$donnees["erreurs"], "Choix du produit 1 introuvable");        
	else if(!is_array(GsbModele::getInfoMedicament($_POST['choixProduit1']))) 
		array_push(Vue::$donnees["erreurs"], "Produit1 inconnu");
	
	// Test l'existance et la bonne corréspondance 
	if(empty($_POST['choixProduit2'])) 
		array_push(Vue::$donnees["erreurs"], "Choix du produit 2 introuvable");
	else if(!is_array(GsbModele::getInfoMedicament($_POST['choixProduit2']))) 
		array_push(Vue::$donnees["erreurs"], "Produit2 inconnu");
	
	// si aucune erreurs est trouvé alors on peut inserer le compte rendu
	if(count(Vue::$donnees["erreurs"])==0) {
		Vue::$title = "Compte-rendu ajouté";
		//insererCR();
		break;
	}

		
case "saisir":	
	Vue::$title = "Saisir un compte-rendu";
	
	// Si aucune erreurs exite (provenant de valider) alors erreurs est initialisé
	if(!isset(Vue::$donnees["erreurs"])) Vue::$donnees["erreurs"] = array();

	// Charge Les liste déroulantes
	Vue::$donnees["lesPraticiens"] = GsbModele::getLesPraticiens();
	Vue::$donnees["lesMedicaments"] = GsbModele::getLesMedicaments();
	
	Controleur::composeVue("vues/compte-rendu/saisie.php");
	break;
}

//include(v_compterendu_saisie.setCompteRendu();
?>
