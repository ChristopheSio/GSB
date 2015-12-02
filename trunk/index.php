<?php
// Inclue les fonction et classe de base
require_once("include/fct.inc.php");
require_once ("include/modele.inc.php");
require_once("include/roles.php");
// Initialisation
session_start();
$pdo = PdoGsb::getPdoGsb();
// Vue d'entete
include("vues/v_site_entete.php");

///
if( isset($_REQUEST['uc'] ) )	$uc = $_REQUEST['uc'];
else if ( estConnecte() )		
{
	
}
$uc = (!isset($_REQUEST['uc']) || (!isset($_SESSION['login']))) ? 'auth' : $_REQUEST['uc'];

switch ($uc) 
{
	
case 'auth': 
	include("controleurs/c_authentification.php");
	break;
	
case 'page':
	include("controleurs/c_page.php");
	break;

case 'compte-rendu': 
	include("controleurs/c_compte-rendu.php");
	break;

case 'medicament': 
	include("controleurs/c_medicament.php");
	break;

case 'praticien': 
	include("controleurs/c_praticien.php");
	break;

case 'visiteur': 
	include("controleurs/c_visiteur.php");
	break;

default:
	ajouterErreur("404 - page inconue");
	include("vues/v_erreurs.php");

}
include("vues/v_site_pied.php");
?>

