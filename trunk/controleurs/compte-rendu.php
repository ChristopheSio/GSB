<?php
/** 
 * Controleur des comptes-rendus gsb de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */

// Verifie que l'utilisateur est connecté
Controleur::doitValiderAutorisation( GsbUtilisateur::estConnecte() );

switch(Controleur::$action)
{
case "region-liste":
	// Verifie que l'utilisateur est délégué
	Controleur::doitValiderAutorisation( GsbUtilisateur::estRoleDelegue(), "Vous devez être délégué" );
	//
	Vue::configToDataTable("DataTableCompteRendu");
	$leVisiteurRole = GsbModele::getLeVisiteurRole(GsbUtilisateur::$Matricule);
	Vue::$title = "Consulter les comptes-rendus de la region ".$leVisiteurRole["REG_NOM"]." (".$leVisiteurRole["REG_CODE"].")";	
	$lesComptesRendusDeLaRegion = GsbModele::getLesComptesRendusDeLaRegion($leVisiteurRole["REG_CODE"]);
	$lesComptesRendusDeLaRegionSontVide = count($lesComptesRendusDeLaRegion) == 0;
	Controleur::composeVue("vues/compte-rendu/region-liste.php");
	break;
	
case "liste":	
	Vue::$title = "Consulter les comptes-rendus";
	Vue::configToDataTable("DataTableCompteRendu");
	$lesComptesRendusDuVisiteur = GsbModele::getLesComptesRendusDuVisiteur(GsbUtilisateur::$Matricule);
	$lesComptesRendusDuVisiteurSontVide = count($lesComptesRendusDuVisiteur) == 0;
	Controleur::composeVue("vues/compte-rendu/liste.php");
	break;

/*
case "valider":	
	// Initialise erreurs
	$erreurs=array();
	
	// Test l'existance des données envoyé
	if(empty($_POST['numero']))			array_push($erreurs, "Numéro introuvable");
	if(empty($_POST['datevisite']))		array_push($erreurs, "Date visite introuvable");
	if(empty($_POST['coefficient']))	array_push($erreurs, "Coefficient introuvable");
	if(empty($_POST['date']))			array_push($erreurs, "Date introuvable");
	if(empty($_POST['modif']))			array_push($erreurs, "Modification introuvable");
	if(empty($_POST['bilan']))			array_push($erreurs, "Bilan introuvable");
	
	// Test l'existance et la bonne corréspondance 
	if(empty($_POST['choixPraticiens'])) 
		array_push($erreurs, "Praticien introuvable");
	else if(!is_array(GsbModele::getLePraticienDetailNom($_POST['choixPraticiens']))) 
		array_push($erreurs, "Praticiens inconnu");    
	
	// Test l'existance et la bonne corréspondance 
	if(empty($_POST['choixProduit1'])) 
		array_push($erreurs, "Choix du produit 1 introuvable");        
	else if(!is_array(GsbModele::getInfoMedicament($_POST['choixProduit1']))) 
		array_push($erreurs, "Produit1 inconnu");
	
	// Test l'existance et la bonne corréspondance 
	if(empty($_POST['choixProduit2'])) 
		array_push($erreurs, "Choix du produit 2 introuvable");
	else if(!is_array(GsbModele::getInfoMedicament($_POST['choixProduit2']))) 
		array_push($erreurs, "Produit2 inconnu");
	
	// si aucune erreurs est trouvé alors on peut inserer le compte rendu
	if(count($erreurs)==0) {
		Vue::$title = "Compte-rendu ajouté";
		//insererCR();
		break;
	}
*/
		
case "saisie-echantitillonsDonnees":	
	OutilsForm::ajaxMultipleDonneesInfo();
	$lesMedicaments = GsbModele::getLesMedicaments();
	$choixMedicament = "";
	$qteOfferte = 1;
	$valid["choixMedicament"]=1;
	$valid["qteOfferte"]=1;
	// Si formulaire
	if(isset($_POST["choixMedicament"]) && isset($_POST["qteOfferte"])) {
		$choixMedicament = $_POST["choixMedicament"];
		$qteOfferte = $_POST["qteOfferte"];
	}
	Controleur::composeAjaxVue("vues/compte-rendu/saisie-echantitillonsDonnees.php");
	break;
case "saisir":	
	Vue::$title = "Saisir un comptes-rendu";
	$okForm = false;
	$okCompteRendu = false;
	// Charge les liste déroulantes
	$lesMotifs = array( "Actualisation annuelle", "Rapport annuel", "Baisse activité"  );
	$lesPraticiens = GsbModele::getLesPraticiensPourCompteRendu();
	$lesMedicaments = GsbModele::getLesMedicaments();
	// Données auto
	$info_connexion = null;
	$numero = GsbModele::getCompteRenduLeDernierNumeroDuVisiteur(GsbUtilisateur::$Matricule)+1;
	// Données saisie
	$dateVisite=date("Y-m-d" );
	$choixPraticien="";
	$remplacant=0;
	$choixMotif="no";
	$motifAutre="";
	$motifAutreActive=false;
	$bilan="";
	$documentation="";
	$echantitillons="";
	$echantitillonsDonnees = OutilsForm::receptionnnerMultipleDonnees("echantitillonsDonnees",25,  OutilsUrl::composer("compte-rendu","saisie-echantitillonsDonnees"),array("choicMedicament","qteOfferte"));
	// Valider
	$valid = array();
	$valid["dateVisite"]=1;
	$valid["choixPraticien"]=1;
	$valid["remplacant"]=1;
	$valid["choixMotif"]=1;
	$valid["motifAutre"]=1;
	$valid["bilan"]=1;
	$valid["documentation"]=1;
	$valid["echantitillons"]=1;
	$valid["echantitillonsDonnees"]=null;
	
	
	// Si Formulaire
	if( isset($hop) 
	) {
		
		
		
		// Si la clé du formilaire n'est pas valide
		if( $_SESSION["FormConpteRenduHashkey"] !== $_POST["hashkey"]) {
			$info_connexion = "Erreur, securité de connexion !";
		}
	}
	
	
	
	// Permet de verifié l'envoie du bon message
	
	
	//  Si aucune erreurs exite (provenant de valider) alors erreurs est initialisé
	if(!isset($erreurs)) $erreurs = array();

	//
	OutilsForm::genFormulaireId("compte-rendu-saisie");
	Controleur::composeVue("vues/compte-rendu/saisie.php");
	break;
}

//include(v_compterendu_saisie.setCompteRendu();
?>
