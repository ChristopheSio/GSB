<!-- vue : menu -->
<ul class="nav navbar-top-links navbar-right">
	<?php 
	if( GsbUtilisateur::estConnecte() ) {
		//include("vues/gabarit/menu_messages.php");
		//include("vues/gabarit/menu_taches.php");
		//include("vues/gabarit/menu_alertes.php");
	}
	include("vues/gabarit/menu_utilisateur.php"); 
	?>
</ul>
<!-- fin de la vue : menu -->