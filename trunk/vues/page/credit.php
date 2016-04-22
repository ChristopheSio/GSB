<!-- vue : credit -->
<?php if( Controleur::estVueUrlComposeParConstFile(__FILE__) ) { ?>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-ticket fa-fw"></i> Notre équipe</h3></div>
			<div class="panel-body">
				<div class="list-group">
					<a target="_blank" href="http://kimp73.wix.com/portfolio" class="list-group-item">
						<span class="badge">kimp73.wix.com/portfolio</span>
						<span class="lead">Kim Paviot</span>
                                                <ul>
							<li>Développement
								<ul>
									<li>Analyse de bases de données</li>
									<li>Interroger les bases de données</li>
                                                                        <li>Développement web</li>
                                                                        <li>Développement d'applications</li>
                                                                        <li>Développement d'applications Android</li>
								</ul>
							</li>
							<li>Langues
								<ul>
									<li>Anglais : parlé et écrit</li>
                                                                        <li>Espagnol : parlé et écrit</li>
								</ul>
							</li>
							
						</ul>	
					</a>
					<a target="_blank" href="" class="list-group-item">
						<span class="badge"> ? </span>
						<span class="lead">Julien Dignat</span>
					</a>
					<a target="_blank" href="http://christophe-sonntag.u4a.at/" class="list-group-item">
						<span class="badge">christophe-sonntag.u4a.at</span>
						<span class="lead">Christophe Sonntag</span><br/>
						<ul>
							<li>Développement
								<ul>
									<li>Analyse et conception d’application</li>
									<li>Mise en place des procédures de test.</li>
								</ul>
							</li>
							<li>Expertise
								<ul>
									<li>Jeune programmeur indépendant.</li>
								</ul>
							</li>
							<li>Encadrement
								<ul>
									<li>Autodidacte et actif.</li>
									<li>Travail en équipe et en autonomie.</li>
								</ul>
							</li>
						</ul>	
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-get-pocket fa-fw"></i> Reconnaissance</h3></div>
			<div class="panel-body">
				<p>Si votre travail utilise ce service, s'il vous plaît ajouter la mention suivante : </p> 
				<blockquote class="text-center">
					<p>Ce travail est basé (en partie) sur les produits de données généré par l'application <strong>GSB</strong> situé au Lycée Marie Curie de Marseille.</p> 
				</blockquote>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-users fa-fw"></i> Qui sommes nous ?</h3></div>
			<div class="panel-body">
				<p>
					Nous sommes plusieurs développeurs du Lycée Marie Curie de Marseille.<br/>
					En charge d'analiser, de concevoir, de mettre à jour et d'installer l'application web <strong>GSB</strong>.
				</p>
				<p>Ce travail est une projet personnel encadré de l'année 2016.<br/>Développer par <?php echo GsbConfig::$SiteAuteurCreateur; ?> et mis à jour par <?php echo GsbConfig::$SiteAuteurDev; ?>.</p> 
				<?php if( !Controleur::estVueUrlComposeParConstFile(__FILE__) ) { ?>
					<p>Pour en savoir plus aller sur : <?php OutilsUrl::composerLien("Crédit","page","credit"); ?></p> 
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-life-ring fa-fw"></i> Support</h3></div>
			<div class="panel-body">
				<div class="row ">
					<a target="_blank" href="http://sio.u4a.at/"><img class="col-xs-4 col-sm-6 col-md-3 img-responsive" alt="BTS SIO SLAM" src="images/support/bts-sio.gif"/></a>
					<a target="_blank" href="http://www.ac-aix-marseille.fr/"><img class="col-xs-4 col-sm-6 col-md-3 img-responsive" alt="Académie Aix-Marseille" src="images/support/ac_marseille.png"/></a>
					<a target="_blank" href="http://www.univ-amu.fr/"><img class="col-xs-4 col-sm-6 col-md-3 img-responsive" alt="Université Aix-Marseille" src="images/support/AMU.jpg"/></a>
					<a target="_blank" href="http://www.lyc-curie.ac-aix-marseille.fr/"><img class="col-xs-4 col-sm-6 col-md-3 img-responsive" alt="Lycée Marie Curie Marseille" src="images/support/logo_LMC.png"/></a>
				</div>
				<div class="row ">
					
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin de la vue : credit -->