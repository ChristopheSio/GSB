<div id="contenu">
	<h2>Liste des mÃ©dicaments</h2>
	<table width="100%">
		<thead>
			<tr> 
                <th>DÃ©pot legal</th>  
                <th>Nom</th> 
			</tr>
		</thead>
		<tbody>
			<?php foreach ($lesMedicaments as $unMedicament) { ?>		
				<tr class="lovelyrow" onclick="location.href='index.php?choix=<?php echo $unMedicament["MED_DEPOTLEGAL"];?>&uc=medicament&action=consulter'">
					<td><?php echo $unMedicament["MED_DEPOTLEGAL"]; ?></td>
					<td><?php echo $unMedicament["MED_NOMCOMMERCIAL"]; ?></td>
				</tr>
			<?php } ?>	  
		</tbody>
    </table> 
</div>