<?php

// Action par default 'aucune' 
$action = ( (isset($_REQUEST['action'])) ? $_REQUEST['action'] : null );
include("vues/v_sommaire.php");
switch ($action) {

    case "saisir":
        $lesPraticiens = $pdo->getLesPraticiens();
        include("vues/v_compterendu_saisie.php");
        break;


    case "consulter":
        $lesComptesRendusDuVisiteur = $pdo->getLesComptesRendusDuVisiteur($_SESSION['id']);
        include("vues/v_compterendu_consulter.php");
        break;
}
v_compterendu_saisie.setCompteRendu();
?>
