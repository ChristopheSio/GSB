<!-- vue : menu utilisateur -->
<?php if( GsbUtilisateur::estConnecte() ) { ?>
	<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
			<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
		</a>
		<ul class="dropdown-menu dropdown-user">
			<li class="text-center">
				<p class="h4"><?php echo GsbUtilisateur::$Nom." ".GsbUtilisateur::$Prenom; ?></p>
				<p>Matricule : <?php echo GsbUtilisateur::$Matricule; ?><br/>Rôle : <?php echo GsbUtilisateur::quelRoleTexte(); ?></p>
			</li>
			<li class="divider"></li>
			<li><a <?php OutilsUrl::composerHref("profile","statut"); ?>><i class="fa fa-user fa-fw"></i> Statut</a></li>
			<li><a <?php OutilsUrl::composerHref("profile","parametres"); ?>><i class="fa fa-gear fa-fw"></i> Parametres</a></li>
			<li class="divider"></li>
			<li><a <?php OutilsUrl::composerHref("compte","deconnexion"); ?>><i class="fa fa-sign-out fa-fw"></i> Deconnexion</a></li>
		</ul>
		<!-- /.dropdown-user -->
	</li>
<?php } else { ?>
	<li class="dropdown">
		<a <?php OutilsUrl::composerHref("compte","connexion"); ?>> <i class="fa fa-sign-in fa-fw"></i> Connexion</a>
	</li>
<?php } ?>
<!-- /.dropdown -->
<!-- fin de la vue : menu utilisateur -->