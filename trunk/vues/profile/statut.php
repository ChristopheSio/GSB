<!-- vue : profile/statut -->
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-user fa-fw"></i> Statut</h3></div>
			<div class="panel-body">
				<table class="table">
					<tr>
						<td>Matricule</td>
						<td><?php echo $leVisiteur["VIS_MATRICULE"]; ?></td>
					</tr><tr>
						<td>Nom d'utilisateur</td>
						<td><?php echo $leVisiteur["VIS_LOGIN"]; ?></td>
					</tr><tr>
						<td>Nom</td>
						<td><?php echo $leVisiteur["VIS_NOM"]; ?></td>
					</tr><tr>
						<td>Prenom</td>
						<td><?php echo $leVisiteur["VIS_PRENOM"]; ?></td>
					</tr><tr>
						<td>Email</td>
						<td><?php echo $leVisiteur["VIS_EMAIL"]; ?></td>
					</tr><tr>
						<td>Adresse</td>
						<td><?php echo $leVisiteur["VIS_ADRESSE"]; ?></td>
					</tr><tr>
						<td>Code postal</td>
						<td><?php echo $leVisiteur["VIS_CP"]; ?></td>
					</tr><tr>
						<td>Ville</td>
						<td><?php echo $leVisiteur["VIS_VILLE"]; ?></td>
					</tr><tr>
						<td>Date d'embauche</td>
						<td><?php echo $leVisiteur["VIS_DATEEMBAUCHE"]; ?></td>
					</tr><tr>
						<td>Secteur</td>
						<td><?php echo (isset($leVisiteur["SEC_LIBELLE"])?($leVisiteur["SEC_LIBELLE"]." (".$leVisiteur["SEC_CODE"].")"):"?"); ?></td>
					</tr><tr>
						<td>Laboratoire</td>
						<td><?php echo (isset($leVisiteur["LAB_NOM"])?($leVisiteur["LAB_NOM"]." (".$leVisiteur["LAB_CODE"].")"):"?"); ?></td>
					</tr>
				</table>	
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-user fa-fw"></i> Role</h3></div>
			<div class="panel-body">
				<table class="table">	
					<tr>
						<td>Roles actuel</td>
						<td><?php echo GsbUtilisateur::quelRoleTexte(); ?></td>
					</tr> 
					<?php if(!GsbUtilisateur::estRoleInconnu() && ($leVisiteurRole!=null) ) { ?> 
						<tr> <td>Date d'entrée</td> <td><?php echo $leVisiteurRole["TRAV_DATETIME"]; ?></td></tr> 
						<tr> <td>Region concernée</td> <td><?php echo $leVisiteurRole["REG_NOM"]." (".$leVisiteurRole["REG_CODE"].")"; ?></td></tr> 
						<tr> <td>Secteur concerné</td> <td><?php echo $leVisiteurRole["SEC_LIBELLE"]." (".$leVisiteurRole["SEC_CODE"].")"; ?></td></tr> 
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- fin de la vue : profile/statut -->