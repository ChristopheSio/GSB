<!-- vue : menu -->
<ul class="nav navbar-top-links navbar-right">
	<?php if( GsbUtilisateur::estConnecte() ) { ?> 
		<?php include("vues/gabarit/menu_messages.php"); ?>
		<?php include("vues/gabarit/menu_taches.php"); ?>
		<?php include("vues/gabarit/menu_alertes.php"); ?>
	<?php } ?>
	<?php include("vues/gabarit/menu_utilisateur.php"); ?>
</ul>
<!-- fin de la vue : menu -->