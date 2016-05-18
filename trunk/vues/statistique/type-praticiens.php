<!-- vue : statistique/type-praticiens -->
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-list-alt fa-fw"></i> Pourcentage des praticiens par type</h3></div>
			<div class="panel-body">
                            <!-- On affiche le total des médicaments en allant chercher cette donnée dans $ui t dans le contrôleur statistique.php -->
                            <?php OutilsForm::success("Total des praticiens : ".$lesPraticiens["total"]); ?>
					<div class="dataTable_wrapper">
						<table class="table table-hover" id="DataTableStatistique">
							<thead>
								<tr>
									<th>Nom du type</th>  
									<th>Total</th> 
									<th>Pourcentage</th>
								</tr>
							</thead>
							<tbody> 
							<?php foreach( $lesPraticiens["stat"] as $unType ) { ?>
								<tr>
									<td><?php echo $unType["TYP_LIBELLE"]." (".$unType["TYP_CODE"].")"; ?></td>
									<td><?php echo $unType["nb"]; ?></td>
									<td><?php echo $unType["pourcentage"]; ?></td>
							<?php } ?>
							</tbody>
						</table>
					</div>
				<?php /*}*/ ?>
			</div>
		</div>
	</div>
</div>

<!-- fin de la vue : statistique/type-praticiens -->