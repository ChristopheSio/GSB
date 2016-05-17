<?php
/** 
 * Classe de gestion des vues pour l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */

class Vue
{
	/** Titre de la page
	*/
	public static $title = null;
	
	/** Description de la page
	*/
	public static $description = null;
	
	/** Informations pour la vue
	*/
	public static $donnees = array();
	
	/** Informations pour la vue si ajax
	*/
	public static $ajax = array("id"=>null);
	
	/** Personalisation du header de la page
	*/
	public static $ListScript = array();
	public static $ListStyle = array();
	public static $ListStyleEncre = array();
	public static $HeaderSupplement = "";
	
	/** Variables de gestion de la vue
	*/
	private static $ConfigModuleImport = array();
	
	/** Permet de savoir si une donnée existe
	*/
	public static function existDonnee($donneeNom) {
		return isset(Vue::$donnees[$donneeNom]);
	}
	/** Permet de concatener un element javascript pour su html
	*/
	public static function afficheJavascriptEncre($str) {
		//return '<script type="text/javascript">'."\n//<![CDATA[\n". $str ."\n//]]>\n</script>";
		echo '<script type="text/javascript">'.$str ."</script>";
	}
	/** Permet d'inclure les configuration de DataTable
	*/
	public static function configToDataTable($DataTableId,$DataTableJson=null,$DataTableScript=null) {
		if(!in_array("dataTables", Vue::$ConfigModuleImport)){
			Vue::$ListStyle[] = "css/dataTables.bootstrap.css";
			Vue::$ListScript[] = "js/jquery.dataTables.min.js";
			Vue::$ListScript[] = "js/dataTables.bootstrap.min.js";
			Vue::$ConfigModuleImport[] = "dataTables";
		}
		//Vue::$ListStyleEncre[] = ('$(document).ready(function() {  var '.$DataTableId.' = $("#'.$DataTableId.'").DataTable( $.extend({}, { "responsive": true, "ordering": false, "pageLength": 10,  "language": { "url": "i18n/DataTables.French.json" } }'.(is_null($DataTableJson)?"":(",".json_encode($DataTableJson,JSON_FORCE_OBJECT ))).')); '.(is_null($DataTableScript)?"":$DataTableScript).' });');
		Vue::$ListStyleEncre[] = ('$(document).ready(function() {  var '.$DataTableId.' = $("#'.$DataTableId.'").DataTable($.extend({},{"responsive":true,"ordering":false,"pageLength":10,"stateSave":false,"language":{"url":"i18n/DataTables.French.json"}}'.(is_null($DataTableJson)?"":(",".json_encode($DataTableJson,JSON_FORCE_OBJECT ))).')); '.(is_null($DataTableScript)?"":$DataTableScript).' });');
	}
	/** Permet d'inclure les configuration de DataTable
	*/
	public static function configToJqvmap() {
		if(!in_array("jqvmap", Vue::$ConfigModuleImport)){
			Vue::$ListStyle[] = "css/jqvmap.css";
			Vue::$ListScript[] = "js/jquery.vmap.js";
			Vue::$ListScript[] = "js/jquery.vmap.france.js";
			Vue::$ListScript[] = "js/jquery.vmap.colorsFrance.js";
			Vue::$ConfigModuleImport[] = "jqvmap";
		}
	}

}