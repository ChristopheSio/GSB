<!-- vue : connexion-redirection -->
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="login-panel panel panel-default">
			<div class="panel-heading"> <h3 class="panel-title"><i class="fa fa-sign-out fa-fw"></i> Connexion</h3> </div>
			<div class="panel-body text-center">
				<h2>Vous êtes déja connecté</h2>
				<p>Rechargement de la page dans <?php echo Vue::$donnees["rechargement_temps"]; ?>s</p>
			</div>
		</div>
	</div>
</div>
<!-- fin de la vue : deconnexion -->