<?php
/** 
 * Controleur des comptes-rendus gsb de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */

// Verifie que l'utilisateur est connecté
Controleur::doitValiderAutorisation( GsbUtilisateur::estConnecte() );

/* Permet de valider le controlleur de saisie d'un echantillion
 */
function validerSaisieEchantillons(&$choixMedicament,&$qteOfferte) {
	$valid=array("choixMedicament"=>1,"qteOfferte"=>1);
	if(is_null($choixMedicament) || is_null($qteOfferte)) {
		$valid["choixMedicament"]=0;
		$valid["qteOfferte"]=0;
	}
	else {
		if(!is_array(GsbModele::getLeMedicamentDetails($choixMedicament))) 
			$valid["choixMedicament"]=0;
		if(intval($qteOfferte)!=$qteOfferte)			
			$valid["qteOfferte"]=0;
		else if(($qteOfferte<=0) || ($qteOfferte>500))	
			$valid["qteOfferte"]=0;
	}
	return $valid;
}



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
	Controleur::doitValiderAutorisation( GsbUtilisateur::estRoleVisiteur(), "Vous devez être visiteur" );
	//
	Vue::$title = "Consulter les comptes-rendus";
	Vue::configToDataTable("DataTableCompteRendu");
	$lesComptesRendusDuVisiteur = GsbModele::getLesComptesRendusDuVisiteur(GsbUtilisateur::$Matricule);
	$lesComptesRendusDuVisiteurSontVide = count($lesComptesRendusDuVisiteur) == 0;
	Controleur::composeVue("vues/compte-rendu/liste.php");
	break;

case "details":	
	// Verifie que l'utilisateur est visiteur
	Controleur::doitValiderAutorisation( GsbUtilisateur::estRoleVisiteur(), "Vous devez être un visiteur" );
	//
	$leCompteRendu = null;
	$leCompteRenduEchantillonsOffert = null;
	if(isset($_GET["num"]) && isset($_GET["matricule"])) 
	{
		if( GsbUtilisateur::estRoleDelegue() ) {
			$leVisiteurRole = GsbModele::getLeVisiteurRole(GsbUtilisateur::$Matricule);	
			$leCompteRendu = GsbModele::getLeCompteRenduSiDelegue($_GET["matricule"],$_GET["num"],$leVisiteurRole["REG_CODE"],GsbUtilisateur::$Matricule);
		}
		else if (GsbUtilisateur::$Matricule==$_GET["matricule"]) {
			$leCompteRendu = GsbModele::getLeCompteRendu(GsbUtilisateur::$Matricule,$_GET["num"]);
		}
		if($leCompteRendu) {
			$leCompteRenduEchantillonsOffert = GsbModele::getLeCompteRenduLesEchantillonsOffert($leCompteRendu["VIS_MATRICULE"],$leCompteRendu["RAP_NUM"]);
		}
	}
	Vue::$title = "Details compte rendu";
	Controleur::composeVue("vues/compte-rendu/details.php");
	break;


case "ajax-saisie-echantillons":	
	Controleur::ajaxActiver();
	Controleur::doitValiderAutorisation( GsbUtilisateur::estRoleVisiteur() , "Vous devez être visiteur" );
	//
	$multidataParam = OutilsMultidataForm::ajaxReceive();
	$lesMedicaments = GsbModele::getLesMedicaments();
	$choixMedicament = "";
	$qteOfferte = 1;
	$valid["choixMedicament"]=1;
	$valid["qteOfferte"]=1;
	// Si formulaire
	if( isset($_POST["choixMedicament"]) && isset($_POST["qteOfferte"]) ) {
		$choixMedicament = $_POST["choixMedicament"];
		$qteOfferte = $_POST["qteOfferte"];
		//
		$valid = validerSaisieEchantillons($choixMedicament,$qteOfferte);
	}
	Controleur::composeVue("vues/compte-rendu/ajax-saisie-echantillons.multidata.form.php");
	break;
	
	
