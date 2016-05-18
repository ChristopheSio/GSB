<?php
/** 
 * Vue Accueil de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */

switch(Controleur::$action)
{
case "400":	
	$code="400";
	$message="La syntaxe de la requête est erronée";
	$message_en="(Bad Request)";
	break;
case "401":	
	$code="401";
	$message="Une authentification/autorisation est nécessaire pour accéder à la ressource";
	$messagebis="Une authentification/autorisation est nécessaire pour accéder à la ressource";
	$message_en="(Unauthorized)";
	break;
case "403":	
	$code="403";
	$message="Le serveur a compris la requête, mais refuse de l'exécuter";
	$message_en="(Forbidden)";
	break;
case "404":	
	$code="404";
	$message="Ressource non trouvée";
	$message_en="(Not Found)";
	break;
case "500":	
	$code="500";
	$message="Erreur interne du serveur";
	$message_en="(Internal Server Error)";
	break;
default:	
	$code="inconnu";
	$message="";
	$message_en="(unknown)";
}

// Dans certains cas les variables peuvent ne pas être globale comme quand 
// la fonction doitValiderAutorisation est appelée.
foreach (get_defined_vars() as $key => $value) {
	$GLOBALS[$key] = $value;
}

// Charge la vue des erreurs
Vue::$title = 'Erreur '. $code . " " . $message_en . " : " . $_SERVER["REQUEST_URI"];
Controleur::composeVue("vues/responsecode.php",false);

?>
