<!-- vue : responsecode -->
<div class="row">
	<div class="page-header col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
		<div class="panel panel-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-exclamation-triangle fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">Erreur <?php echo $code; ?></div>
						<div><?php echo $message_en; ?></div>
					</div>
				</div>
			</div>
			<div class="panel-body text-center"> 
				<pre><?php echo $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?></pre>
				<h2><?php echo $message; ?></h2>
			</div>
			<ul class="list-group">
				<a <?php 
				OutilsUrl::composerHref(
					"page",
					"contact",
					"responsecode=".$code."&ressource=".urlencode(base64_encode($_SERVER["REQUEST_URI"]))
				); 
				?>><li class="list-group-item list-group-item-danger">
					<span class="pull-left"><i class="fa fa-support fa-fw"></i> Contacter l'équipe</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</li></a>
				<a <?php OutilsUrl::composerHref("page","accueil"); ?>><li class="list-group-item list-group-item-success">
					<span class="pull-left"><i class="fa fa-home fa-fw"></i> Retour à l'accueil</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</li></a>
			</ul>
		</div>
	</div>
</div>
<!-- fin de la vue : responsecode -->