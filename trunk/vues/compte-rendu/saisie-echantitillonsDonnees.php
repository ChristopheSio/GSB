<!-- vue : compte-rendu/saisie-echantitillonsDonnees -->
<label for="choixMedicament">Medicament</label>
<select class="form-control" name="choixMedicament" id="choixMedicament">
	<option value="">--</option> 
	<?php foreach ($lesMedicaments as $unMedicament) { ?>
		<option <?php OutilsForm::selectedCompose($choixMedicament, $unMedicament['MED_DEPOTLEGAL']); ?>><?php echo $unMedicament['MED_NOMCOMMERCIAL'] . " (" . $unMedicament['MED_DEPOTLEGAL'] . ")"; ?></option>
	<?php } ?>
</select>
<?php OutilsForm::validProbleme($valid["choixMedicament"], "Le medicament visité"); ?>
<label for="qteOfferte">Quantité offerte</label>
<input type="number" class="form-control" name="qteOfferte" id="qteOfferte" placeholder="Quantité offerte" <?php OutilsForm::value($qteOfferte); ?>>
<?php OutilsForm::validProbleme($valid["qteOfferte"], "La quantité offerte"); ?>
<!-- vue : compte-rendu/saisie -->