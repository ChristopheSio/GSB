<!-- vue : statistique/famille-médicament -->
<pre>
    <?php
//print_r(Vue::$donnees["familleMedicament"]);
?>
</pre>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-list-alt fa-fw"></i> Pourcentage des médicaments par famille</h3></div>
			<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-hover" id="DataTableStatistique">
							<thead>
								<tr>
									<th>Code de la famille</th>  
									<th>Nom de la famille</th>  
									<th>Total</th> 
									<th>Pourcentage</th>
								</tr>
							</thead>
							<tbody> 
							<?php foreach( Vue::$donnees["lesVisiteurs"] as $unVisiteur ) { ?>
								<tr>
									<td><?php echo $unVisiteur["FAM_CODE"]; ?></td>
									<td><?php echo $unVisiteur["FAM_LIBELLE"]; ?></td>
									<td><?php echo $unVisiteur["nb"]; ?></td>
									<td><?php echo $unVisiteur["pourcentage"]; ?></td>
							<?php } ?>
							</tbody>
						</table>
					</div>
			</div>
		</div>
	</div>
</div>

<!-- fin de la vue : statistique/famille-médicament -->
