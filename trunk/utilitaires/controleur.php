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
	
	/** Gestion d'un controleur
	*/
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
		Controleur::afficheEntete();
		if($extraTitre) Controleur::afficheExtraTitre();
		include($vueUrl);
		Controleur::affichePied();
	}
	
	/**
	 * Compose une vue appeler en ajax
	 * @param $vueUrl est la vue a inclure
	*/
	public static function composeAjaxVue($vueUrl) {
		foreach($GLOBALS as $varName => $varValue ) {
			if( (substr($varName, 0, 1) == "_") || ($varName=="GLOBALS") ) continue;
			${$varName} = $varValue;
		}
		Controleur::$estCompose = true;
		Controleur::$vueUrlCompose = $vueUrl;
		include($vueUrl);
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
	
	
	/** Charge la class static (appeler en fin de classe)
	*/
	public static function initialiseMoi() {
		Controleur::$uc = (isset($_GET['uc'])?$_GET['uc']:null);
		Controleur::$action = (isset($_GET['action'])?$_GET['action']:null);
	}
}
Controleur::initialiseMoi();