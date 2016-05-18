<?php
/** 
 * Controleur des pages gsb de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */

// Verifie que l'utilisateur est connecté
Controleur::doitValiderAutorisation( GsbUtilisateur::estConnecte() );

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
