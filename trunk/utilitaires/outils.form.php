<?php

/**
 * Fonctions pour la gestion des formulaire de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */
class OutilsForm {

	/**
	 * Affiche le contenu de value pour un input
	 * @param $value est le contenue a afficher
	 */
	public static function value($value) {
		echo 'value="' . $value . '"';
	}

	/**
	 * Affiche le checked
	 * @param $checked
	 */
	public static function checked($checked) {
		if ($checked)
			echo 'checked="checked"';
	}

	/**
	 * Affiche le disabled
	 * @param $disabled
	 */
	public static function disabled($disabled) {
		if ($disabled)
			echo 'disabled="disabled"';
	}

	/**
	 * Affiche le selected
	 * @param selected
	 */
	public static function selectedCompose($selected, $value) {
		if (strval($selected) == strval($value))
			echo 'selected="selected" ';
		echo 'value="' . $value . '"';
	}

	/**
	 * Affiche un information pour l'utilisateur
	 * @param $str
	 */
	public static function info($str) {
		echo '<div class="panel panel-info"><div class="panel-heading"><i class="fa fa-info fa-fw"></i> ' . $str . '</div></div>';
	}

	/**
	 * Affiche un information pour l'utilisateur
	 * @param $str
	 */
	public static function success($str) {
		echo '<div class="panel panel-success"><div class="panel-heading"><i class="fa fa-table fa-fw"></i> ' . $str . '</div></div>';
	}
	
	/**
	 * Affiche un information pour l'utilisateur
	 * @param $str
	 */
	public static function danger($str) {
		echo '<div class="panel panel-danger"><div class="panel-heading">' . $str . '</div></div>';
	}

	/**
	 * Permet de partager les informations concernant OutilUrl
	 * @param $str
	 */
	public static function OutilUrlComposeGet($str) {
		echo '<div class="panel panel-info"><div class="panel-heading"><i class="fa fa-info fa-fw"></i> ' . $str . '</div></div>';
	}

	/**
	 * Affiche le problème venant de l'utilisateur
	 * @param $str, $explication
	 */
	public static function incorrecte($str, $explication = null) {
		echo '<div class="panel panel-warning"><div class="panel-heading">' . $str . ' n\'est pas correcte' . (($explication != null) ? ('<br/>' . $explication) : '') . '</div></div>';
	}

	/**
	 * Affiche le problème venant du serveur
	 * @param $str
	 */
	public static function erreur($str, $explication = null) {
		echo '<div class="panel panel-danger"><div class="panel-heading">' . $str . ' n\'est pas accessible, <a href="' . OutilsUrl::composer("page", "contact", "errorpage=" . base64_encode($str)) . '">Contacter les administrateurs, ' . GsbConfig::$SiteName . '</a>' . (($explication != null) ? ('<br/>' . $explication) : '') . '</div></div>';
	}

	public static function erreurEmailContact($str, $explication = null) {
		echo '<div class="panel panel-danger"><div class="panel-heading">' . $str . ' n\'est pas accessible, <a href="mailto:' . GsbConfig::$SiteContactEmail . '">Contacter les administrateurs par email : ' . GsbConfig::$SiteContactEmail . '</a>' . (($explication != null) ? ('<br/>' . $explication) : '') . '</div></div>';
	}

	/**
	 * Affiche le problème venant de l'utilisateur ou du serveur si validProbleme n'est pas égal a 1
	 * @param $validProb,$message,$explication=nul
	 */
	public static function validProbleme($validProb, $message, $explication = null) {
		if (($validProb === 0) || ($validProb===false))
			OutilsForm::incorrecte($message, $explication);
		else if ($validProb === -1)
			OutilsForm::erreur($message, $explication);
	}

	public static function validProblemePourNombreDeCaractere($validProb, $message, $nbCaractere, $minCaractere, $maxCaractere) {
		$explication = "Vous n’êtes pas dans l’intervalle de caractère autorisé :   " . $minCaractere . "<= <strong>" . $nbCaractere . "</strong> <=" . $maxCaractere;
		if ($validProb == 0)
			OutilsForm::incorrecte($message, $explication);
		else if ($validProb == -1)
			OutilsForm::erreur($message, $explication);
	}

