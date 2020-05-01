<?php
	
if(!isset($_GET["link"]) || empty($_GET["link"])){
	header("Location: /");
	exit();
}

// PAGE DE REDIRECTION VERS DES LIENBS EXTERNES

$l = $_GET["link"];
$url = "";

if($l == "fb"){
	$url = "https://www.facebook.com/laplateformecitoyenne";
}else if($l == "lk"){
	$url = "https://www.linkedin.com/events/laplateformesolidaireenfinalehackthecrisisfrance-j";
}else if($l == "adresse93075"){
	$url = "https://www.adresse93075.com/";
}else if($l == "360medics"){
	$url = "https://360medics.com/";
}



header("Location: ". $url);

?>