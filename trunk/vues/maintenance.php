<?php
header('HTTP/1.1 503 Service Unavailable');
header('Retry-After: 3600');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Site Maintenance</title>
	<meta name="robots" content="NOODP,noindex, nofollow, all" />
	<meta name="googlebot" content="NOODP,noindex, nofollow, all" />
	<meta name="googlebot-image" content="noindex, nofollow, all" />
	<meta http-equiv="refresh" content="3">
	<style>
	  body { text-align: center; padding: 150px; }
	  h1 { font-size: 50px; }
	  body { font: 20px Helvetica, sans-serif; color: #333; }
	  article { display: block; text-align: left; width: 650px; margin: 0 auto; }
	  a { color: #dc8100; text-decoration: none; }
	  a:hover { color: #333; text-decoration: none; }
	</style>
</head>
<body>
    <article>
		<h1>We&rsquo;ll be back soon!</h1>
		<div>
			<p>Sorry for the inconvenience but we&rsquo;re performing some maintenance at the moment. If you need to you can always <a href="mailto:contact@<?php echo $_SERVER["SERVER_NAME"]; ?>">contact us</a>, otherwise we&rsquo;ll be back online shortly!</p>
			<?php if(isset($info)) { echo "<p>".$info."</p>"; } ?>
            <p><a href="http://<?php echo $_SERVER["SERVER_NAME"]; ?>"><?php echo $_SERVER["SERVER_NAME"]; ?></a> &mdash; The Team</p>
		</div>
	</article>
</body>
</html>