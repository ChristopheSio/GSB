<!-- vue : médicament/details -->
<div class="row">
	<div class="col-lg-4 col-md-5">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-search fa-fw"></i> Choix médicament</h3></div>
			<div class="panel-body">
				<?php if(Vue::$donnees["lesMedicamentsSontVide"]) { ?>
					<h3 class="text-center">Aucun médicament</h3>
				<?php } else { ?>
					<form action="<?php echo OutilsUrl::composer("medicament","details"); ?>" method="GET" class="form-inline"> 	
						<?php OutilsUrl::formComposerInput("medicament","details"); ?>
						<div class="form-group">
							<select class="form-control" name="depot" id="depot" onchange="this.form.submit()">
							<?php foreach( Vue::$donnees["lesMedicaments"] as $unMedicament ) { ?>
								<option <?php OutilsForm::selectedCompose( Vue::$donnees["leMedicamentDepot"],$unMedicament["MED_DEPOTLEGAL"]);?>><?php echo $unMedicament["MED_NOMCOMMERCIAL"]; ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="btn-group" role="group" aria-label="Navigation">
							<?php if(Vue::$donnees["leMedicament"]) { 
								if(Vue::$donnees["leMedicamentPrecedant"]) { ?>
									<a type="button" class="btn btn-default" <?php OutilsUrl::composerHref("medicament","details","depot=".Vue::$donnees["leMedicamentPrecedant"]["MED_DEPOTLEGAL"]);?>><i title="Precédant" class="fa fa-chevron-circle-left fa-fw text-info"></i></a>
								<?php } else { ?>
									<a type="button" disabled="disabled" class="btn btn-default"><i title="Precédant" class="fa fa-chevron-circle-left fa-fw text-info"></i></a>
								<?php } if(Vue::$donnees["leMedicamentSuivant"]) { ?>
									<a type="button" class="btn btn-default" <?php OutilsUrl::composerHref("medicament","details","depot=".Vue::$donnees["leMedicamentSuivant"]["MED_DEPOTLEGAL"]);?>><i title="Suivant" class="fa fa-chevron-circle-right fa-fw text-info"></i></a>
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
	<?php if(Vue::$donnees["leMedicament"]) { ?>
		<div class="col-lg-8 col-md-7">
			<div class="panel panel-default">
				<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-medkit fa-fw"></i> Details medicament <?php echo Vue::$donnees["leMedicament"]["MED_NOMCOMMERCIAL"]." (".Vue::$donnees["leMedicament"]["MED_DEPOTLEGAL"].")"; ?></h3></div>
				<div class="panel-body">
					<table class="table">
						<tr>
							<td>Dépot légal</td>
							<td><?php echo Vue::$donnees["leMedicament"]["MED_DEPOTLEGAL"]; ?></td>
						</tr><tr>
							<td>Nom commercial</td>
							<td><?php echo Vue::$donnees["leMedicament"]["MED_NOMCOMMERCIAL"]; ?></td>
						</tr><tr>
							<td>Code</td>
							<td><?php echo Vue::$donnees["leMedicament"]["FAM_CODE"]; ?></td>
						</tr><tr>
							<td>Composition</td>
							<td><?php echo Vue::$donnees["leMedicament"]["MED_COMPOSITION"]; ?></td>
						</tr><tr>
							<td>Effets</td>
							<td><?php echo Vue::$donnees["leMedicament"]["MED_EFFETS"]; ?></td>
						</tr><tr>
							<td>Contre-indication</td>
							<td><?php echo Vue::$donnees["leMedicament"]["MED_CONTREINDIC"]; ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
<!-- fin de la vue : médicament/details -->