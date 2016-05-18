<!-- vue : accueil -->
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
		<?php if( !$okCookie && $okPost) { ?>
			<div class="panel-heading text-center"><h2>Pour contacter notre equipe, cookies necessaire</h2></div>
			<div class="panel-body text-center"><h2>Pour envoyer un message veuillez activer les cookies</h2></div>
		<?php } else if($okForm && !$okMail) { ?>
			<div class="panel-heading text-center"><h2>Erreur lors de l'envoi</h2></div>
			<div class="panel-body text-center"><?php OutilsForm::erreurEmailContact("La fonction mail"); ?></div>
		<?php } else if($okForm && $okMail) { ?>
			<div class="panel-heading text-center"><h2>Je vous remercie pour votre message</h2></div>
		<?php } else if(!$okTime) { ?>
			<div class="panel-heading text-center"><h2>Je vous remercie pour votre message</h2></div>
			<div class="panel-body text-center"><p>Temps d'attente avant prochain message <?php echo $info_timewait; ?> secondes </p></div>	
		<?php } else { ?>
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-weixin fa-fw"></i> Contacter notre equipe</h3></div>
			<div class="panel-body">
				<form action="" method="post">
					<div class="form-group">
						<label for="name">Nom</label>
						<input <?php OutilsForm::disabled($name_locked); ?> type="text" class="form-control" name="name" id="name" placeholder="Nom" <?php OutilsForm::value($name); ?>>
						<?php OutilsForm::validProbleme($valid_name, "Le nom"); ?>
					</div>
					<div class="form-group">
						<label for="email">Adresse e-mail</label>
						<input <?php OutilsForm::disabled($email_locked); ?> type="text" class="form-control" name="email" id="email" placeholder="Adresse e-mail" <?php OutilsForm::value($email); ?>>
						<?php OutilsForm::validProbleme($valid_email, "L'adresse e-mail"); ?>
					</div>
					<div class="form-group">
						<label for="subject">Sujet</label>
						<input type="text" class="form-control" name="subject" id="subject" placeholder="Sujet" <?php OutilsForm::value($subject); ?>>
						<?php OutilsForm::validProbleme($valid_subject, "Le sujet"); ?>
					</div>
					
					<div class="form-group">
						<label for="captcha">Captcha</label>
						<div class="form-inline">
							<div class="form-group">
								<span><img id="captcha-img" src="images/captcha.php" alt="Code de vérification"> </span>
								<span><button type="button" class="fa fa-refresh form-control min-button" id="refresh-captcha" onclick="document.getElementById(&quot;captcha-img&quot;).src=&quot;images/captcha.php?r=&quot;+new Date().getMilliseconds();"></button></span>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="captcha" id="captcha" placeholder="Captcha">
							</div>
						</div>
						<?php OutilsForm::validProbleme($valid_captcha, "Le captcha"); ?>
					</div>
					<div class="form-group">
						<label for="question">Question/Remarque/Bug</label>
						<select class="form-control" name="question" id="question">
							<option <?php OutilsForm::selectedCompose($question,"question"); ?>>Question</option>
							<option <?php OutilsForm::selectedCompose($question,"remarque"); ?>>Remarque</option>
							<option <?php OutilsForm::selectedCompose($question,"erreur"); ?>>Erreur/Bug</option>
						</select>
						<?php OutilsForm::validProbleme($valid_question, "Question/Remarque/Bug"); ?>
					</div>
					<div class="form-group">
						<label for="message">Message</label>
						<textarea rows="8" class="form-control" name="message" id="message" maxlength="512" placeholder="Message"><?php echo $message; ?></textarea>
						<?php OutilsForm::validProblemePourNombreDeCaractere($valid_message, "Le message", strlen($message),3,512); ?>
					</div>
					<?php OutilsForm::implanterFormulaireId("contact"); ?>
					<div class="col-md-6 col-md-offset-3">
						<div class="form-group"><input class="btn btn-success form-control btn-success" type="submit" value="Envoyer le message"></div>
						<div class="form-group"><input class="btn btn-default form-control" type="reset" value="Réinitialiser le formulaire"></div>
					</div>		
				</form>
			</div>
		<?php } ?>
		</div>
	</div>
</div>
<!-- fin de la vue : accueil -->