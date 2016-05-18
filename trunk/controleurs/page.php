<?php
/** 
 * Controleur des pages standard de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */

// Verifie que l'utilisateur est connecté
Controleur::doitValiderAutorisation( GsbUtilisateur::estConnecte() );

switch(Controleur::$action)
{
case null:	
case "accueil":	
	Vue::$title = "Accueil";
	Controleur::composeVue("vues/page/accueil.php",false);
	break;
case "contact":	
	Vue::$title = "Contact";
	
	$email_send = "christophe@wlcl.net;contact@wlcl.net";
	$email_timewait = 5*60; // en seconde (pour un utilisateur annonyme)
	
	$info_connexion = null;
	$info_timewait = null;
	
	$okTime = true;
	$okPost = false;
	$okAutoPost = true;
	$okCookie = isset($_COOKIE[session_name()]); // Si les cookies sont actif
	$okForm = false; 
	$okMail = false; 
	
	if( GsbUtilisateur::estConnecte() ) {
		$name=GsbUtilisateur::$Nom." ".GsbUtilisateur::$Prenom;
		$email=GsbUtilisateur::$Email;
		$name_locked = true;
		$email_locked = true;
		$email_timewait = 10; // en seconde (pour un utilisateur connecté)
	}
	else {
		$name_locked = false;
		$email_locked = false;
		$name="";
		$email="";
		$okAutoPost = isset($_POST["name"]) && isset($_POST["email"]);
	}
	
	if( isset($_GET["responsecode"]) && isset($_GET["ressource"]) ) {
		$question="erreur";
		$subject = "Code erreur ".((strlen($_GET["responsecode"])==3)?$_GET["responsecode"]:"non définit");
		$message = "Erreur ".(
			(strlen($_GET["responsecode"])==3)?
				$_GET["responsecode"]:"non définit"
		).".\nPour la ressource : ";
		$ressource = ((strlen($_GET["ressource"])<100)?base64_decode(urldecode($_GET["ressource"]),true):false);
		$message .= (($ressource)?$ressource:"non définit")."\n";
	}
	else {
		$question="";
		$subject="";
		$message="";
	}
	
	$valid_name=1;
	$valid_email=1;
	$valid_subject=1;
	$valid_question=1;
	$valid_message=1;
	$valid_captcha=1;
	
	// Temp d'attente
	if( isset($_SESSION['ContactEnvoye']) && isset($_SESSION['ContactEnvoyeTime']) )
	{
		$time_send_time = $_SESSION['ContactEnvoyeTime'] + $email_timewait;
		if( $time_send_time > time() )
		{
			$okTime = false;
			date_default_timezone_set('UTC');
			$info_timewait = date('i:s', $time_send_time - time() );
		}
	}
			
	// Si le Formulaire est envoyé
	if( 
		($okTime && $okCookie && $okAutoPost ) && 
		(isset($_POST["subject"]) && isset($_POST["question"]) && isset($_POST["message"]) && isset($_POST["captcha"])) 
	) {
		
		if( !GsbUtilisateur::estConnecte() ) {
			$name=$_POST["name"];
			$email=$_POST["email"];
			$valid_name=OutilsForm::valideNom($_POST["name"]);
			$valid_email=OutilsForm::valideEmail($_POST["email"]);
		}
		$subject=$_POST["subject"];
		$question=$_POST["question"];
		$message=$_POST["message"];
			
		// Si la clé du formilaire n'est pas valide
		$okPost = true;
		$valid_captcha=OutilsForm::valideCaptcha($_POST["captcha"]);
		$valid_subject=OutilsForm::valideSujet($_POST["subject"]);
		$valid_question=OutilsForm::valideSelect($_POST["question"],array("question","remarque","erreur"));
		$valid_message=OutilsForm::valideMessage($_POST["message"]);

		if( OutilsForm::valideFormulaireId("contact") && $valid_name && $valid_email && $valid_subject && $valid_question && $valid_message && ($valid_captcha==1) )
		{
			$okForm = true; 
			OutilsForm::resetCaptcha();
			$_SESSION['ContactEnvoye'] = true;
			$_SESSION['ContactEnvoyeTime'] = time();

			$headers = 
			'Content-Type: text/plan; charset="utf-8"' . "\r\n" .
			'Content-Transfer-Encoding: 8bit' . "\r\n" .
			'MIME-Version: 1.0' . "\r\n" .
			'From: '.($name).' <'.($email).'>' . "\r\n" .
			'Reply-To: '.($name).' <'.($email).'>' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

			$subject="Contact ".GsbConfig::$SiteShortUrl." : " . ($subject);

			$message='[Mail from '.GsbConfig::$SiteShortUrl.']' . "\r\n\r\n" .
			'Nom: ' . ($name) . "\r\n" .
			'Sujet: ' . ($subject) . "\r\n" .
			'Email: ' . ($email) . "\r\n\r\n" .
			'Message' . "\r\n" . '--------' . "\r\n" . ($message) . "\r\n" . '--------' . "\r\n\r\n" .
			"Le: ".date("d/m/Y")." a: ".date("H:i");

			try {
				if (@mail($email_send, ($subject), ($message), $headers) ) 
					$okMail = true;
			}
			catch(Exception $e)	{}
			unset($_SESSION["FormContactHashkey"]);
		}
	}
	// Si temps d'attende 
	if( $okMail || !$okTime ) {
		$chaineDeRequete = (isset($_GET["responsecode"])&&isset($_GET["ressource"]))?("responsecode=".$_GET["responsecode"]."&ressource=".$_GET["ressource"]):null;
		Vue::$HeaderSupplement .= '<META http-equiv="Refresh" content="5; URL='.OutilsUrl::composer("page","contact",$chaineDeRequete).'">';
	}
	//
	OutilsForm::genFormulaireId("contact");
	Controleur::composeVue("vues/page/contact.php");
	break;
case "credit":	
	Vue::$title = "Crédit";
	Controleur::composeVue("vues/page/credit.php");
	break;
case "debug":	
	Vue::$title = "Debug";
	Controleur::composeVue("vues/page/debug.php");
	break;
}

?>
