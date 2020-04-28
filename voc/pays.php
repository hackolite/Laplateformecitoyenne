<?php

// recherche de pays

if(!isset($_GET["v"]) || empty($_GET["v"])){
	echo "false";
	exit();
}


if(!isset($_GET["lang"])){
	$_GET['lang'] = 1;
}

try{
	$filename = "pays.csv";
	$f = fopen($filename, 'r');
	$contents = fread($f, filesize($filename));
	fclose($f);

	$lignes = preg_split("/\n/", $contents); // une ligne correspond à un pays

	$t = []; // notre tableau contenant les villes

	// les 2 premières lignes sont ignorés car juste info
	for ($i=2; $i < sizeof($lignes); $i++) { 
		array_push($t, preg_split("/,/", $lignes[$i]));
	}


	$pays = [];
	// on ne prend que les 2 derniers éléments, correspondant
	for($i=0; $i < sizeof($t); $i++){
		$pays[$i] = [];
		for($j=4; $j < sizeof($t[$i]); $j++){
			array_push($pays[$i], $t[$i][$j]);
		}
	}

	// recherche
	for($i = 0; $i < sizeof($pays)-1; $i++){
		if(preg_match("/^".ucfirst($_GET["v"])."/i", $pays[$i][$_GET['lang']])){
			echo $pays[$i][$_GET['lang']] . ",";
		}

	}


}catch(Exception $e){
	echo "false";
}

/*
if(preg_match("/^".$_GET["v"]."/i", $t[$i][$j])){
				echo $t[$i][$j] . ",";
			}
*/