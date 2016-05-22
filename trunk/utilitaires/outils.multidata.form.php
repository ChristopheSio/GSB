<?php
/**
 * Fonctions pour la gestion des formulaires en chaine de l'application GSB
 * @package default
 * @author Christophe Sonntag
 * @version 1.1
 */
class OutilsMultidataForm {

	public static function ajaxReceive() {
		$data = array( 
			"id" => (isset($_POST["MD_Id"]) ? $_POST["MD_Id"] : "unknown"),
			"place" => (isset($_POST["MD_Place"]) ? $_POST["MD_Place"] : 1),
			"data" => null,
		);
		$data["data"] = $data["id"]."_data_".$data["place"];
		return $data;
	}
	
	public static function init($multidataId, $maxSize, $urlAjax, $properties) {
		$data = array("size" => 0,"overlySize" => 0, "id" => $multidataId, "max" => $maxSize, "url" => $urlAjax, "properties" => $properties, "values" => null, "errors" => array() );
		OutilsMultidataForm::initValues($data);
		return $data;
	}
	
	private static function initValues(&$data) {
		$idDonneesOverlySize = $data["id"] . "_overlysize";
		$idDonneesSize = $data["id"] . "_size";
		//
		if (!isset($_POST[$idDonneesSize]) && !isset($_POST[$idDonneesOverlySize])) 
			return;
		if ( (intval($_POST[$idDonneesSize]) != $_POST[$idDonneesSize]) && (intval($_POST[$idDonneesOverlySize]) != $_POST[$idDonneesOverlySize]) ) {
			$data["errors"][] = "Une erreur est survenue, le nombre d'élement est incompris";
			return;
		}
		//
		$data["overlySize"] = intval($_POST[$idDonneesOverlySize]);
		$data["size"] = intval($_POST[$idDonneesSize]);
		//
		if ( ($data["size"] > $data["overlySize"]) || ($data["overlySize"]>1000) ) {
			$data["errors"][] = "Le nombre d'élément ne correspond pas aux données";
			return;
		}
		//
		if ($data["size"] < 0 || $data["size"] > $data["max"]) {
			$data["errors"][] = "Le nombre d'élément est inccorecte : ".$data["size"]."/".$data["max"];
		}
		// Liste les données
		$data["values"] = array();
		$iListed = 0;
		$iPropertiesOk = false;
		$iIdDataProperty = "";
		for ($i = 0; $i < $data["overlySize"]; $i++) {
			$iPropertiesOk = false;
			foreach ($data["properties"] as $property) {
				$iIdDataProperty = $data["id"] . "_data_" . $i . "_" . $property;
				if (isset($_POST[$iIdDataProperty])) {
					$iPropertiesOk = true;
					break;
				}
			}
			if ($iPropertiesOk) {
				$data["values"][$iListed] = array();
				foreach ($data["properties"] as $property) {
					$iIdDataProperty = $data["id"] . "_data_" . $i . "_" . $property;
					$data["values"][$iListed][$property] = (isset($_POST[$iIdDataProperty])) ? $_POST[$iIdDataProperty] : null;
				}
				$iListed++;
			}
		}
	}

	public static function implanter($data,$multidataFormTitle,$multidataTableColumns) {
		$multidataId = $data["id"];
		include("vues/utilitaire/outil.multidata.form.php");
	}
	
	public static function genererName($data,$nom) {
		return $data["data"]."_".$nom;
	}
	
	
	
		/*
		
		
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
		 */

}
