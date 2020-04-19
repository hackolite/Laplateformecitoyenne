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
			/*
			 dans le cas de phrase à rechercher, il y a la présence de regex
			 il ne faut donc pas les encoder. seul (.+) est admit pour l'instant
			*/
			$tested = str_replace("%28.%2B%29", "(.+)", $tested);


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
	<?php 
	if($_GET['page'] == 'index'): 
		// si page index, on inclut tous les fichiers à index et à la map
	?>
	<!-- Bootstrap -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<!-- Leaflet -->
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
	<!-- Bootstrap Theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"/>
	<!-- FontAwesome -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
	<!-- AwesomeMarkers -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.css"/>

	<!-- Leaflet -->
	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
	<!-- JQuery -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<!-- bootstrap -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<!-- AwesomeMarkers -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.js"></script>

	<script src="js/controller.js"></script>
	<script src="js/map.js"></script>
	<?php endif; ?>
</head>
<body>

	<?php include('content/header.php'); ?>

	<div id="page">