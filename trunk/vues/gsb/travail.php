<!-- vue : gsb/travail -->
<div class="panel panel-default">
	<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-globe fa-fw"></i> Mission 1</h3></div>
	<div class="panel-body">
		<p>Après avoir mis en place le site internet et sa base de données, nous allons continuer son développement.</p>
		<p>Les différents cas d’utilisations :</p>
			<ul>
				<li>Se connecter/ se déconnecter</li>
				<li>Consulter les praticiens</li>
				<li>Consulter les médicaments</li>
				<li>Saisir un CR</li>
			</ul>
		<p>La connexion requiert un identifiant et un mot de passe. Un message d’erreur apparaît si l’identifiant et/ou le mot de passe est erronés.</p>
		<p>Une fois connecté, la page d’accueil visiteur nous est présentée. Sur la gauche nous pouvons retrouver une barre de menu avec plusieurs rubriques telles que « Nouveau », « Consulter », etc. Cependant, ces dites rubriques ne sont pas disponibles et renvoient à la page de connexion. Il est donc conseillé de les développer afin de répondre au cahier des charges. Sur la droite se trouve le contenu de la page lui aussi en attente de développement.</p>
		<p>Donc notre site internet doit être entièrement pensé pour répondre aux cas d’utilisation du cahier des charges. Première étape, nous devons réaliser une maquette pour chaque cas d’utilisation. Deuxième étapes, il nous faudra créer les contrôleurs associé aux cas d’utilisation. Troisième étapes, nous allons donc modifier le fichier index.php pour y ajouter nos contrôleurs. Et en quatrième étapes, nous allons ajouter les accès à la base de données dans le modèle afin d’intervenir sur nos praticiens, médicaments et compte rendu.</p>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-globe fa-fw"></i> Mission 2</h3></div>
	<div class="panel-body">
		<p>L'utilisation de NetBeans et de GitHub Desktop nous a permis de travailler en équipe et à distance.</p>
		<p>L'installation sur un nom de domaine, ici : <a href="<?php echo GsbConfig::$SiteUrl; ?>"><?php echo GsbConfig::$SiteUrl; ?></a>, a été gentillement réalisé par Christophe, l'un des membres de l'équipe.</p>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-globe fa-fw"></i> Mission 3</h3></div>
	<div class="panel-body">
		<p>La gestion des visites est donc un processus hiérarchique établit par des Visiteurs et des Délégués régionaux qui sont sous la tutelle d’un Responsable de secteur. Cela se décompose donc en différentes parties, la connexion, les modules de gestion et les statistiques.</p>
		<p>La gestion des visites est donc composée en 3 modules distincts</p>
		<ul>
			<li>Le visiteur peut saisir/consulter ses comptes rendu.</li>
			<li>Le délégué régional peut accéder au compte-rendu de sa région et peut agir comme un visiteur.</li>
			<li>Le responsable secteur peut consulter de façon détaillée les visiteurs/équipes de son secteur.</li>
		</ul>
		<p>Pour chaque module des statistiques/bilans sont disponible avec des graphiques</p>
		<ul>
			<li>Cela permet de connaitre l’activité d’un/des employés.</li>
			<li>Le nombre de visiteur rattaché à une région.</li>
			<li>Les médicaments les plus courants.</li>
			<li>Ainsi que d’autre statistique en général.</li>
		</ul>
		<p>Suivant les utilisateurs différents accès/permissions sont autorisés une fois authentifié</p>
		<ul>
			<li>Tous les utilisateurs peuvent accéder aux praticiens et médicaments.</li>
			<li>Seul le responsable a un accès aux visiteurs et aux statistiques les concernant.</li>
			<li>Seul un délégué a accès aux autres comptes rendus des visiteurs, seulement ceux de sa région.</li>
		</ul>
	</div>
</div>
<img class='center-block' alt="<?php echo GsbConfig::$SiteName; ?>" src="images/logo-capsules.png" />
<br/>
<!-- fin de la vue : gsb/travail -->