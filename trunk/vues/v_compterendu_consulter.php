<div id="contenu">
	<h2>Consulter mes comptes rendus (matricule <?php echo $_SESSION['id']; ?>)</h2>
	<?php if(!is_array($lesComptesRendusDuVisiteur)) { ?>
		<h3>Aucun compte rendu pour ce matricule</h3>
	<?php } else { ?>
		<table class="table">
			<thead>
				<tr>
					<th>Rapport</th>
					<th>Num practicien</th>
					<th>Date</th>
					<th>Bilan</th>
					<th>Motif</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach( $lesComptesRendusDuVisiteur as $unCompteRendu ) { ?>
				<tr>
					<td><?php echo $unCompteRendu["RAP_NUM"]; ?></td>
					<td><?php echo $unCompteRendu["PRA_NUM"]; ?></td>
					<td><?php echo $unCompteRendu["RAP_DATE"]; ?></td>
					<td><?php echo $unCompteRendu["RAP_BILAN"]; ?></td>
					<td><?php echo $unCompteRendu["RAP_MOTIF"]; ?></td>	
				</tr>
			<?php } ?>
			</tbody>
		</table>
	<?php } ?>