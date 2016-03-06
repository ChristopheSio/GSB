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
	Vue::configToJqvmap();
	Controleur::composeVue("vues/gsb/travail.php");
	break;
case "documentation":	
	Vue::$title = "Documentation";
	Controleur::composeVue("vues/gsb/documentation.php");
	break;
}

?>
