<!-- vue : utilitaire/outil.multidata.form -->
<div class="panel panel-default">
    <div class="panel-heading"><h4 class="panel-title"><?php echo $multidataFormTitle; ?></div>
    <div id="<?php echo "multidata_".$multidataId."_body"; ?>" class="panel-body">
		<table class="table table-striped"> 
			<thead><tr><?php foreach($multidataTableColumns as $colimnsTitle) { echo "<th>".$colimnsTitle."</th>"; } ?><th>Actions</th></tr></thead>
			<tbody id="<?php echo "multidata_".$multidataId."_table"; ?>"></tbody> 
		</table>
		<?php if(count($data["errors"])!=0) { foreach( $data["errors"] as $oneError ) { OutilsForm::danger($oneError); }} ?>
	</div>
    <div class="panel-footer">
		<div class="pull-right">
			<a id="<?php echo "multidata_".$multidataId."_append"; ?>" class="btn btn-default" onclick='multidataAdd("<?php echo $multidataId; ?>");'><i class="fa fa-plus-circle fa-fw"></i> Ajouter</a>
			<a id="<?php echo "multidata_".$multidataId."_popall"; ?>" class="btn btn-danger" onclick='multidataPopAll("<?php echo $multidataId; ?>");'><i class="fa fa-trash fa-fw"></i> Tout supprimer</a>
		</div>
		<div class="clearfix"></div>
    </div>
</div>
<input type='hidden' id='<?php echo "multidata_".$multidataId."_size"; ?>' name='<?php echo $multidataId."_size"; ?>' value='0'/>
<input type='hidden' id='<?php echo "multidata_".$multidataId."_overlysize"; ?>' name='<?php echo $multidataId."_overlysize"; ?>' value='0'/>
<!-- fin de la vue : utilitaire/outil.multidata.form -->
