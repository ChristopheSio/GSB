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

/*
 * Chargement des fonctions et classes utilitaires
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

/** Page non trouv�e si aucun controleurs 
  * n'a appel� une vue
  */
if( Controleur::estCompose() == false ) {
	Controleur::$action = "404";
	include("controleurs/responsecode.php");
}



/*
$i=0;
foreach($_GET as $key => $value) {
echo "<h1>".$i." : ".$key." = ".$value."</h1>";
$i++;
}
*/


/*

<!--
    
  </head>
  <body>
    <div id="page">
      <div id="entete">
        <img src="./images/logo.jpg" id="logoGSB" alt="Laboratoire Galaxy-Swiss Bourdin" title="Laboratoire Galaxy-Swiss Bourdin" />
        <h1>Gestion des visites</h1>
      </div>
-->




///
if( isset($_REQUEST['uc'] ) )	$uc = $_REQUEST['uc'];
else if ( estConnecte() )		
{
	
}
$uc = (!isset($_REQUEST['uc']) || (!isset($_SESSION['login']))) ? 'auth' : $_REQUEST['uc'];



*/
