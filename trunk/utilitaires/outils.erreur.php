<?php
/** 
 * Fonctions des erreurs pour l'application GSB
 * @package default
 * @author Cheri Bibi released by Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */

class OutilsErreurs
{
	/**
	 * Ajoute le libellé d'une erreur au tableau des erreurs 
	 * @param $msg : le libellé de l'erreur 
	 */
	public static function ajouter($msg)
	{
	   if (! isset($_REQUEST['erreurs'])){
		  $_REQUEST['erreurs']=array();
		} 
	   $_REQUEST['erreurs'][]=$msg;
	}
	/**
	 * Retoune le nombre de lignes du tableau des erreurs 
	 * @return le nombre d'erreurs
	 */
	public static function getCount()
	{
	   if (!isset($_REQUEST['erreurs'])){
		   return 0;
		}
		else{
		   return count($_REQUEST['erreurs']);
		}
	}
}