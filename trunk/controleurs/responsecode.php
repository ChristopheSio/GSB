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
	Vue::$donnees["code"]="400";
	Vue::$donnees["message"]="La syntaxe de la requête est erronée";
	Vue::$donnees["message_en"]="(Bad Request)";
	break;
case "401":	
	Vue::$donnees["code"]="401";
	Vue::$donnees["message"]="Une authentification est nécessaire pour accéder à la ressource";
	Vue::$donnees["message_en"]="(Unauthorized)";
	break;
case "403":	
	Vue::$donnees["code"]="403";
	Vue::$donnees["message"]="Le serveur a compris la requête, mais refuse de l'exécuter";
	Vue::$donnees["message_en"]="(Forbidden)";
	break;
case "404":	
	Vue::$donnees["code"]="404";
	Vue::$donnees["message"]="Ressource non trouvée";
	Vue::$donnees["message_en"]="(Not Found)";
	break;
case "500":	
	Vue::$donnees["code"]="500";
	Vue::$donnees["message"]="Erreur interne du serveur";
	Vue::$donnees["message_en"]="(Internal Server Error)";
	break;
default:	
	Vue::$donnees["code"]="inconnu";
	Vue::$donnees["message"]="";
	Vue::$donnees["message_en"]="(unknown)";
}

Vue::$title = 'Erreur '. Vue::$donnees["code"] . " " . Vue::$donnees["message_en"] . " : " . $_SERVER["REQUEST_URI"];
Controleur::composeVue("vues/responsecode.php",false);

?>
