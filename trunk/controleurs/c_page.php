<?php

// Action par default 'aucune' 
$action =  ( (isset($_REQUEST['action'])) ? $_REQUEST['action'] : null ) ;
include("vues/v_site_sommaire.php");
switch($action)
{

case "accueil":	
default:	
	include("vues/v_page_accueil.php");
	break;
}

?>
