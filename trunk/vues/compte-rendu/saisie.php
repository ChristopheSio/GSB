<!-- vue : compte-rendu/saisie -->
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<?php if ($okCompteRendu && $rapportKeys["OK"]) { ?>
				<div class="panel-heading text-center">
					<h2>Votre compte rendu a bien été enregistré</h2>
					<h3>Matricule <?php echo $rapportKeys["MATRICULE"]; ?>, N°<?php echo $rapportKeys["RAP_NUM"]; ?></h3>
				</div>
			<?php } else if ($okCompteRendu && !$rapportKeys["OK"]) { ?>
				<div class="panel-heading text-center">
					<h2>Votre compte rendu n'a pas pu être enregistré</h2>
					<?php OutilsForm::erreur("La fonction d'insertion d'un compte rendu","Code mysql :".$rapportKeys["CODE"]); ?>
				</div>
			<?php } else { ?>
				<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-pencil-square-o fa-fw"></i> Saisie du compte rendu</h3></div>
				<div class="panel-body">
					<form action="" method="post" role="form" class="form-horizontal">
						<div class="form-group">
							<div class="col-sm-6">
								<label for="numero">Numero (automatique)</label>
								<div class="row">
									<div class="col-sm-4">
										<input disabled="disabled" type="text" class="form-control" name="numero" id="numero" placeholder="Numero" <?php OutilsForm::value($numero); ?>>
									</div>
									<div class="col-sm-8">
										<span><i class="fa fa-info-circle fa-fw"></i> (pas encore attribué en base de donnée)</span>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<label for="dateVisite">Date de visite</label>
								<input type="date" class="form-control" name="dateVisite" id="dateVisite" placeholder="Date de visite" <?php OutilsForm::value($dateVisite); ?>>
								<?php OutilsForm::validProbleme($valid["dateVisite"], "La date de visite"); ?>
							</div>
						</div>
						<div class="form-group vertical-align">
							<div class="col-sm-6">
								<label for="choixPraticien">Praticien visité</label>
								<select class="form-control" name="choixPraticien" id="choixPraticien">
									<option value="">--</option> 
									<?php foreach ($lesPraticiens as $unPraticien) { 
										?><option <?php OutilsForm::selectedCompose($choixPraticien, $unPraticien['PRA_NUM']); ?>><?php echo $unPraticien['PRA_NOM'] . " " . $unPraticien['PRA_PRENOM']. " (".$unPraticien['PRA_NUM'].")"; ?></option><?php 
									} ?>
								</select>
								<?php OutilsForm::validProbleme($valid["choixPraticien"], "Le praticien"); ?>
							</div>
							<div class="col-sm-6">
								<label for="remplacant"><input type="checkbox" name="remplacant" id="remplacant" <?php OutilsForm::checked($remplacant); ?>> Remplaçant</label>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6">
								<label for="choixMotif">Motif de la visite</label>
								<select class="form-control" name="choixMotif" id="choixMotif" onchange='changerInputActifParSelectChoix(this, "motifAutre", "autre-saisie");'>
									<option value="-1">--</option> 
									<?php foreach ($lesMotifs as $unMotifId => $unMotifInfo) { 
										?><option <?php OutilsForm::selectedCompose($choixMotif, $unMotifId); ?>><?php echo $unMotifInfo; ?></option><?php 
									} ?>
									<option <?php OutilsForm::selectedCompose($choixMotif, "autre-saisie"); ?>>Autre, preciser</option> 
								</select>
								<?php OutilsForm::validProbleme($valid["choixMotif"], "La motif choisi"); ?>
							</div>
							<div class="col-sm-6">
								<label for="motifAutre">Autre motif</label>
								<input <?php OutilsForm::disabled(!$motifAutreActive); ?> type="text" class="form-control" name="motifAutre" id="motifAutre" placeholder="Motif..." <?php OutilsForm::value($motifAutre); ?>>
								<?php OutilsForm::validProblemePourNombreDeCaractere($valid["motifAutre"], "Le motif", strlen($motifAutre), 2, 128); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<label for="bilan">Bilan</label>
								<textarea rows="8" class="form-control" name="bilan" id="bilan" maxlength="512" placeholder="Bilan"><?php echo $bilan; ?></textarea>
								<?php OutilsForm::validProblemePourNombreDeCaractere($valid["bilan"], "Le bilan", strlen($bilan), 2, 512); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-6">
								<label for="documentation"><input type="checkbox" name="documentation" id="documentation" <?php OutilsForm::checked($documentation); ?>> Documentation fournit</label>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<?php OutilsMultidataForm::implanter($echantillonsMultidataForm,'<i class="fa fa-list fa-fw"></i> Echantillons</h4>',array("Medicament","Quantité offerte")); ?>
								<?php 
								/*
								<div class="panel panel-default">
									<div class="panel-heading"><h4 class="panel-title"></div>
									<div class="panel-body">
										<?php
										OutilsForm::implanterAjaxMultipleDonnees($echantillonsDonnees);
										?>
									</div>
									<div class="panel-footer"><a id="MD-echantillonsDonnees-append" class="btn btn-default" onclick="AjaxMultipleDonneesAjouter(&quot;echantillonsDonnees&quot;,&quot;http://ppe.localhost/GSB/trunk/compte-rendu/ajax-saisie-echantillons&quot;,25, null);"><i class="fa fa-plus-circle fa-fw"></i> Ajouter</a></div>
								</div>
								 */ ?>
							</div>
						</div>

						<?php OutilsForm::implanterFormulaireId("compte-rendu-saisie"); ?> 
						<div class="col-md-6 col-md-offset-3">
							<div class="form-group"><input class="btn btn-success form-control btn-success" type="submit" value="Envoyer le compte-rendu"></div>
							<div class="form-group"><input class="btn btn-default form-control" type="reset" value="Réinitialiser le formulaire"></div>
						</div>		
					</form>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<!-- vue : compte-rendu/saisie -->

<?php /*










  <div  id="contenu">
  <?php if (count($errors)>0) { ?>
  <ul>
  <?php foreach ($errors as $error) { ?>
  <li><?php echo $error; ?></li>
  <?php } ?>
  </ul>
  <?php } ?>

  <h2>Saisie du compte rendu</h2>

  <form action="index.php?uc=compte-rendu&action=valider" method="POST">

  <table class="table-no-border" border="0" width="100%">
  <tr>
  <td width="25%">NUMERO :</td>
  <td width="75%"><input type="number" name="numero" value="<?php echo ((empty($_POST['numero']))?"":$_POST['numero']); ?>" ></td></tr>

  <tr>
  <td>DATE VISITE : </td>
  <td><input type="text" name="datevisite" value="<?php echo ((empty($_POST['datevisite']))?"":$_POST['datevisite']); ?>" ></td>
  </tr>

  <tr><td>PRATICIEN :</td>
  <td><select name="choixPraticiens" >
  <option value="">--</option>
  <?php foreach ($lesPraticiens as $value) { ?>
  <option <?php echo ((empty($_POST['choixPraticiens']))?"":(($_POST['choixPraticiens']==$value['PRA_NUM'])?"selected":'')); ?> value="<?php echo $value['PRA_NUM']; ?>"><?php echo $value['PRA_NOM'] . " " . $value['PRA_PRENOM']; ?></option>
  <?php } ?>
  </select></td>

  <tr><td>COEFFICIENT :</td><td><input value="<?php echo ((empty($_POST['numero']))?"":$_POST['numero']); ?>" type="text" name="coefficient" ></td></tr>

  <tr>
  <td>REMPLACANT </td>
  <td><input type="checkbox" name="remplacant" value="" value="<?php echo ((empty($_POST['remplacant']))?"":$_POST['remplacant']); ?>">

  </td>
  </tr>

  <tr><td>DATE :</td><td><input type="text" name="date" value="<?php echo ((empty($_POST['date']))?"":$_POST['date']); ?>"></td></tr>

  <tr><td>MOTIF :</td><td><input type="text" name="modif" value="<?php echo ((empty($_POST['modif']))?"":$_POST['modif']); ?>"></td></tr>

  <tr><td>BILAN :</td><td><input type="text" name="bilan" value="<?php echo ((empty($_POST['bilan']))?"":$_POST['bilan']); ?>"></td></tr>

  </table>
  <br>
  <br>

  <h2>Eléments présentés</h2>

  <table>
  <tr>
  <td>
  PRODUIT 1 :
  </td>
  <td><select name="choixProduit1" >
  <option value="">--</option>
  <?php foreach ($lesMedicaments as $value) { ?>
  <option <?php echo ((empty($_POST['choixProduit1']))?"":(($_POST['choixProduit1']==$value['MED_DEPOTLEGAL'])?"selected":'')); ?> value="<?php echo $value['MED_DEPOTLEGAL']; ?>"><?php echo $value['MED_NOMCOMMERCIAL']; ?></option>
  <?php } ?>
  </select></td>
  </tr>
  <tr>
  <td>
  PRODUIT 2 :
  </td>
  <td><select name="choixProduit2" >
  <option value="">--</option>
  <?php foreach ($lesMedicaments as $value) { ?>
  <option <?php echo ((empty($_POST['choixProduit2']))?"":(($_POST['choixProduit2']==$value['MED_DEPOTLEGAL'])?"selected":'')); ?> value="<?php echo $value['MED_DEPOTLEGAL']; ?>"><?php echo $value['MED_NOMCOMMERCIAL']; ?></option>
  <?php } ?>
  </select></td>
  </tr>
  <tr>
  <td>
  DOCUMENTATION OFFERTE :
  </td>
  <td>
  <input type="checkbox" name="documentation" value="" value="<?php echo ((empty($_POST['documentation']))?"":$_POST['documentation']); ?>">
  </td>
  </tr>
  </table>
  <br>
  <br>

  <h2>Echantillons</h2>
  <input type="checkbox"  name="avecEchantillon"> <!-- onchange="changerVisibilite('masque_Echantillion',this.checked)" -->

  <div id="masque_Echantillion" >  <!--style="visibility: hidden;"-->
  <td><select name="choixEchantillon" >
  <option value="">--</option>
  <?php foreach ($lesMedicaments as $value) { ?>
  <option <?php echo ((empty($_POST['choixEchantillon']))?"":(($_POST['choixEchantillon']==$value['MED_DEPOTLEGAL'])?"selected":'')); ?> value="<?php echo $value['MED_DEPOTLEGAL']; ?>"><?php echo $value['MED_NOMCOMMERCIAL']; ?></option>
  <?php } ?>
  </select>
  <input type="number" name="nbEchantillons" min="0" max="100" value="0" value="<?php echo ((empty($_POST['nbEchantillons']))?"":$_POST['nbEchantillons']); ?>">
  <br>
  </div>

  <br>
  <br>
  <input type="submit" value="Envoyer" >
  </form>
  </div>
 */
?>
 