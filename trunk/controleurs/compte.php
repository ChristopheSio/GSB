<?php
/** 
 * Controleur des comptes gsb de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */
switch(Controleur::$action)
{
case "connexion":	
	
	// Si l'utilisateur est connecté alors une vue de redirection s'affiche
	if(GsbUtilisateur::estConnecte()) {
		Vue::$title = "Redirection connexion";
		$rechargement_temps = 5;
		Vue::$HeaderSupplement .= '<META http-equiv="Refresh" content="'.$rechargement_temps.'; URL='.OutilsUrl::composer("page","accueil").'">';
		Controleur::composeVue("vues/compte/connexion-redirection.php",false);
		break;
	}
	Vue::$title = "Connexion";
	$info_connexion = null;
	// Si le Formulaire est envoyé
	if( isset($_POST["login"]) && isset($_POST["password"]) ) {
		// Si la clé du formilaire est valide
		if(OutilsForm::valideFormulaireId("connexion")) 
		{
			$utilisateur = GsbModele::getInfosVisiteur(
					$_POST["login"],
					md5( GsbConfig::$AuthKey . $_POST["password"] )
			);
			if(is_array($utilisateur))
			{
				// Connecte l'utilisateur
				GsbUtilisateur::seConnecter($utilisateur['VIS_LOGIN'], $utilisateur['VIS_NOM'], $utilisateur['VIS_PRENOM'], $utilisateur['VIS_MATRICULE'], $utilisateur['VIS_EMAIL']);
				
				// Redirige l'utilisateur instantanément (0s)
				Vue::$title = "Redirection connexion";
				$rechargement_temps = 0;
				Vue::$HeaderSupplement .= '<META http-equiv="Refresh" content="'.$rechargement_temps.'; URL='.OutilsUrl::composer("page","accueil").'">';
				header('Location: '.OutilsUrl::composer("page","accueil") );  
				Controleur::composeVue("vues/compte/connexion-redirection.php",false);
				
				// Se souvenir de moi
				if( isset($_POST["remember"]) ) {
					$_SESSION["RappelUtilisateurLogin"] = $_POST["login"];
					$_SESSION["RappelUtilisateurActif"] = true;
				}
				else { 
					if ( isset($_SESSION["RappelUtilisateurLogin"]) ) 
						unset($_SESSION["RappelUtilisateurLogin"]);
					if ( isset($_SESSION["RappelUtilisateurActif"]) ) 
						unset($_SESSION["RappelUtilisateurActif"]);
				}
				unset($_SESSION["FormUtilisateurHashkey"]);
				break;
			}
			else
			{
				$info_connexion = "Login ou mot de passe incorrect";
			}
		}
		$login = $_POST["login"];
		$remember = isset($_POST["remember"]);
	}
	else {
		$login = (isset($_SESSION["RappelUtilisateurLogin"])?$_SESSION["RappelUtilisateurLogin"]:"");
		$remember = isset($_SESSION["RappelUtilisateurActif"]);
	}
	$password = null;
	//
	OutilsForm::genFormulaireId("connexion");
	Controleur::composeVue("vues/compte/connexion.php",false);
	break;
	
case "deconnexion":	
	Vue::$title = "Deconnexion";
	$rechargement_temps = 5;
	Vue::$HeaderSupplement .= '<META http-equiv="Refresh" content="'.$rechargement_temps.'; URL='.OutilsUrl::composer("page","accueil").'">';
	GsbUtilisateur::seDeconnecter();
	Controleur::composeVue("vues/compte/deconnexion.php",false);
	break;
}
