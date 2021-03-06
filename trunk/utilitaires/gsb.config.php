<?php
/** 
 * Fichier de configuration pour l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */

/** ! Attention en cas de modification importante ! 
  - Modifier le fichier .htaccess à la recine du site. 
**/

class GsbConfig
{
    /** Configuration du site
     */
    static $SiteName = "Galaxy-Swiss Bourdin Visites";
    static $SiteDirectory = "GSB/trunk"; // modif aussi dans htaccess. sans << / >> de fin ex : GSB/trunk
    static $SiteShortUrl = "gsb.ppe.sio.u4a.at";
    static $SiteContactEmail = "gsb.ppe.sio@yopmail.com";
    static $SiteAuteur = "Crée par Cheri Bibi. Mis à jour par Kim Paviot, Julien Dignat et Christophe Sonntag.";
    static $SiteAuteurCreateur = "Cheri Bibi";
    static $SiteAuteurDev = "Kim Paviot, Julien Dignat et Christophe Sonntag";
    static $SiteCommunaute = "2016 - Lycée Marie Curie Marseille - BTS SLAM G2";
    static $SiteUrl = null;

    /** Configuration de l'authenticité des données
     */
    static $AuthKey = "718fa71d46fbfe3a7086c6f2710e71a4";

    /** Configuration de la base de donnée
    */
    static $BdType = 'mysql';
    static $BdServeur = 'localhost';
    static $BdBase = 'sio_gsb';
    static $BdUtilisateur = 'root';
    static $BdMotDePasse = '';
	
	/** Configuration de réecriture d'url
    */
	static $RewriteRuleForce = false; // pour serveur qui n'ont pas de detection
}

/** Initialise les valeurs qui requière un instanciation hors classe
*/
GsbConfig::$SiteUrl = "http://".$_SERVER["SERVER_NAME"].((GsbConfig::$SiteDirectory!="")?('/'.GsbConfig::$SiteDirectory):"");