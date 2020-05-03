<?php
	
if(!isset($_GET["link"]) || empty($_GET["link"])){
	header("Location: /");
	exit();
}

// PAGE DE REDIRECTION VERS DES LIENS EXTERNES OU FICHIER SPECIFIQUE

$l = $_GET["link"];
$url = "";

if($l == "fb"){
	$url = "https://www.facebook.com/laplateformecitoyenne";
}else if($l == "lk"){
	$url = "https://www.linkedin.com/events/laplateformesolidaireenfinalehackthecrisisfrance-j";
}else if($l == "360medics"){
	$url = "https://360medics.com/";
}else if($l == "insta"){
	$url = "https://www.instagram.com/la_plateforme_citoyenne/?hl=fr";
}else if($l == "legal"){
	$url = "/fichier/mentions_légales.pdf";
}



header("Location: ". $url);

?>