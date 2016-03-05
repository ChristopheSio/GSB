<?php
/** 
 * Fonctions pour gérer les localisation de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */
 
class GsbLocalisation {
	/** Contient la liste des régions une fois chargé
	*/
	public static $Region = null;
	
	/** Contient la liste des Secteur une fois chargé
	*/
	public static $Secteur = null;

	/** Charge la class static (appeler uniquement en cas de besoin afin de réduire la consomation mémoire)
	*/
	public static function initialiseMoi() {
		GsbLocalisation::$Region = array(
			"E"=>"Est",
			"N"=>"Nord",
			"O"=>"Ouest",
			"P"=>"Paris centre",
			"S"=>"Sud"
		);
		GsbLocalisation::$Secteur = array(
			"E"=>"Est",
			"N"=>"Nord",
			"O"=>"Ouest",
			"P"=>"Paris centre",
			"S"=>"Sud"
		);
	}
}
