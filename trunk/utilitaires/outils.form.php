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
		if ($validProb == 0)
			OutilsForm::incorrecte($message, $explication);
		else if ($validProb == -1)
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

	public static function valideMessage($value, $maxstr = 512) {
		$len = strlen($value);
		return ( ($len > 2) && ($len < $maxstr) ) ? 1 : 0;
	}

	public static function valideEmail($value) {
		return preg_match("#^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$#i", $value);
	}

	/**
	 * Permet d'obtenir/gerer plusieurs donnée d'une rubrique
	 * @param $nomDeDonnee, $contenuDeDonnnee
	 * @return tableau des données
	 */
	public static function ajaxMultipleDonneesInfo() {
		Vue::$ajax["id"] = isset($_POST["MD_Id"]) ? $_POST["MD_Id"] : 1;
	}

	public static function receptionnnerMultipleDonnees($nomDeDonnees, $maxDonnees, $urlAjax, $contenuDeDonnnees) {
		$donnees = array("size" => 0, "overlySize" => 0, "name" => $nomDeDonnees, "max" => $maxDonnees, "url" => $urlAjax, "properties" => $contenuDeDonnnees, "values" => null);
		// Regarde la taille
		$idDonneesOverlySize = $nomDeDonnees . "_OverlySize";
		$idDonneesSize = $nomDeDonnees . "_Size";
		if (!isset($_POST[$idDonneesSize]) && !isset($_POST[$idDonneesOverlySize]))
			return $donnees;
		if ((intval($_POST[$idDonneesSize]) != $_POST[$idDonneesSize]) && (intval($_POST[$idDonneesOverlySize]) != $_POST[$idDonneesOverlySize]))
			return $donnees;
		$donnees["overlySize"] = intval($_POST[$idDonneesOverlySize]);
		$donnees["size"] = intval($_POST[$idDonneesSize]);
		if ($donnees["size"] <= 0 && $donnees["size"] > $maxDonnees)
			return $donnees;
		// Liste les données
		$donnees["values"] = array();
		$iListed = 0;
		$iContentsOk = false;
		for ($i = 0; $i < $donnees["size"]; $i++) {
			$iContentsOk = false;
			foreach ($contenuDeDonnnees as $unContenu) {
				$idDonneesUnContenu = $nomDeDonnee . "_" . $i . "_" . $unContenu;
				if (isset($_POST[$idDonneesUnContenu])) {
					$iContentsOk = true;
					break;
				}
			}
			if ($iContentsOk) {
				$donnees["values"][$iListed] = array();
				foreach ($contenuDeDonnnees as $unContenu) {
					$idDonneesUnContenu = $nomDeDonnee . "_" . $i . "_" . $unContenu;
					$donnees["values"][$iListed][$unContenu] = (isset($_POST[$idDonneesUnContenu])) ? $_POST[$idDonneesUnContenu] : null;
				}
				$iListed++;
			}
		}
		return $donnees;
	}

	public static function implanterAjaxMultipleDonnees($MD) {
		?> 
		<input type="hidden" name="<?php echo $MD["name"]; ?>_Size" id="<?php echo $MD["name"]; ?>_Size" value="0">
		<input type="hidden" name="<?php echo $MD["name"]; ?>_OverlySize" id="<?php echo $MD["name"]; ?>_OverlySize" value="0">
		<div class="MultipleDonnees">
			<div id="MD-<?php echo $MD["name"]; ?>"></div>
			<?php
			if (!is_null($MD["values"])) {
				echo "<span onload='" . 'AjaxMultipleDonneesAjouterListe("' . $MD["name"] . '","' . $MD["url"] . '",' . $MD["max"] . ',[';
				foreach ($MD["values"] as $idDonnees => $donnees) {
					echo '"MD_Id=' . $idDonnees . '&';
					foreach ($donnees as $key => $value) {
						echo "&" . urlencode($key) . "=" . urlencode($value);
					}
					echo '",';
				}
				echo 'null]' . "'></span>";
			}
			?>
			<a id="<?php echo "MD-" . $MD["name"] . "-append"; ?>" class="btn btn-default" onclick='AjaxMultipleDonneesAjouter(<?php echo '"' . $MD["name"] . '","' . $MD["url"] . '",' . $MD["max"]; ?>, null);'><i class="fa fa-plus-circle fa-fw"></i> Ajouter</a>
		</div>
		<?php
	}

}
