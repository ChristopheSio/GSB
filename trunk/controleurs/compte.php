<?php
/** 
 * Controleur des compte gsb de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */
switch(Controleur::$action)
{
case "connexion":	
	Vue::$title = "Connexion";
	Vue::$donnees["info_connexion"] = null;
			
	// Si le Formulaire est envoyé
	if( isset($_POST["hashkey"]) && isset($_POST["login"]) && isset($_POST["password"]) && isset($_SESSION["FormUtilisateurHashkey"]) ) {
		// Si la clé du formilaire est valide
		if( $_SESSION["FormUtilisateurHashkey"] === $_POST["hashkey"]) {
			$utilisateur = GsbModele::getInfosVisiteur(
					$_POST["login"],
					md5( GsbConfig::$AuthKey . $_POST["password"] )
			);
			if(is_array($utilisateur))
			{
				// Connecte l'utilisateur
				GsbUtilisateur::seConnecter($utilisateur['VIS_LOGIN'], $utilisateur['VIS_NOM'], $utilisateur['VIS_PRENOM'], $utilisateur['VIS_MATRICULE'], $utilisateur['VIS_EMAIL']);
				Controleur::composeVue("vues/page/accueil.php",false);
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
				Vue::$donnees["info_connexion"] = "Login ou mot de passe incorrect";
			}
		}
		else {
			Vue::$donnees["info_connexion"] = "Erreur, securité de connexion !";
		}
		Vue::$donnees["login"] = $_POST["login"];
		Vue::$donnees["remember"] = isset($_POST["remember"]);
	}
	else {
		Vue::$donnees["login"] = (isset($_SESSION["RappelUtilisateurLogin"])?$_SESSION["RappelUtilisateurLogin"]:"");
		Vue::$donnees["remember"] = isset($_SESSION["RappelUtilisateurActif"]);
	}
	Vue::$donnees["password"] = null;
	Vue::$donnees["hashkey"] = md5(rand(0, 10000));
	$_SESSION["FormUtilisateurHashkey"] = Vue::$donnees["hashkey"];
	//
	Controleur::composeVue("vues/compte/connexion.php",false);
	break;
case "deconnexion":	
	Vue::$title = "Deconnexion";
	Vue::$HeaderSupplement = '<META http-equiv="Refresh" content="5; URL='.OutilsUrl::composer("page","accueil").'">';
	Controleur::composeVue("vues/compte/deconnexion.php",false);
	GsbUtilisateur::seDeconnecter();
	break;
}