case "saisir":	
	// Verifie que l'utilisateur est délégué
	Controleur::doitValiderAutorisation( GsbUtilisateur::estRoleVisiteur(), "Vous devez être visiteur" );
	//
	Vue::$title = "Saisir un comptes-rendu";
	$okCompteRendu = false;
	// Charge les liste déroulantes
	$lesMotifs = array( "Actualisation annuelle", "Rapport annuel", "Baisse activité"  );
	$lesPraticiens = GsbModele::getLesPraticiensPourCompteRendu();
	$lesMedicaments = GsbModele::getLesMedicaments();
	// Données auto
	$info_connexion = null;
	$numeroGet = GsbModele::getCompteRenduLeDernierNumeroDuVisiteur(GsbUtilisateur::$Matricule);
	$numero = is_null($numeroGet)?0:$numeroGet+1;
	$echantillons=false;
	// Données saisie
	$dateVisite=date("Y-m-d" );
	$choixPraticien="";
	$remplacant=false;
	$choixMotif="no";
	$motifAutre="";
	$motifAutreActive=false;
	$bilan="";
	$documentation=false;
	$echantillonsMultidataForm = OutilsMultidataForm::init("echantillonsDonnees",25,OutilsUrl::composer("compte-rendu","ajax-saisie-echantillons"),array("choixMedicament","qteOfferte"));
	// Valider
	$valid = array();
	$valid["dateVisite"]=1;
	$valid["choixPraticien"]=1;
	$valid["choixMotif"]=1;
	$valid["motifAutre"]=1;
	$valid["bilan"]=1;
	$valid["echantillons"]=1;
	// Si Formulaire
	if( OutilsForm::existePostEntrees( array("dateVisite","choixPraticien","choixMotif","bilan") ) ) 
	{
		$dateVisite=$_POST["dateVisite"];
		$valid["dateVisite"] = OutilsForm::valideDate($dateVisite,time())?1:0;
		//
		$choixPraticien=$_POST["choixPraticien"];
		$valid["choixPraticien"] = is_array(GsbModele::getLePraticienDetails($choixPraticien));
		//
		$bilan=$_POST["bilan"];
		$valid["bilan"] = OutilsForm::valideMessage($bilan);
		//
		$remplacant=isset($_POST["remplacant"]);
		$documentation=isset($_POST["documentation"]);
		//
		if(isset($_POST["motifAutre"])) {
			$motifAutre=$_POST["motifAutre"];
			$motifAutreActive=true;
			$choixMotif="autre-saisie";
			$valid["motifAutre"] = OutilsForm::valideMessage($motifAutre,128);
		}
		else {
			$choixMotif=$_POST["choixMotif"];
			$valid["choixMotif"] = (($choixMotif>=0) && (count($lesMotifs)>$choixMotif))?1:0;
		}
		// Si des échantillons sont envoyées
		if(!is_null($echantillonsMultidataForm["values"])) {
			$echantillonsFaits = array();
			foreach($echantillonsMultidataForm["values"] as $saisieEchantillons) {
				$validEchantillons = validerSaisieEchantillons($saisieEchantillons["choixMedicament"],$saisieEchantillons["qteOfferte"]);
				if($validEchantillons["choixMedicament"]==1)
				{
					if (isset($echantillonsFaits[$saisieEchantillons["choixMedicament"]])) {
						if( $echantillonsFaits[$saisieEchantillons["choixMedicament"]]==1 )
							$echantillonsMultidataForm["errors"][] = "L'echantillion code \"".$saisieEchantillons["choixMedicament"]."\" est renseigné une ou plusieurs fois";
						$validEchantillons["echantillons"] = 0;
						$echantillonsFaits[$saisieEchantillons["choixMedicament"]]++;
					}
					else
						$echantillonsFaits[$saisieEchantillons["choixMedicament"]]=1;
				}
				if($valid["echantillons"]==1)
					$valid["echantillons"] = OutilsForm::valideListValid($validEchantillons);
			}
		}
		// Si tout est bon !
		if( OutilsForm::valideListValid($valid) && OutilsForm::valideFormulaireId("compte-rendu-saisie") ) {
			// On ajoute a la base de donnée
			$motif = ($motifAutreActive?$motifAutre:$lesMotifs[$choixMotif]);
			$rapportKeys = GsbModele::insererCompteRendu(
				GsbUtilisateur::$Matricule,
				$choixPraticien,
				$dateVisite,
				$bilan,
				$motif,
				$remplacant,
				$documentation,
				$echantillonsMultidataForm["values"]
			);
			//
			$okCompteRendu = true;
		}
	}
	//
	if(!$okCompteRendu)
		Vue::configToMultidataForm("echantillonsDonnees",$echantillonsMultidataForm);
	//
	OutilsForm::genFormulaireId("compte-rendu-saisie");
	Controleur::composeVue("vues/compte-rendu/saisie.php");
	break;
}

		


?>
