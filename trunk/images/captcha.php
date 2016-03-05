<?php
session_start();

function motHasard($n)
{
    $voyelles = array('a', 'e', 'i', 'o', 'u', 'ou', 'io','ou','ai');
    $consonnes = array('b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm','n', 'p', 'r', 's', 't', 'v', 'w',
			'br','bl', 'cr','ch', 'dr', 'fr', 'dr', 'fr', 'fl', 'gr','gl','pr','pl','ps','st','tr','vr');
                            
    $mot = '';
    $nv = count($voyelles)-1;
    $nc = count($consonnes)-1;
	for($i = 0; $i < round($n/2); ++$i)
	{
		$mot .= $voyelles[mt_rand(0,$nv)];
		$mot .= $consonnes[mt_rand(0,$nc)];
	}
	
	return substr($mot,0,$n); // Comme certaines syllabes font plus d'un caractère, on est obligé de couper pour avoir le nombre exact de caractères.
}

function captcha($mot)
{
	$size = 64;
	$marge = 15;
	$font = '../fonts/angelina.ttf';
	
	$matrix_blur = array(
		array(1,1,1),
		array(1,1,1),
		array(1,1,1));
		
	$box = imagettfbbox($size, 0, $font, $mot);
	$largeur = $box[2] - $box[0];
	$hauteur = $box[1] - $box[7];
	$largeur_lettre = round($largeur/strlen($mot));
	
	$img = imagecreate($largeur+$marge, $hauteur+$marge);
	$blanc = imagecolorallocate($img, 255, 255, 255); 
	$noir = imagecolorallocate($img, 0, 0, 0);
	
	$couleur = array(
		imagecolorallocate($img, 0x99, 0x00, 0x66),
		imagecolorallocate($img, 0xCC, 0x00, 0x00),
		imagecolorallocate($img, 0x00, 0x00, 0xCC),
		imagecolorallocate($img, 0x00, 0x00, 0xCC),
		imagecolorallocate($img, 0xBB, 0x88, 0x77));

	for($i = 0; $i < strlen($mot);++$i)
	{
		$l = $mot[$i];
		$angle = mt_rand(-35,35);
		imagettftext($img,mt_rand($size-7,$size),$angle,($i*$largeur_lettre)+$marge, $hauteur+mt_rand(0,$marge/2),$couleur[array_rand($couleur)], $font, $l);	
	}
	
	
	imageline($img, 2,mt_rand(2,$hauteur), $largeur+$marge, mt_rand(2,$hauteur), $noir);
	imageline($img, 2,mt_rand(2,$hauteur), $largeur+$marge, mt_rand(2,$hauteur), $noir);
	

	imageconvolution($img, $matrix_blur,10,10);
	imageconvolution($img, $matrix_blur,10,0);
	
	imagepng($img);
	imagedestroy($img);
}

$rand = motHasard(5);
$_SESSION["CaptchaKey"] = $rand;

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Content-type: image/png");
captcha( $rand );

?>