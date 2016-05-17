<!-- vue : practicien/details -->
<div class="row">
	<div class="col-lg-4 col-md-5">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-search fa-fw"></i> Choix praticien</h3></div>
			<div class="panel-body">
				<?php if(Vue::$donnees["lesPraticiensSontVide"]) { ?>
					<h3 class="text-center">Aucun praticien</h3>
				<?php } else { ?>
					<form action="<?php echo OutilsUrl::composer("praticien","details"); ?>" method="GET" class="form-inline"> 	
						<?php OutilsUrl::formComposerInput("praticien","details"); ?>
						<div class="form-group">
							<select class="form-control" name="num" id="depot" onchange="this.form.submit()">
							<?php foreach( Vue::$donnees["lesPraticiens"] as $unPraticien ) { ?>
								<option <?php OutilsForm::selectedCompose( Vue::$donnees["lePraticienNum"],$unPraticien["PRA_NUM"]);?>><?php echo $unPraticien["PRA_NOM"]." ".$unPraticien["PRA_PRENOM"]; ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="btn-group" role="group" aria-label="Navigation">
							<?php if(Vue::$donnees["lePraticien"]) { 
								if(Vue::$donnees["lePraticienPrecedant"]) { ?>
									<a type="button" class="btn btn-default" <?php OutilsUrl::composerHref("praticien","details","num=".Vue::$donnees["lePraticienPrecedant"]["PRA_NUM"]);?>><i title="Precédant" class="fa fa-chevron-circle-left fa-fw text-info"></i></a>
								<?php } else { ?>
									<a type="button" disabled="disabled" class="btn btn-default"><i title="Precédant" class="fa fa-chevron-circle-left fa-fw text-info"></i></a>
								<?php } if(Vue::$donnees["lePraticienSuivant"]) { ?>
									<a type="button" class="btn btn-default" <?php OutilsUrl::composerHref("praticien","details","num=".Vue::$donnees["lePraticienSuivant"]["PRA_NUM"]);?>><i title="Suivant" class="fa fa-chevron-circle-right fa-fw text-info"></i></a>
								<?php } else { ?>
									<a type="button" disabled="disabled" class="btn btn-default"><i title="Suivant" class="fa fa-chevron-circle-right fa-fw text-info"></i></a>
								<?php }
							} else { ?>
								<button class="btn btn-default" type="submit"><i title="Aller" class="fa fa-check-circle fa-fw text-primary"></i></button>
							<?php } ?>
						</div>
					</form>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php if(Vue::$donnees["lePraticien"]) { ?>
		<div class="col-lg-8 col-md-7">
			<div class="panel panel-default">
				<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-user fa-fw"></i> Details praticien <?php echo Vue::$donnees["lePraticien"]["PRA_NOM"]." ".Vue::$donnees["lePraticien"]["PRA_PRENOM"]; ?></h3></div>
				<div class="panel-body">
					<table class="table">
						<tr>
							<td>N°</td>
							<td><?php echo Vue::$donnees["lePraticien"]["PRA_NUM"]; ?></td>
						</tr><tr>
							<td>Nom</td>
							<td><?php echo Vue::$donnees["lePraticien"]["PRA_NOM"]; ?></td>
						</tr><tr>
							<td>Prénom</td>
							<td><?php echo Vue::$donnees["lePraticien"]["PRA_PRENOM"]; ?></td>
						</tr><tr>
							<td>Adresse</td>
							<td><?php echo Vue::$donnees["lePraticien"]["PRA_ADRESSE"]; ?></td>
						</tr><tr>
							<td>Code postal</td>
							<td><?php echo Vue::$donnees["lePraticien"]["PRA_CP"]; ?></td>
						</tr><tr>
							<td>Ville</td>
							<td><?php echo Vue::$donnees["lePraticien"]["PRA_VILLE"]; ?></td>
						</tr><tr>
							<td>Coefficient de notoriété</td>
							<td><?php echo Vue::$donnees["lePraticien"]["PRA_COEFNOTORIETE"]; ?></td>
						</tr><tr>
							<td>Type</td>
							<td><?php echo Vue::$donnees["lePraticien"]["TYP_LIBELLE"]; ?></td>
						</tr><tr>
							<td>Lieu</td>
							<td><?php echo Vue::$donnees["lePraticien"]["TYP_LIEU"]; ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
<!-- fin de la vue : médicament/details -->