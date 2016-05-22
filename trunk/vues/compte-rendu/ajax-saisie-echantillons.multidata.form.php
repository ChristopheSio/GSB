<!-- vue : compte-rendu/ajax-saisie-echantillons.multidata.form -->
<td>
	<select class="form-control" name="<?php echo OutilsMultidataForm::genererName($multidataParam, "choixMedicament"); ?>">
		<option value="">--</option> 
		<?php foreach ($lesMedicaments as $unMedicament) { 
			?><option <?php OutilsForm::selectedCompose($choixMedicament, $unMedicament['MED_DEPOTLEGAL']); ?>><?php echo $unMedicament['MED_NOMCOMMERCIAL'] . " (" . $unMedicament['MED_DEPOTLEGAL'] . ")"; ?></option><?php
		} ?>
	</select>
	<?php OutilsForm::validProbleme($valid["choixMedicament"], "Le médicament"); ?>
</td>
<td>
	<input type="number" min="1" max="500" class="form-control" name="<?php echo OutilsMultidataForm::genererName($multidataParam, "qteOfferte"); ?>" placeholder="Quantité offerte" <?php OutilsForm::value($qteOfferte); ?>>
	<?php OutilsForm::validProbleme($valid["qteOfferte"], "La quantité offerte"); ?>
</td>
<td>
	<a class="btn btn-default" onclick='multidataPop(<?php echo '"'.$multidataParam["id"].'","'.$multidataParam["place"].'"'; ?>);'><i class="fa fa-minus-circle fa-fw"></i> Supprimer</a>
</td>
<!-- fin de la vue : compte-rendu/ajax-saisie-echantillons.multidata.form -->