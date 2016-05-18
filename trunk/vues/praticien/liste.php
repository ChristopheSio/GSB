<!-- vue : practicien/liste -->
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-list-alt fa-fw"></i> Liste des praticiens</h3></div>
			<div class="panel-body">
				<?php if($lesPraticiensSontVide) { ?>
					<h3 class="text-center">Aucun praticien</h3>
				<?php } else { ?>
					<?php OutilsForm::info("Cliquer sur un praticien pour avoir plus de détail"); ?>
					<div class="dataTable_wrapper">
						<table class="table table-hover" id="DataTablePraticien">
							<thead>
								<tr>
									<th>#</th>
									<th>Nom</th>  
									<th>Prénom</th> 
									<th>Adresse</th>
									<th>Code postal</th>
									<th>Ville</th>
								</tr>
							</thead>
							<tbody> 
							<?php foreach( $lesPraticiens as $unPraticien ) { ?>
								<tr class="link" <?php echo $unPraticien["PRA_NUM"]=="42"?'id="selected-row"':""; ?> onclick="location.href='<?php echo OutilsUrl::composer("praticien","details","num=".$unPraticien["PRA_NUM"]);?>'">
									<td><?php echo $unPraticien["PRA_NUM"]; ?></td>
									<td><?php echo $unPraticien["PRA_NOM"]; ?></td>
									<td><?php echo $unPraticien["PRA_PRENOM"]; ?></td>
									<td><?php echo $unPraticien["PRA_ADRESSE"]; ?></td>
									<td><?php echo $unPraticien['PRA_CP']; ?></td>
									<td><?php echo $unPraticien['PRA_VILLE']; ?></td>	
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
<!-- fin de la vue : practicien/liste -->