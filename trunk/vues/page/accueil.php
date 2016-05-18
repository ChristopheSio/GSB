<!-- vue : accueil -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header text-center">
			<span style="display:None;"><?php echo GsbConfig::$SiteName; ?></span>
			<img alt="<?php echo GsbConfig::$SiteName; ?>" src="images/logo.png" /><br/>
			<strong>G</strong>alaxy-<strong>S</strong>wiss <strong>B</strong>ourdin<br/>Visites
		</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-weixin fa-fw"></i> Projet d'application : Gestion des visites</h3></div>
			<div class="panel-body text-center">
				<p><img alt="<?php echo GsbConfig::$SiteName; ?>" src="images/logo-capsules.png" />Cette application permet l'enregistrement et le suivi des comptes-rendus de visite des practiciens de l'activité commerciale d'un laboratoire pharmaceutique</p>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Notre interface</h3></div>
			<div class="panel-body">
				<p>Cette interface comprend différentes parties : </p> 
				<ul>
					<li>Une gestion pour les visiteurs</li>
					<li>Une gestion pour les délégués</li>
					<li>Une gestion pour les responsables</li>
				</ul>
				<?php if( GsbUtilisateur::estConnecte() ) { ?>
					<p>Une documentation détailé est disponible ici : <?php OutilsUrl::composerLien("Documentation","gsb","documentation"); ?>
				<?php } else { ?>
					<p>Pour acceder à la documentation, veuillez vous conecter : <?php OutilsUrl::composerLien("Se connecter","compte","connexion"); ?>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-weixin fa-fw"></i> Contactez nous</h3></div>
			<div class="panel-body">
				<p>Pour des questions spécifiques liées à <strong>GSB</strong>, veuillez communiquer avec par notre page de contact : <?php OutilsUrl::composerLien("Contact","page","contact"); ?></p> 
			</div>
		</div>
	</div>
</div>
<?php include("vues/page/credit.php"); ?>
<!-- fin de la vue : accueil -->