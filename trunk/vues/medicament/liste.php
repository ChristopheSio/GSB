<!-- vue : medicament/liste -->
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-list-alt fa-fw"></i> Liste des praticiens</h3></div>
			<div class="panel-body">
				<?php if(Vue::$donnees["lesMedicamentsSontVide"]) { ?>
					<h3 class="text-center">Aucun Medicaments</h3>
				<?php } else { ?>
					<?php OutilsForm::info("Cliquer sur un médicament pour avoir plus de détail"); ?>
					<div class="dataTable_wrapper">
						<table class="table table-hover" id="DataTableMedicaments">
							<thead>
								<tr>
									<th>Dépot legal</th>  
									<th>Nom</th> 
								</tr>
							</thead>
							<tbody> 
							<?php foreach( Vue::$donnees["lesMedicaments"] as $unMedicament ) { ?>
								<tr class="link" onclick="location.href='<?php echo OutilsUrl::composer("medicament","details","depot=".$unMedicament["MED_DEPOTLEGAL"]);?>'">
									<td><?php echo $unMedicament["MED_DEPOTLEGAL"]; ?></td>
									<td><?php echo $unMedicament["MED_NOMCOMMERCIAL"]; ?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<!-- fin de la vue : medicament/liste -->