<!-- vue : visiteur/liste -->
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-list-alt fa-fw"></i> Liste des visiteurs</h3></div>
			<div class="panel-body">
				<?php if(Vue::$donnees["lesVisiteursSontVide"]) { ?>
					<h3 class="text-center">Aucun visiteur</h3>
				<?php } else { ?>
					<div class="dataTable_wrapper">
						<table class="table table-hover" id="DataTableVisiteur">
							<thead>
								<tr>
									<th>Matricule</th>  
									<th>Nom</th>  
									<th>Prénom</th> 
									<th>Adresse</th>
									<th>Code postal</th>
									<th>Ville</th>
								</tr>
							</thead>
							<tbody> 
							<?php foreach( Vue::$donnees["lesVisiteurs"] as $unVisiteur ) { ?>
								<tr>
									<td><?php echo $unVisiteur["VIS_MATRICULE"]; ?></td>
									<td><?php echo $unVisiteur["VIS_NOM"]; ?></td>
									<td><?php echo $unVisiteur["VIS_PRENOM"]; ?></td>
									<td><?php echo $unVisiteur["VIS_ADRESSE"]; ?></td>
									<td><?php echo $unVisiteur["VIS_CP"]; ?></td>
									<td><?php echo $unVisiteur["VIS_VILLE"]; ?></td>
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
<!-- fin de la vue : visiteur/liste -->