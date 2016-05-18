<!-- vue : statistique/famille-médicament -->
    <?php
//print_r($familleMedicament);
?>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-list-alt fa-fw"></i> Pourcentage des médicaments par famille</h3></div>
			<div class="panel-body">
                            <!-- On affiche le total des médicaments en allant chercher cette donnée dans $ui t dans le contrôleur statistique.php -->
                            <?php OutilsForm::success("Total des médicament : ".$familleMedicament["total"]); ?>
					<div class="dataTable_wrapper">
						<table class="table table-hover" id="DataTableStatistique">
							<thead>
								<tr>
									<th>Nom de la famille</th>  
									<th>Total</th> 
									<th>Pourcentage</th>
								</tr>
							</thead>
							<tbody> 
							<?php foreach( $familleMedicament["stat"] as $uneFamille ) { ?>
								<tr>
									<td><?php echo $uneFamille["FAM_LIBELLE"]." (".$uneFamille["FAM_CODE"].")"; ?></td>
									<td><?php echo $uneFamille["nb"]; ?></td>
									<td><?php echo $uneFamille["pourcentage"]; ?></td>
							<?php } ?>
							</tbody>
						</table>
					</div>
				<?php /*}*/ ?>
			</div>
		</div>
	</div>
</div>

<!-- fin de la vue : statistique/famille-médicament -->
