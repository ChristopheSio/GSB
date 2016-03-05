<?php
/** 
 * Fonctions des dates pour l'application GSB
 * @package default
 * @author Cheri Bibi released by Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */

class OutilsDate
{
	/**
	 * Transforme une date au format français jj/mm/aaaa vers le format anglais aaaa-mm-jj
	 * @param $madate au format  jj/mm/aaaa
	 * @return la date au format anglais aaaa-mm-jj
	*/
	public static function formatFr2En($maDate)
	{
		return preg_replace( 
			'/([0-9]+)[/-]([0-9]+)[/-]([0-9]+)/i',	// REGEX
			'$3-$2-$1',
			$maDate
		);
		//@list($jour,$mois,$annee) = explode('/',$maDate);
		//return date('Y-m-d',mktime(0,0,0,$mois,$jour,$annee));
	}
	/**
	 * Transforme une date au format format anglais aaaa-mm-jj vers le format français jj/mm/aaaa 
	 * @param $madate au format  aaaa-mm-jj
	 * @return la date au format format français jj/mm/aaaa
	*/
	public static function formatEn2Fr($maDate)
	{
	   return preg_replace( 
			'/([0-9]+)[/-]([0-9]+)[/-]([0-9]+)/i',	// REGEX
			'$3/$2/$1',
			$maDate
		);	   
	   //@list($annee,$mois,$jour)=explode('-',$maDate);
	   //$date="$jour"."/".$mois."/".$annee;
	   //return $date;
	}
	/**
	 * retourne le mois au format aaaamm selon le jour dans le mois
	 * @param $date au format  jj/mm/aaaa
	 * @return le mois au format aaaamm
	*/
	public static function getMoisFr($date)
	{
		return preg_replace( 
			'/([0-9]+)[/-]([0-9]+)[/-]([0-9]+)/i',	// REGEX
			'$3$2',
			$date
		);	
		//@list($jour,$mois,$annee) = explode('/',$date);
		//if(strlen($mois) == 1){
		//	$mois = "0".$mois;
		//}
		//return $annee.$mois;
	}
	/**
	 * Vérifie si une date est inférieure d'un an à la date actuelle
	 * @param $dateTestee 
	 * @return vrai ou faux
	*/
	public static function estDateDepassee($dateTestee){
		$dateActuelle=date("d/m/Y");
		@list($jour,$mois,$annee) = explode('/',$dateActuelle);
		$annee--;
		$AnPasse = $annee.$mois.$jour;
		@list($jourTeste,$moisTeste,$anneeTeste) = explode('/',$dateTestee);
		return ($anneeTeste.$moisTeste.$jourTeste < $AnPasse); 
	}
	/**
	 * Vérifie la validité du format d'une date française jj/mm/aaaa 
	 * @param $date 
	 * @return vrai ou faux
	*/
	public static function estValide($date)
	{
		return preg_match( 
			'/[0-9]{1,2}/[0-9]{1,2}/[0-9]{2,4}/i',	// REGEX
			$date
		);	
		
		//$tabDate = explode('/',$date);
		//$dateOK = true;
		//if (count($tabDate) != 3) {
		//	$dateOK = false;
		//}
		//else {
		//	if (!estTableauEntiers($tabDate)) {
		//		$dateOK = false;
		//	}
		//	else {
		//		if (!checkdate($tabDate[1], $tabDate[0], $tabDate[2])) {
		//			$dateOK = false;
		//		}
		//	}
		//}
		//return $dateOK;
	}
}