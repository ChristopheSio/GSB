<?php
/** 
 * Fonctions pour traiter les utilisateurs de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */

class GsbUtilisateurEnumEtat {
		const Anonyme = 0;
		const Connecte = 1;
}
class GsbUtilisateurEnumRole {
		const Inconnu = 0; // Non connecté
		const Visiteur = 1;
		const Delegue = 2; // Régionaux (PACA/...)
		const Responsable = 3; // Secteur (Nord/Sud/Est/Ouest)
}
 
class GsbUtilisateur
{
	/** Informations sur l'utilisateur
	 */
	public static $Login = null;
	public static $Nom = null;
	public static $Prenom = null;
	public static $Matricule = null;
	public static $Email = null;
	
	/** Informations sur l'état de utilisateur
	 */
	private static $EtatUtilisateur = GsbUtilisateurEnumEtat::Anonyme;
	
	/** Informations sur le role de l'utilisateur par rapport aux régions
	 */
	private static $RoleUtilisateur = GsbUtilisateurEnumRole::Inconnu;
	
	/**
	 * Permet de savoir si l'utilisateur est connecté
	 * @return vrai si EtatUtilisateur est Connecte
	*/
	public static function estConnecte() {
		return GsbUtilisateur::$EtatUtilisateur == GsbUtilisateurEnumEtat::Connecte;
	}
	/**
	 * Permet de savoir le roles actif
	 * @return $RoleUtilisateur
	*/
	public static function quelRole() {
		return GsbUtilisateur::$RoleUtilisateur;
	}
	/**
	 * Permet de connaitre le roles en format texte
	 * @return $RoleUtilisateur
	*/
	public static function quelRoleTexte() {
		switch(GsbUtilisateur::$RoleUtilisateur)
		{
			case GsbUtilisateurEnumRole::Visiteur : return "Visiteur";
			case GsbUtilisateurEnumRole::Delegue : return "Délegué";
			case GsbUtilisateurEnumRole::Responsable : return "Responsable";
			default : return "Inconnu";
		}
	}
	/**
	 * Permet de savoir si l'utilisateur n'a pas de role
	 * @return vrai si $RoleUtilisateur est visiteur ou delegue
	*/
	public static function estRoleInconnu() {
		return (GsbUtilisateur::$RoleUtilisateur == GsbUtilisateurEnumRole::Inconnu);
	}
	/**
	 * Permet de savoir si l'utilisateur est un visiteur
	 * @return vrai si $RoleUtilisateur est visiteur ou delegue
	*/
	public static function estRoleVisiteur() {
		return (GsbUtilisateur::$RoleUtilisateur == GsbUtilisateurEnumRole::Visiteur) || (GsbUtilisateur::$RoleUtilisateur == GsbUtilisateurEnumRole::Delegue);
	}
	/**
	 * Permet de savoir si l'utilisateur est un Delegue
	 * @return vrai si $RoleUtilisateur est delegue
	*/
	public static function estRoleDelegue() {
		return (GsbUtilisateur::$RoleUtilisateur == GsbUtilisateurEnumRole::Delegue);
	}
	/**
	 * Permet de savoir si l'utilisateur est responsable
	 * @return vrai si $RoleUtilisateur est responsable
	*/
	public static function estRoleResponsable() {
		return (GsbUtilisateur::$RoleUtilisateur == GsbUtilisateurEnumRole::Responsable);
	}
	/**
	 * Permet de savoir si l'utilisateur est un administrateur
	 * @return vrai si TypeUtilisateur appartient a administrateur
	*/
	public static function estAdministrateur() {
		return (GsbUtilisateur::$Matricule=="admin");
		//return GsbUtilisateur::estConnecte(); //temporaire
	}
	/**
	 * Permet de connecter un utilisateur 
	 * (note, tout cela est fictif a l'aide de variable de session)
	 * @params $login, $nom, $prenom, $matricule, $email
	*/
	public static function seConnecter($login,$nom,$prenom,$matricule,$email) {
		$_SESSION['UtilisateurLogin'] = $login;
		$_SESSION['UtilisateurNom']= $nom;
		$_SESSION['UtilisateurPrenom']= $prenom;
		$_SESSION['UtilisateurMatricule']= $matricule;
		$_SESSION['UtilisateurEmail']= $email;
		$_SESSION['UtilisateurAuthKey']= GsbConfig::$AuthKey;
		GsbUtilisateur::$Login = $login;
		GsbUtilisateur::$Nom = $nom;
		GsbUtilisateur::$Prenom = $prenom;
		GsbUtilisateur::$Matricule = $matricule;
		GsbUtilisateur::$Email = $email;
		GsbUtilisateur::$EtatUtilisateur = GsbUtilisateurEnumEtat::Connecte;
		GsbUtilisateur::avoirLeRole();
	}
	
