<div id="contenu">
	<form action="index.php" method="GET"> 	
		<h2>Choix medicament : 
			<select name="choix" onchange="this.form.submit()">
			<?php foreach( $lesMedicaments as $unMedicament ) { ?>
				<option <?php echo (!is_null($choixMedicament)?(($choixMedicament["MED_DEPOTLEGAL"]==$unMedicament["MED_DEPOTLEGAL"])?"selected":""):""); ?> value="<?php echo $unMedicament["MED_DEPOTLEGAL"]; ?>"><?php echo $unMedicament["MED_NOMCOMMERCIAL"]; ?></option>
			<?php } ?>
			</select>
			<input type="hidden" name="uc" value="medicament">
			<input type="hidden" name="action" value="consulter">
			<input type="submit" value="Aller" >
		</h2>
	</form>
	
	<?php if(!is_null($choixMedicament)) { ?>
		<form action="" method="POST"> 	
			<h2><?php if(!is_null($choixMedicamentBefore)) { ?><a class="button" href="index.php?uc=medicament&action=consulter&choix=<?php echo $choixMedicamentBefore["MED_DEPOTLEGAL"]; ?>">&LeftArrow;</a><?php } ?>
				<?php if(!is_null($choixMedicamentAfter)) { ?><a class="button" href="index.php?uc=medicament&action=consulter&choix=<?php echo $choixMedicamentAfter["MED_DEPOTLEGAL"]; ?>">&RightArrow;</a><?php } ?>
				Consulter le médicament : <?php echo $choixMedicament["MED_NOMCOMMERCIAL"]; ?>  
			</h2>
		</form>
		<table class="table">
			<tr>
				<td>Dépot légal</td><td><?php echo $choixMedicament["MED_DEPOTLEGAL"]; ?></td>
			</tr><tr>
				<td>Nom commercial</td><td><?php echo $choixMedicament["MED_NOMCOMMERCIAL"]; ?></td>
			</tr><tr>
				<td>Code</td><td><?php echo $choixMedicament["FAM_CODE"]; ?></td>
			</tr><tr>
				<td>Composition</td><td><?php echo $choixMedicament["MED_COMPOSITION"]; ?></td>
			</tr><tr>
				<td>Effets</td><td><?php echo $choixMedicament["MED_EFFETS"]; ?></td>
			</tr><tr>
				<td>Contre-indication</td><td><?php echo $choixMedicament["MED_CONTREINDIC"]; ?></td>
			</tr>
		</table>
	<?php } ?>
</div>