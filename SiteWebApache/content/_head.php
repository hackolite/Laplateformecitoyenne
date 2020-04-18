<?php

session_start();

/*
	##### GESTION DU LANGAGE DU SITE ####
*/

require('voc/voc.php');

$l = [];
$l['list_lang'] = ['fr', 'en']; // liste des langues dans l'ordre respectif

// détermination de la langue
if(!isset($_GET['lang'])){
	// si lang non précisé, on le met en fr par défaut
	$l["get_lang"] = 'fr';
}else{
	$l['get_lang'] = $_GET['lang'];
}


function language($list, $lang){
	// retourne la position de la langue sélectionnée pour accéder dans les listes
	for ($i=0; $i < sizeof($list); $i++) { 
		if( $list[$i] == $lang ){
			return $i;
		}
	}

	return 0; // langue d'origine si language non disponible
}

function search($word, $lang=null){
	// fonction permettant de retrouver le mot $word dans le language $lang
	// $word peut être en n'importe quelle langue tant qu'il existe
	// $lang correspond à la position du langage dans le lexique
	global $t; // notre lexique
	global $l;

	if(!isset($lang)){
		// si langue non passé en paramètre, on prendra alors la langue courante de la page
		$lang = $l['lang']; 
	}

	for ($i=0; $i < sizeof($t); $i++) { 
	// on parcours notre lexique
		for ($j=0; $j < sizeof($t[$i]); $j++) { 
		// on parcours toutes les traductions d'un mot, car $word peut être de n'importe qu'elle langue
			// on convertit en url car %0D peut apparaitre avec le fichier csv, indiquant une fin de ligne
			$test = str_replace("+", " ", urlencode($t[$i][$j]));
			$tested = str_replace("+", " ", urlencode($word));
			if(preg_match('/^'.$tested.'(%0D)?$/i', $test, $matches)){

				try {
					return $t[$i][$lang];
				} catch (Exception $e) {
					// si une exception se présente, c'est que la langue n'existe pas
					// on le mettra donc par défault (en fr)
					return $t[$i][0];
				}
			
			}
		}

	}
	
	return '';
}

$l['lang'] = language($l['list_lang'], $l['get_lang']);


if(!isset($_GET['page'])){
	$_GET['page'] = 'index';
}


?>
<!DOCTYPE html>
<html lang="<?php echo $l['get_lang']; ?>">
<head>
	<meta charset="utf-8">
	<meta name="description" content="La plateforme citoyenne est un site internet permettant de visualiser localement les besoins médicaux et les « makers » à partir d' une carte interactive, afin de favoriser les échanges locaux.">
	<title><?php 
		$page_text = str_replace("à", "a", search($_GET['page']));
		echo ucfirst($page_text); 

	?> | La Platforme Citoyenne</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" type="image/png" href="img/minia_logo.png" />
	<?php if($_GET['page'] == 'index'): ?>
	<script src="controller.js"></script>
	<?php endif; ?>
</head>
<body>

	<?php include('content/header.php'); ?>

	<div id="page">