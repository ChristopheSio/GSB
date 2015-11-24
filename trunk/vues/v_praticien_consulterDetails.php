﻿<div id="contenu">
	<form action="index.php" method="GET"> 	
		<h2>Choix praticien : 
			<select name="choix">
			<?php foreach( $lesPraticiens as $unPraticien ) { ?>
				<option <?php echo (!is_null($choixPraticien)?(
                                        ($choixPraticien["PRA_NOM"]==$unPraticien["PRA_NOM"])?"selected":""):""); ?> 
                                    value="<?php echo $unPraticien["PRA_NOM"]; ?>"><?php echo $unPraticien["PRA_NOM"]; ?></option>
			<?php } ?>
			</select>
			<input type="hidden" name="uc" value="praticien">
			<input type="hidden" name="action" value="Liste">
			<input type="submit" value="Aller" >
		</h2>
	</form>
	
	<?php if(!is_null($choixPraticien)) { ?>
		<form action="" method="POST"> 	
			<h2>
				Consulter le praticien : <?php echo $choixPraticien["PRA_NOM"]; ?>  
			</h2>
		</form>
		<table class="table">
			<tr>
				<td>Nom</td><td><?php echo $choixPraticien["PRA_NOM"]; ?></td>
			</tr><tr>
				<td>Prénom</td><td><?php echo $choixPraticien["PRA_PRENOM"]; ?></td>
			</tr><tr>
				<td>Adresse</td><td><?php echo $choixPraticien["PRA_ADRESSE"]; ?></td>
			</tr><tr>
				<td>Code postal</td><td><?php echo $choixPraticien["PRA_CP"]; ?></td>
			</tr><tr>
				<td>Ville</td><td><?php echo $choixPraticien["PRA_VILLE"]; ?></td>
			</tr>
		</table>
	<?php } ?>
</div>