<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<base href="<?php echo GsbConfig::$SiteUrl; ?>/">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if(!is_null(Vue::$description)) { ?>
		<meta name="description" content="<?php echo Vue::$description; ?>">
	<?php } ?>
	<meta name="author" content="SIO SLAM 2016 - Marie Curie Marseille - Cheri Bibi released by Kim Paviot, Julien Dignat and Christophe Sonntag">
	<title><?php echo Vue::$title; ?> - GSB</title>
	<!---->
	<link rel="icon" type="image/x-icon" href="<?php echo GsbConfig::$SiteUrl; ?>/favicon.ico" />
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- MetisMenu CSS -->
	<link href="css/metisMenu.min.css" rel="stylesheet">
	<!-- Timeline CSS -->
	<link href="css/timeline.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="css/sb-admin-2.css" rel="stylesheet">
	<!-- Morris Charts CSS -->
	<link href="css/morris.css" rel="stylesheet">
	 <!-- Custom Fonts -->
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<?php if(!is_null(Vue::$ListStyle)) { ?>
		<!-- Page Script -->
		<?php foreach(Vue::$ListStyle as $StyleUrl) { ?>
			<script src="<?php echo $StyleUrl; ?>"></script>
	<?php }} ?>
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Metis Menu Plugin JavaScript -->
	<script src="js/metisMenu.min.js"></script>
	<!-- Morris Charts JavaScript -->
	<script src="js/raphael-min.js"></script>
	<script src="js/morris.min.js"></script>
	<!-- data for moris : <script src="/js/morris-data.js"></script> -->
	<!-- Custom Theme JavaScript -->
	<script src="js/sb-admin-2.js"></script>
	<?php if(!is_null(Vue::$ListScript)) { ?>
		<!-- Page Script -->
		<?php foreach(Vue::$ListScript as $ScriptUrl) { ?>
			<script src="<?php echo $ScriptUrl; ?>"></script>
	<?php }} ?>	
	<?php echo Vue::$HeaderSupplement; ?>	
</head>
<body>
	<div id="wrapper">
		
	<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo GsbConfig::$SiteUrl; ?>"> <span><img alt="<?php echo GsbConfig::$SiteName; ?>" height="100%" src="images/logo-capsules.png"/></span> <?php echo GsbConfig::$SiteName; ?> </a>
            </div>
            <!-- /.navbar-header -->
		<?php include("vues/gabarit/menu.php"); ?>
		<?php include("vues/gabarit/navigation.php"); ?>
        </nav>	
<div id="page-wrapper">