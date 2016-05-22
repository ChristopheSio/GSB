<?php
/** 
 * Classe de gestion des controleurs pour l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */

class Controleur
{
	/** Requetes d'un controleur
	*/
	public static $uc = null;
	public static $action = null;
	public static $info = null;
	
	/** Gestion d'un controleur
	*/
	private static $estAjax = false;
	private static $estCompose = false;
	private static $vueUrlCompose = null;
	
	/** Affichages des vues
	*/
	public static function afficheEntete() {
		include("vues/gabarit/entete.php");
	}
	public static function afficheExtraTitre() {
		include("vues/gabarit/extra_titre.php");
	}
	public static function affichePied() {
		include("vues/gabarit/pied.php");
	}
	
	/**
	 * Compose une vue principale
	 * @param $vueUrl est la vue a inclure et extraTitre permet d'afficher le titre de la vue
	*/
	public static function composeVue($vueUrl,$extraTitre=true) {
		foreach($GLOBALS as $varName => $varValue ) {
			if( (substr($varName, 0, 1) == "_") || ($varName=="GLOBALS") ) continue;
			${$varName} = $varValue;
		}
		Controleur::$estCompose = true;
		Controleur::$vueUrlCompose = $vueUrl;
		if( !Controleur::$estAjax ) {
			Controleur::afficheEntete();
			if($extraTitre) 
				Controleur::afficheExtraTitre();
		}
		//
		include($vueUrl);
		//
		if( !Controleur::$estAjax ) {
			Controleur::affichePied();
		}
	}
	
	/** Renseigne sur le statue ajax
	 */
	public static function ajaxActiver() {
		Controleur::$estAjax = true;
	}
	public static function ajaxDesactiver() {
		Controleur::$estAjax = false;
	}
	public static function ajaxEstActive() {
		return Controleur::$estAjax;
	}
	
	/** Reseigne le statut d'un controleur
	*/
	public static function estCompose() {
		return Controleur::$estCompose;
	}
	public static function estVueUrlComposeParConstFile($constFile) {
		return (
			is_null(Controleur::$vueUrlCompose)?
				false:
				OutilsUrl::testConstFileVersUrl($constFile,Controleur::$vueUrlCompose)
		);
	}
	
	/** Assure la sécurité de connexion bdd
	*/
	public static function erreurConnexionBdd($messageErreur) {
		$info = $messageErreur;
		include("vues/maintenance.php");
		die();
	}
	
	/** Assure la sécurité autorisations de manière forte
	*/
	public static function doitValiderAutorisation($boolAutorisation,$messageDeSecurite=null) {
		if( !$boolAutorisation ) {
			Controleur::$action = "401";
			Controleur::$info = $messageDeSecurite;
			include("controleurs/responsecode.php");
			die();
		}
	}
	
	/** Charge la class static (appeler en fin de classe)
	*/
	public static function initialiseMoi() {
		Controleur::$uc = (isset($_GET['uc'])?$_GET['uc']:null);
		Controleur::$action = (isset($_GET['action'])?$_GET['action']:null);
	}
}
Controleur::initialiseMoi();