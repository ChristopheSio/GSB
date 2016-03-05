<?php
/** 
 * Controleur du profile de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */
switch(Controleur::$action)
{
case null:	
case "statut":	
	Vue::$title = "Statut";
	Controleur::composeVue("vues/profile/statut.php");
	break;
case "parametres":	
	Vue::$title = "Parametres";
	Controleur::composeVue("vues/profile/parametres.php");
	break;

}

?>
