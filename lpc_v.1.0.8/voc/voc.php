<?php	


// convertion du fichier csv en tableau php
try{
	$filename = "voc/voc.csv";
	$f = fopen($filename, 'r');
	$contents = fread($f, filesize($filename));
	fclose($f);

	$lignes = preg_split("/\n/", $contents); // une ligne correspond à toute les traductions d'un seul terme

	$t = []; // notre tableau contenant le vocabulaire

	// $i les 2 premières lignes sont ignorées
	for ($i=2; $i < sizeof($lignes); $i++) { 
		array_push($t, preg_split("/,/", $lignes[$i])); // on ajoute les traductions séparées de la ligne
	}
}catch(Exception $e){
	$t = [];
}


/*$t = [
["donner", "give"],
["recevoir", "receive"],
["à propos", "about"],
["l'équipe", "team"],
["fichiers", "files"],
["afficher", "display"],
["makers", "makers"],
["médicaux", "medicals"],
["personnel médical", "medical staff"],
["nombres", "numbers"],
["besoin", "need"],
["jour", "day"]

];*/

?>