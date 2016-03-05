<?php
/** 
 * Chargement des utilitaires
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */

/** Configuration de GSB
 */
require_once("utilitaires/gsb.config.php");

/** Modèle des donnée a trater depuis la base
 */
require_once("utilitaires/gsb.modele.php");

/** Relation des utilisateurs dans GSB
 */
require_once("utilitaires/gsb.utilisateur.php");
 
/** Outils pour traiters les dates
 */
require_once("utilitaires/outils.date.php");

/** Outils pour traiters les erreurs
 */
require_once("utilitaires/outils.erreur.php");

/** Outils pour traiters les url
 */
require_once("utilitaires/outils.url.php");

/** Outils pour traiters les formulaires
 */
require_once("utilitaires/outils.form.php");


/** Gestion des
 */
require_once("utilitaires/vue.php");

/** Gestion des controleurs
 */
require_once("utilitaires/controleur.php");