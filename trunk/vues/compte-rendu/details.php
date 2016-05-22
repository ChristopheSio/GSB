<!-- vue : compte-rendu/details -->
<?php if(!$leCompteRendu) { ?>
	<div class="panel panel-warning">
		<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-search fa-fw"></i> Details compte-rendu inaccessible</h3></div>
	</div>
<?php } else { ?>
	<div class="panel panel-default">
		<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-search fa-fw"></i> Details compte-rendu matricule <?php echo $leCompteRendu["VIS_MATRICULE"]." N°".$leCompteRendu["RAP_NUM"]; ?></h3></div>
		<div class="panel-body">
			<table class="table">
				<tr>
					<td>Matricule</td>
					<td><?php echo $leCompteRendu["VIS_NOM"]." ".$leCompteRendu["VIS_PRENOM"]." <span class='text-nowrap'>(M°".$leCompteRendu["VIS_MATRICULE"].")</span>";?></td>
				</tr><tr>
					<td>N°</td>
					<td><?php echo $leCompteRendu["RAP_NUM"]; ?></td>
				</tr><tr>
					<td>Praticien visité</td>
					<td><?php OutilsUrl::composerLien($leCompteRendu["PRA_NOM"]." ".$leCompteRendu["PRA_PRENOM"]." <span class='text-nowrap'>(N°".$leCompteRendu["PRA_NUM"].")</span>","praticien","details","num=".$leCompteRendu["PRA_NUM"]);?></td>
				</tr><tr>
					<td>Date de saisie</td>
					<td><?php echo $leCompteRendu["RAP_DATETIME"]; ?></td>
				</tr><tr>
					<td>Date de visite</td>
					<td><?php echo $leCompteRendu["RAP_DATEVISITE"]; ?></td>
				</tr><tr>
					<td>Bilan</td>
					<td><?php echo $leCompteRendu["RAP_BILAN"]; ?></td>
				</tr><tr>
					<td>Motif</td>
					<td><?php echo $leCompteRendu["RAP_MOTIF"]; ?></td>
				</tr><tr>
					<td>Remplaçant</td>
					<td><?php echo $leCompteRendu["RAP_REMPLACANT"]?"Oui":"Non"; ?></td>
				</tr><tr>
					<td>Documentation fournit</td>
					<td><?php echo $leCompteRendu["RAP_DOC_OFFERTE"]?"Oui":"Non"; ?></td>
				</tr><tr>
					<td>Echantillons</td>
					<td><?php echo $leCompteRendu["RAP_ECHANTILLONS"]?"Oui":"Non"; ?></td>
				</tr>
			</table>
		</div>
	</div>
	<?php if($leCompteRenduEchantillonsOffert) { ?>
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-table fa-fw"></i> Echantillons offert</h3></div>
			<div class="panel-body">
				<table class="table">
					<thead><tr><th>Medicament</th><th>Quantité</th></tr></thead>
					<?php foreach($leCompteRenduEchantillonsOffert as $unEchantillon) { ?>
					<tr>
						<td><?php OutilsUrl::composerLien($unEchantillon["MED_NOMCOMMERCIAL"]." <span class='text-nowrap'>(".$unEchantillon["MED_DEPOTLEGAL"].")</span>","medicament","details","depot=".$unEchantillon["MED_DEPOTLEGAL"]);?></td>
						<td><?php echo $unEchantillon["OFF_QTE"]; ?></td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	<?php } ?>
<?php } ?>
<!-- fin de la vue : compte-rendu/details -->