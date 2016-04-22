<?php
/** 
 * Controlleur des routines pour l'application GSB
 * @package default
 * @author Cheri Bibi released by Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */

/** Initialisation
 */
session_start();

/* Chargement des fonctions et classes utilitaires
 */
require_once("utilitaires/__init__.php");

/** Initialisation Modèle
 */
GsbModele::seConnecter();

/** Gestion des routines controleurs
 */
switch (Controleur::$uc) 
{
case null:
case 'page':
	include("controleurs/page.php");
	break;	

case 'gsb':
	include("controleurs/gsb.php");
	break;	
	
case 'compte': 
	include("controleurs/compte.php");
	break;

case 'compte-rendu': 
	include("controleurs/compte-rendu.php");
	break;

case 'medicament': 
	include("controleurs/medicament.php");
	break;

case 'praticien': 
	include("controleurs/praticien.php");
	break;

case 'visiteur': 
	include("controleurs/visiteur.php");
	break;
	
case 'responsecode': 
	include("controleurs/responsecode.php");
	break;
}

/** Page non trouvée si aucun controleurs 
  * n'a appelé une vue
  */
if( Controleur::estCompose() == false ) {
	Controleur::$action = "404";
	include("controleurs/responsecode.php");
}
