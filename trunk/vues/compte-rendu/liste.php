<!-- vue : compte-rendu/liste -->
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-list-alt fa-fw"></i> Liste de mes comptes rendus</h3></div>
			<div class="panel-body">
				<?php if($lesComptesRendusDuVisiteurSontVide) { ?>
					<h3 class="text-center">Aucun compte-rendu</h3>
				<?php } else { ?>
					<?php OutilsForm::info("Cliquer sur un compte rendu pour avoir plus de détail"); ?>
					<div class="dataTable_wrapper">
						<table class="table table-hover" id="DataTableCompteRendu">
							<thead>
								<tr>
									<th>#</th>
									<th>Praticien</th>
									<th>Date</th>
									<th>Date de visite</th>
									<th>Bilan</th>
									<th>Motif</th>
								</tr>
							</thead>
							<tbody> 
							<?php foreach( $lesComptesRendusDuVisiteur as $unCompteRendu ) { ?>
								<tr class="link" onclick="location.href='<?php echo OutilsUrl::composer("compte-rendu","details","matricule=".$unCompteRendu["VIS_MATRICULE"]."&num=".$unCompteRendu["RAP_NUM"]);?>'">
									<td><?php echo $unCompteRendu["RAP_NUM"]; ?></td>
									<td><?php OutilsUrl::composerLien($unCompteRendu["PRA_NOM"]." ".$unCompteRendu["PRA_PRENOM"]." <span class='text-nowrap'>(N°".$unCompteRendu["PRA_NUM"].")</span>","praticien","details","num=".$unCompteRendu["PRA_NUM"]);?></td>
									<td><?php echo $unCompteRendu["RAP_DATETIME"]; ?></td>
									<td><?php echo $unCompteRendu["RAP_DATEVISITE"]; ?></td>
									<td><?php echo $unCompteRendu["RAP_BILAN"]; ?></td>
									<td><?php echo $unCompteRendu["RAP_MOTIF"]; ?></td>	
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
<!-- fin de la vue : compte-rendu/liste -->