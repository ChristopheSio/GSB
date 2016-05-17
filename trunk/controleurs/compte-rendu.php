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

/*
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
*/
		
case "saisie-echantitillonsDonnees":	
	OutilsForm::ajaxMultipleDonneesInfo();
	Vue::$donnees["lesMedicaments"] = GsbModele::getLesMedicaments();
	Vue::$donnees["choixMedicament"] = "";
	Vue::$donnees["qteOfferte"] = 1;
	Vue::$donnees["valid"]["choixMedicament"]=1;
	Vue::$donnees["valid"]["qteOfferte"]=1;
	// Si formulaire
	if(isset($_POST["choixMedicament"]) && isset($_POST["qteOfferte"])) {
		Vue::$donnees["choixMedicament"] = $_POST["choixMedicament"];
		Vue::$donnees["qteOfferte"] = $_POST["qteOfferte"];
	}
	Controleur::composeAjaxVue("vues/compte-rendu/saisie-echantitillonsDonnees.php");
	break;
case "saisir":	
	Vue::$title = "Saisir un comptes-rendu";
	Vue::$donnees["okForm"] = false;
	Vue::$donnees["okCompteRendu"] = false;
	// Charge les liste déroulantes
	Vue::$donnees["lesMotifs"] = array( "Actualisation annuelle", "Rapport annuel", "Baisse activité"  );
	Vue::$donnees["lesPraticiens"] = GsbModele::getLesPraticiensPourCompteRendu();
	Vue::$donnees["lesMedicaments"] = GsbModele::getLesMedicaments();
	// Données auto
	Vue::$donnees["info_connexion"] = null;
	Vue::$donnees["numero"] = GsbModele::getCompteRenduLeDernierNumeroDuVisiteur(GsbUtilisateur::$Matricule)+1;
	// Données saisie
	Vue::$donnees["dateVisite"]=date("Y-m-d" );
	Vue::$donnees["choixPraticien"]="";
	Vue::$donnees["remplacant"]=0;
	Vue::$donnees["choixMotif"]="no";
	Vue::$donnees["motifAutre"]="";
	Vue::$donnees["motifAutreActive"]=false;
	Vue::$donnees["bilan"]="";
	Vue::$donnees["documentation"]="";
	Vue::$donnees["echantitillons"]="";
	Vue::$donnees["echantitillonsDonnees"] = OutilsForm::receptionnnerMultipleDonnees("echantitillonsDonnees",25,  OutilsUrl::composer("compte-rendu","saisie-echantitillonsDonnees"),array("choicMedicament","qteOfferte"));
	// Valider
	Vue::$donnees["valid"] = array();
	Vue::$donnees["valid"]["dateVisite"]=1;
	Vue::$donnees["valid"]["choixPraticien"]=1;
	Vue::$donnees["valid"]["remplacant"]=1;
	Vue::$donnees["valid"]["choixMotif"]=1;
	Vue::$donnees["valid"]["motifAutre"]=1;
	Vue::$donnees["valid"]["bilan"]=1;
	Vue::$donnees["valid"]["documentation"]=1;
	Vue::$donnees["valid"]["echantitillons"]=1;
	Vue::$donnees["valid"]["echantitillonsDonnees"]=null;
	
	
	// Si Formulaire
	if( isset($hop) 
	) {
		
		
		
		// Si la clé du formilaire n'est pas valide
		if( $_SESSION["FormConpteRenduHashkey"] !== $_POST["hashkey"]) {
			Vue::$donnees["info_connexion"] = "Erreur, securité de connexion !";
		}
	}
	
	
	
	// Permet de verifié l'envoie du bon message
	
	
	//  Si aucune erreurs exite (provenant de valider) alors erreurs est initialisé
	if(!isset(Vue::$donnees["erreurs"])) Vue::$donnees["erreurs"] = array();

	//
	OutilsForm::genFormulaireId("compte-rendu-saisie");
	Controleur::composeVue("vues/compte-rendu/saisie.php");
	break;
}

//include(v_compterendu_saisie.setCompteRendu();
?>
