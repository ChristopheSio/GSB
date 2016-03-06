<!-- vue : navigation -->
<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse">
		<ul class="nav" id="side-menu">
			<li class="sidebar-search">
				<div class="input-group custom-search-form">
					<input type="text" class="form-control" placeholder="Search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button">
						<i class="fa fa-search"></i>
					</button>
				</span>
				</div>
				<!-- /input-group -->
			</li>
			<li><a <?php OutilsUrl::composerHref("page","accueil"); ?>><i class="fa fa-home fa-fw"></i> Accueil</a></li>
			<li>
				<a href="#"><i class="fa fa-files-o fa-fw"></i> Compte rendu<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a <?php OutilsUrl::composerHref("compte-rendu","liste"); ?> title="Consulter les comptes rendus"><i class="fa fa-list-alt fa-fw"></i> Liste</a></li>
					<li><a <?php OutilsUrl::composerHref("compte-rendu","saisir"); ?> title="Saisir un compte rendu"><i class="fa fa-pencil-square-o fa-fw"></i> Saisir</a></li>
				</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-files-o fa-fw"></i> Praticiens<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a <?php OutilsUrl::composerHref("praticien","liste"); ?> title="Consulter tous les praticiens"><i class="fa fa-list-alt fa-fw"></i> Liste</a></li>
					<li><a <?php OutilsUrl::composerHref("praticien","details"); ?> title="Consulter un praticien"><i class="fa fa-search fa-fw"></i> Détails</a></li>
				</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-files-o fa-fw"></i> Médicaments<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a <?php OutilsUrl::composerHref("medicament","liste"); ?> title="Consulter les médicaments"><i class="fa fa-list-alt fa-fw"></i> Liste</a></li>
					<li><a <?php OutilsUrl::composerHref("medicament","details"); ?> title="Consulter un médicament"><i class="fa fa-search fa-fw"></i> Détails</a></li>
				</ul>
			</li>
			<li><a <?php OutilsUrl::composerHref("visiteur","liste"); ?> title="Consulter les visiteurs"><i class="fa fa-user-md fa-fw"></i> Consulter les visiteurs</a></li>
			<li><a <?php OutilsUrl::composerHref("rapport","liste"); ?> title="Consulter les rapports de visite"><i class="fa fa-file-text fa-fw"></i> Consulter les rapports de visite</a></li>
			<li>
				<a href="#"><i class="fa fa-files-o fa-fw"></i> GSB<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a <?php OutilsUrl::composerHref("gsb","travail"); ?>><i class="fa fa-globe fa-fw"></i> Travail</a></li>
					<li><a <?php OutilsUrl::composerHref("gsb","documentation"); ?>><i class="fa fa-book fa-fw"></i> Documentation</a></li>
				</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-files-o fa-fw"></i> Team<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a <?php OutilsUrl::composerHref("page","contact"); ?>><i class="fa fa-weixin fa-fw"></i> Contact</a></li>
					<li><a <?php OutilsUrl::composerHref("page","credit"); ?>><i class="fa fa-briefcase fa-fw"></i> Crédit</a></li>
				</ul>
			</li>
			<li><a class="text-warning bg-warning" <?php OutilsUrl::composerHref("page","debug"); ?>><i class="fa fa-user-secret fa-fw"></i> Debug</a></li>
		</ul>
	</div>
	<!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
<!-- fin de la vue navigation -->