	/**
	 * Validation de l'id du formulaire
	 */
	public static function genFormulaireId($idFormulaire) {
		if (isset($_SESSION["FormHashkey_" . $idFormulaire]))
			$_SESSION["FormOldHashkey_" . $idFormulaire] = $_SESSION["FormHashkey_" . $idFormulaire];
		$_SESSION["FormHashkey_" . $idFormulaire] = md5(rand(0, 10000));
	}

	public static function valideFormulaireId($idFormulaire) {
		if (!isset($_POST["hashkey"]) || !isset($_SESSION["FormHashkey_" . $idFormulaire]))
			return false;
		return $_SESSION["FormHashkey_" . $idFormulaire] == $_POST["hashkey"];
	}

	public static function implanterFormulaireId($idFormulaire) {
		if (isset($_SESSION["FormHashkey_" . $idFormulaire]))
			echo '<input name="hashkey" type="hidden" value="' . $_SESSION["FormHashkey_" . $idFormulaire] . '">';
		if (isset($_POST["hashkey"]) && isset($_SESSION["FormOldHashkey_" . $idFormulaire])) {
			if ($_SESSION["FormOldHashkey_" . $idFormulaire] != $_POST["hashkey"]) {
				echo '<div class="panel panel-danger"><div class="panel-heading">Erreur, securité des échanges ! <br/>Un autre formulaire sur cette page était actif. Vous pouvez maintenant ré-envoyer le formulaire</div></div>';
			}
		}
	}
	
	/**
	 * Permet de verifié si les entrée existe
	 * @param $listEntrees
	 * @return -1 si inexistant et 0 ou 1 si valide
	 */
	public static function existePostEntrees($listEntrees) {
		foreach($listEntrees as $uneEntree) {
			if(!isset($_POST[$uneEntree])) 
				return false;
		}
		return true;
	}

	/**
	 * Validation du captcha
	 * @param $value
	 * @return -1 si inexistant et 0 ou 1 si valide
	 */
	public static function valideCaptcha($value) {
		return ( isset($_SESSION["CaptchaKey"]) ?
						(($_SESSION["CaptchaKey"] == $value) ? 1 : 0) : -1
				);
	}

	/**
	 * Réinitialise le captcha
	 */
	public static function resetCaptcha() {
		return $_SESSION["CaptchaKey"] = null;
	}

	/**
	 * Validation formulaire
	 * @param $value
	 * @return vrai si valide 
	 */
	public static function valideSelect($value, $estDansListe) {
		return in_array($value, $estDansListe) ? 1 : 0;
	}

	/*public static function valideTableList($tableList, $nomColonne, $doitEtreEgal) {
		foreach($tableList as $ligneTable) {
			if(isset($ligneTable[$nomColonne]))
				if( $ligneTable[$nomColonne]!=$doitEtreEgal )
					return 0;
		}
		return 1;
	}*/
	
	
	/* Valide une liste de validation 
	 */
	public static function valideListValid($listValid,$doitEtreEgal=1) {
		foreach($listValid as $aValid) {
			if( $aValid!=$doitEtreEgal )
				return 0;
		}
		return 1;
	}
	
	/**
	 * Regex de validation
	 * @param $value
	 * @return vrai si valide valideSelect
	 */
	public static function valideNom($value) {
		return preg_match("#^[a-zA-ZÀ-ÿ\s\’-]{2,40}$#", $value);
	}

	public static function valideSujet($value) {
		return preg_match("#^[0-9a-zA-ZÀ-ÿ\s,\’\:\-\.\?\!\(\)\[\]]{2,80}$#", $value);
	}

	public static function valideMessage($value, $maxstr=512) {
		$len = strlen($value);
		return (($len>=2)&&($len<=$maxstr))?1:0;
	}

	public static function valideEmail($value) {
		return preg_match("#^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$#i", $value);
	}
	
	public static function valideDate($date,$timeMax=null) {
		if( preg_match(  '/[0-9]{4}-[0-9]{2}-[0-9]{2}/i', $date ) ) {
			if(!is_null($timeMax)) {
				if(strtotime($date)>$timeMax) 
					return false;
			}
			return true;
		}
		return false;
	}
	
}
