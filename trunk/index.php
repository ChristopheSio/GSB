<?php

require_once("include/fct.inc.php");
require_once ("include/modele.inc.php");
include("vues/v_entete.php");
session_start();
$pdo = PdoGsb::getPdoGsb();
///
$uc = (!isset($_REQUEST['uc']) || (!isset($_SESSION['login']))) ? 'connexion' : $_REQUEST['uc'];

switch ($uc) 
{
	
case 'connexion': 
	include("controleurs/c_connexion.php");
	break;
	
case 'compte-rendu': 
	include("controleurs/c_gerer_CompteRendu.php");
	break;

case 'medicament': 
	include("controleurs/c_gerer_Medicament.php");
	break;

case 'practicien': 
	include("controleurs/c_gerer_Practicien.php");
	break;

case 'visiteur': 
	include("controleurs/c_gerer_Visiteur.php");
	break;

}
include("vues/v_pied.php");
?>

