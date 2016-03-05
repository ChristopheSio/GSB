<?php
/** 
 * Controleur des pages gsb de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */
switch(Controleur::$action)
{
case "travail":	
	Vue::$title = "Travail";
	Vue::$ListStyle == array("css/jqvmap.css");
	Vue::$ListScript == array("js/jquery.vmap.colorsFrance.js","js/jquery.vmap.france.js","js/jquery.vmap.js");
	Controleur::composeVue("vues/gsb/travail.php");
	break;
case "documentation":	
	Vue::$title = "Documentation";
	Controleur::composeVue("vues/gsb/documentation.php");
	break;
}

?>
