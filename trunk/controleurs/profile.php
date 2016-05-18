<?php
/** 
 * Controleur du profile de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */

// Verifie que l'utilisateur est connecté
Controleur::doitValiderAutorisation( GsbUtilisateur::estConnecte() );

switch(Controleur::$action)
{
case null:	
case "statut":	
	Vue::$title = 'Mon statut';
	$leVisiteur = GsbModele::getInfosVisiteurMatricule(GsbUtilisateur::$Matricule);
	$leVisiteurRole = GsbModele::getLeVisiteurRole(GsbUtilisateur::$Matricule);
	Controleur::composeVue("vues/profile/statut.php");
	break;
/*
 * Pas obligatoire
case "parametres":	
	Vue::$title = "Parametres";
	Controleur::composeVue("vues/profile/parametres.php");
	break;
*/

}

?>
