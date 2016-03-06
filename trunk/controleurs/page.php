<?php
/** 
 * Controleur des pages standard de l'application GSB
 * @package default
 * @author Kim Paviot, Julien Dignat and Christophe Sonntag
 * @version 1.1
 */
switch(Controleur::$action)
{
case null:	
case "accueil":	
	Vue::$title = "Accueil";
	Controleur::composeVue("vues/page/accueil.php",false);
	break;
case "contact":	
	Vue::$title = "Contact";
	
	Vue::$donnees["email_send"] = "christophe@wlcl.net;contact@wlcl.net";
	Vue::$donnees["email_timewait"] = 5*60; // en seconde (pour un utilisateur annonyme)
	
	Vue::$donnees["info_connexion"] = null;
	Vue::$donnees["info_timewait"] = null;
	
	Vue::$donnees["okTime"] = true;
	Vue::$donnees["okPost"] = false;
	Vue::$donnees["okAutoPost"] = true;
	Vue::$donnees["okCookie"] = isset($_COOKIE[session_name()]); // Si les cookies sont actif
	Vue::$donnees["okForm"] = false; 
	Vue::$donnees["okMail"] = false; 
	
	if( GsbUtilisateur::estConnecte() ) {
		Vue::$donnees["name"]=GsbUtilisateur::$Nom." ".GsbUtilisateur::$Prenom;
		Vue::$donnees["email"]=GsbUtilisateur::$Email;
		Vue::$donnees["name_locked"] = true;
		Vue::$donnees["email_locked"] = true;
		Vue::$donnees["email_timewait"] = 10; // en seconde (pour un utilisateur connecté)
	}
	else {
		Vue::$donnees["name_locked"] = false;
		Vue::$donnees["email_locked"] = false;
		Vue::$donnees["name"]="";
		Vue::$donnees["email"]="";
		Vue::$donnees["okAutoPost"] = isset($_POST["name"]) && isset($_POST["email"]);
	}
	
	if( isset($_GET["responsecode"]) && isset($_GET["ressource"]) ) {
		Vue::$donnees["question"]="erreur";
		Vue::$donnees["subject"] = "Code erreur ".((strlen($_GET["responsecode"])==3)?$_GET["responsecode"]:"non définit");
		Vue::$donnees["message"] = "Erreur ".(
			(strlen($_GET["responsecode"])==3)?
				$_GET["responsecode"]:"non définit"
		).".\nPour la ressource : ";
		$ressource = ((strlen($_GET["ressource"])<100)?base64_decode($_GET["ressource"]):false);
		Vue::$donnees["message"] .= (($ressource)?$ressource:"non définit")."\n";
	}
	else {
		Vue::$donnees["question"]="";
		Vue::$donnees["subject"]="";
		Vue::$donnees["message"]="";
	}
	
	Vue::$donnees["valid_name"]=1;
	Vue::$donnees["valid_email"]=1;
	Vue::$donnees["valid_subject"]=1;
	Vue::$donnees["valid_question"]=1;
	Vue::$donnees["valid_message"]=1;
	Vue::$donnees["valid_captcha"]=1;
	
	if( isset($_SESSION['ContactEnvoye']) && isset($_SESSION['ContactEnvoyeTime']) )
	{
		$time_send_time = $_SESSION['ContactEnvoyeTime'] + Vue::$donnees["email_timewait"];
		if( $time_send_time > time() )
		{
			Vue::$donnees["okTime"] = false;
			date_default_timezone_set('UTC');
			Vue::$donnees["info_timewait"] = date('i:s', $time_send_time - time() );
		}
	}
			
	// Si le Formulaire est envoyé
	if( 
		(Vue::$donnees["okTime"] && Vue::$donnees["okCookie"]) &&
		(isset($_POST["hashkey"]) && isset($_SESSION["FormContactHashkey"]) && Vue::$donnees["okAutoPost"] ) &&
		(isset($_POST["subject"]) && isset($_POST["question"]) && isset($_POST["message"]) && isset($_POST["captcha"])) 
	) {
		
		if( !GsbUtilisateur::estConnecte() ) {
			Vue::$donnees["name"]=$_POST["name"];
			Vue::$donnees["email"]=$_POST["email"];
			Vue::$donnees["valid_name"]=OutilsForm::valideNom($_POST["name"]);
			Vue::$donnees["valid_email"]=OutilsForm::valideEmail($_POST["email"]);
		}
		Vue::$donnees["subject"]=$_POST["subject"];
		Vue::$donnees["question"]=$_POST["question"];
		Vue::$donnees["message"]=$_POST["message"];
			
		// Si la clé du formilaire n'est pas valide
		if( $_SESSION["FormContactHashkey"] !== $_POST["hashkey"]) {
			Vue::$donnees["info_connexion"] = "Erreur, securité de connexion !";
		}
		else {
			
			Vue::$donnees["okPost"] = true;
			Vue::$donnees["valid_captcha"]=OutilsForm::valideCaptcha($_POST["captcha"]);
			Vue::$donnees["valid_subject"]=OutilsForm::valideSujet($_POST["subject"]);
			Vue::$donnees["valid_question"]=OutilsForm::valideSelect($_POST["question"],array("question","remarque","erreur"));
			Vue::$donnees["valid_message"]=OutilsForm::valideMessage($_POST["message"]);
			
			if( Vue::$donnees["valid_name"] && Vue::$donnees["valid_email"] && Vue::$donnees["valid_subject"] && Vue::$donnees["valid_question"] && Vue::$donnees["valid_message"] && (Vue::$donnees["valid_captcha"]==1) )
			{
				Vue::$donnees["okForm"] = true; 
				OutilsForm::resetCaptcha();
				$_SESSION['ContactEnvoye'] = true;
				$_SESSION['ContactEnvoyeTime'] = time();
				
				$headers = 
				'Content-Type: text/plan; charset="utf-8"' . "\r\n" .
				'Content-Transfer-Encoding: 8bit' . "\r\n" .
				'MIME-Version: 1.0' . "\r\n" .
				'From: '.(Vue::$donnees["name"]).' <'.(Vue::$donnees["email"]).'>' . "\r\n" .
				'Reply-To: '.(Vue::$donnees["name"]).' <'.(Vue::$donnees["email"]).'>' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
				
				$subject="Contact ".GsbConfig::$SiteShortUrl." : " . (Vue::$donnees["subject"]);
				
				$message='[Mail from christophe-sonntag.u4a.at]' . "\r\n\r\n" .
				'Nom: ' . (Vue::$donnees["name"]) . "\r\n" .
				'Sujet: ' . (Vue::$donnees["subject"]) . "\r\n" .
				'Email: ' . (Vue::$donnees["email"]) . "\r\n\r\n" .
				'Message' . "\r\n" . '--------' . "\r\n" . (Vue::$donnees["message"]) . "\r\n" . '--------' . "\r\n\r\n" .
				"Le: ".date("d/m/Y")." a: ".date("H:i");
				
				try {
					if (@mail(Vue::$donnees["email_send"], ($subject), ($message), $headers) ) 
						Vue::$donnees["okMail"] = true;
				}
				catch(Exception $e)	{}
				unset($_SESSION["FormContactHashkey"]);
			}
		}
	}
	Vue::$donnees["hashkey"] = md5(rand(0, 10000));
	$_SESSION["FormContactHashkey"] = Vue::$donnees["hashkey"];
	if( Vue::$donnees["okMail"] || !Vue::$donnees["okTime"] )
		Vue::$HeaderSupplement .= '<META http-equiv="Refresh" content="5; URL='.OutilsUrl::composer("page","contact").'">';
	//
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
