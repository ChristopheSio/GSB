<?php
/** 
 * Classe de gestion des vues pour l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */

class Vue
{
	/** Titre de la page
	*/
	public static $title = null;
	
	/** Description de la page
	*/
	public static $description = null;
	
	/** Informations pour la vue
	*/
	public static $donnees = array();
	
	/** Personalisation du header de la page
	*/
	public static $ListScript = null;
	public static $ListStyle = null;
	public static $HeaderSupplement = "";
	
	/** Permet de savoir si une donn�e existe
	*/
	public static function existDonnee(&$donneeNom) {
		return isset(Vue::$donnees[$donneeNom]);
	}

}