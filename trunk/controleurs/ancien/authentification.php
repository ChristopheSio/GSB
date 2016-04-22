<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch($action)
{

case 'valide':
	 $login = $_REQUEST['login'];
	$mdp = $_REQUEST['mdp'];
	$visiteur = GsbModele::getInfosVisiteur($login,$mdp);
	if(!is_array( $visiteur))
	{
		ajouterErreur("Login ou mot de passe incorrect");
		include("vues/v_erreurs.php");
		include("vues/v_auth_connexion.php");
	}
	else
	{
		$_SESSION['login']= $login; // mémorise les variables de session
		$_SESSION['id']= $visiteur['VIS_MATRICULE'];
		$_SESSION['nom']= $visiteur['VIS_NOM'];
		$_SESSION['prenom']= $visiteur['VIS_PRENOM'];
		include("vues/v_site_sommaire.php");
		include("vues/v_page_accueil.php");
	}
	break;

case 'deconnexion':
	include("vues/v_auth_deconnexion.php");
	session_destroy();
	break;

case 'connexion':
default :
	include("vues/v_auth_connexion.php");
	break;

}
?>