<!-- vue : statistique/visite-labo -->
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-list-alt fa-fw"></i> Pourcentage des visites par labo</h3></div>
			<div class="panel-body">
                            <!-- On affiche le total des médicaments en allant chercher cette donnée dans $ui t dans le contrôleur statistique.php -->
                            <?php OutilsForm::success("Total des visiteurs : ".$lesVisiteurs["total"]); ?>
					<div class="dataTable_wrapper">
						<table class="table table-hover" id="DataTableStatistique">
							<thead>
								<tr>
									<th>Nom du labo</th>  
									<th>Total</th> 
									<th>Pourcentage</th>
								</tr>
							</thead>
							<tbody> 
							<?php foreach( $lesVisiteurs["stat"] as $unVisiteur ) { ?>
								<tr>
									<td><?php echo $unVisiteur["LAB_NOM"]." (".$unVisiteur["LAB_CODE"].")"; ?></td>
									<td><?php echo $unVisiteur["nb"]; ?></td>
									<td><?php echo $unVisiteur["pourcentage"]; ?></td>
							<?php } ?>
							</tbody>
						</table>
					</div>
				<?php /*}*/ ?>
			</div>
		</div>
	</div>
</div>

<!-- fin de la vue : statistique/visite-labo -->