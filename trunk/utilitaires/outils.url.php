<?php
/** 
 * Fonctions des url pour l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */

class OutilsUrl
{
	/** Permet de savoir si apache utilise la réecriture d'url
	*/
	private static $utiliseRewriteRules = null;
	
	/** Configuration des paramètre serveur
	*/
	private static $ServeurDossierRacine = "";

	/**
	 * Crée un lien controleur vue pour l'application gsb
	 * @param $nomControleur est le nom du controlleur, $nomVue est le nom de la vue; $chaineDeRequete est une chaine a ajouté a la fin de l'url
	 * @return la concatanation au format réeccrit ou en method get
	*/
	public static function composer($nomControleur=null,$nomVue=null,$chaineDeRequete=null)
	{
		if(OutilsUrl::$utiliseRewriteRules === true)
			return GsbConfig::$SiteUrl .  ( 
				is_null($nomControleur) ? '' : ( 
					'/'.$nomControleur . ( 
						is_null($nomVue) ? '' : ( '/'.$nomVue ) 
					)
				)
			) . (
				is_null($chaineDeRequete) ? '' :  ("?".$chaineDeRequete)
			);
		else
			return GsbConfig::$SiteUrl . ( 
				is_null($nomControleur) ? '' : ( 
					'/index.php?uc='.$nomControleur . ( 
						is_null($nomVue) ? '' : ( '&action='.$nomVue ) 
					)
				)
			) . (
				is_null($chaineDeRequete) ? '' :  ("&".$chaineDeRequete)
			);
	}
	/**
	 * Utilise la fonction composer pour crée un lien controleur vue et l'afficher dans l'application gsb
	 * @param $nomControleur est le nom du controlleur, $nomVue est le nom de la vue; $chaineDeRequete est une chaine a ajouté a la fin de l'url
	*/
	public static function composerHref($nomControleur=null,$nomVue=null,$chaineDeRequete=null)
	{
		echo 'href="'.OutilsUrl::composer($nomControleur,$nomVue,$chaineDeRequete).'"';
	}
	/**
	 * Utilise la fonction composer pour crée un lien controleur vue et l'afficher dans l'application gsb
	 * @param $texteLien est le lien à afficher, $nomControleur est le nom du controlleur, $nomVue est le nom de la vue; $chaineDeRequete est une chaine a ajouté a la fin de l'url
	*/
	public static function composerLien($texteLien,$nomControleur=null,$nomVue=null,$chaineDeRequete=null)
	{
		echo '<a href="'.OutilsUrl::composer($nomControleur,$nomVue,$chaineDeRequete).'">'.$texteLien."</a>";
	}
	
	/**
	 * A l'aide de la constante __FILE__ cela permet de verifier la correspondance d'un chemin dans l'application gsb
	 * @param $constFILE est le path const a convertir en url $testURL est l'url correspondant
	 * @return vrai si l'url correspond au path const
	*/
	public static function testConstFileVersUrl($constFILE,$testURL)
	{
		return ( 
			str_replace(							// supprime le chemin absolue
				OutilsUrl::$ServeurDossierRacine.'/',
				'',
				str_replace('\\', '/', $constFILE) // convertie en url unix
			) == $testURL
		);
	}
	/** Charge la class static (appeler en fin de classe)
	*/
	public static function initialiseMoi() {
		OutilsUrl::$utiliseRewriteRules = in_array("mod_rewrite", apache_get_modules());
		OutilsUrl::$ServeurDossierRacine = str_replace('\\', '/', realpath(__DIR__.'/..') );
	}
}
OutilsUrl::initialiseMoi();