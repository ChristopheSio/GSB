<!-- vue : connexion -->
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="login-panel panel panel-default">
			<div class="panel-heading"> <h3 class="panel-title"><i class="fa fa-sign-out fa-fw"></i> Connexion</h3> </div>
			<div class="panel-body">
				<form role="form" method="post" target="">
					<fieldset>
						<input name="hashkey" type="hidden" <?php OutilsForm::value(Vue::$donnees["hashkey"]); ?>>
						<div class="form-group"><input class="form-control" placeholder="Login" name="login" type="text" autofocus <?php OutilsForm::value(Vue::$donnees["login"]); ?>></div>
						<div class="form-group"><input class="form-control" placeholder="Mot de passe" name="password" type="password" <?php OutilsForm::value(Vue::$donnees["password"]); ?>></div>
						<?php if(!is_null(Vue::$donnees["info_connexion"])) { ?> 
							<p class="text-center text-danger"><?php echo Vue::$donnees["info_connexion"]; ?></p>
						<?php } ?>
						<div class="checkbox"><label><input name="remember" type="checkbox" value="1" <?php OutilsForm::checked(Vue::$donnees["remember"]); ?>>Se souvenir de moi</label></div>
						<!-- Change this to a button or input when using this as a form -->
						<input type="submit" class="btn btn-lg btn-success btn-block" value="Se connecter">
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- fin de la vue : connexion -->