<?php
function varDumpInfo($varName,$var) {
	echo '<div class="row"><h2>'.$varName.'</h2>';
	var_dump($var);
	echo '</div>';
}
?><!-- vue : debug -->
<?php 

varDumpInfo('$_SERVER',$_SERVER);
varDumpInfo('$_SESSION',$_SESSION);
varDumpInfo('Constantes magiques',array(
	"__LINE__"=>__LINE__, 
	"__FILE__"=>__FILE__, 
	"__DIR__"=>__DIR__, 
	"__FUNCTION__"=>__FUNCTION__, 
	"__CLASS__"=>__CLASS__, 
	"__TRAIT__"=>__TRAIT__, 
	"__METHOD__"=>__METHOD__, 
));
varDumpInfo('apache_get_modules',apache_get_modules());

foreach( array( 
	"OutilsUrl",
	"Vue",
	"GsbUtilisateur"
) as $name ) { 
	varDumpInfo($name,(new ReflectionClass($name))->getStaticProperties());
}
?>

<h2>phpinfo</h2>
<?php phpinfo(); ?>
<!-- fin de la vue : debug -->