	/**
	 * Permet de deconnecter un utilisateur 
	 * (note, tout cela est fictif a l'aide de variable de session)
	*/
	public static function seDeconnecter() {
		unset($_SESSION['UtilisateurLogin']);
		unset($_SESSION['UtilisateurNom']);
		unset($_SESSION['UtilisateurPrenom']);
		unset($_SESSION['UtilisateurMatricule']);
		unset($_SESSION['UtilisateurEmail']);
		unset($_SESSION['UtilisateurAuthKey']);
		GsbUtilisateur::$Login = null;
		GsbUtilisateur::$Nom = null;
		GsbUtilisateur::$Prenom = null;
		GsbUtilisateur::$Matricule = null;
		GsbUtilisateur::$Email = null;
		GsbUtilisateur::$EtatUtilisateur = GsbUtilisateurEnumEtat::Anonyme;
		GsbUtilisateur::$RoleUtilisateur = GsbUtilisateurEnumRole::Inconnu;
	}
	/**
	 * Permet de connaitre le role de l'utilisateur 
	*/
	public static function avoirLeRole() {
		$utilisateurRoles = GsbModele::getLeVisiteurRole(GsbUtilisateur::$Matricule);
		GsbUtilisateur::$RoleUtilisateur = GsbUtilisateurEnumRole::Inconnu;
		if(!isset($utilisateurRoles["ROLE_CODE"])) return;
		switch($utilisateurRoles["ROLE_CODE"]) {
			case "V" : GsbUtilisateur::$RoleUtilisateur = GsbUtilisateurEnumRole::Visiteur; break;
			case "D" : GsbUtilisateur::$RoleUtilisateur = GsbUtilisateurEnumRole::Delegue; break;
			case "R" : GsbUtilisateur::$RoleUtilisateur = GsbUtilisateurEnumRole::Responsable; break;
		}
	}
	
	/** Charge la class static (appeler en fin de classe)
	*/
	public static function initialiseMoi() {
		if( (isset($_SESSION['UtilisateurLogin']) && isset($_SESSION['UtilisateurMatricule']) && isset($_SESSION['UtilisateurNom']) && isset($_SESSION['UtilisateurPrenom']) && isset($_SESSION['UtilisateurEmail']) && isset($_SESSION['UtilisateurAuthKey'])) == false ) 
			return;
		if( $_SESSION['UtilisateurAuthKey'] != GsbConfig::$AuthKey )
			return;
		//
		GsbUtilisateur::$Login = $_SESSION['UtilisateurLogin'];
		GsbUtilisateur::$Nom = $_SESSION['UtilisateurNom'];
		GsbUtilisateur::$Prenom = $_SESSION['UtilisateurPrenom'];
		GsbUtilisateur::$Matricule = $_SESSION['UtilisateurMatricule'];
		GsbUtilisateur::$Email = $_SESSION['UtilisateurEmail'];
		GsbUtilisateur::$EtatUtilisateur = GsbUtilisateurEnumEtat::Connecte;
		GsbUtilisateur::avoirLeRole();
	}
}
GsbUtilisateur::initialiseMoi();