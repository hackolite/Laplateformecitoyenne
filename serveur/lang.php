<?php

$l = [];
$l['list_lang'] = ['fr', 'en']; // liste des langues dans l'ordre respectif

// détermination de la langue

if(isset($_COOKIE['lang']) || !empty($_COOKIE['lang'])){
	// si un cookie existe	

	// on vérifie que le langage existe
	$existing_lang = false;
	for ($i=0; $i < sizeof($l['list_lang']); $i++) { 
		if($l['list_lang'][$i] == $_COOKIE['lang']){
			$existing_lang = true; // il existe
		}
	}

	if($existing_lang == true){
		$l["get_lang"] = $_COOKIE['lang'];
	}else{
		// si cookie à valeur fausse, on va vider le cookie afin de le remplacer après
		$l["get_lang"] = $l['list_lang'][0];
		$_COOKIE['lang'] = '';
	}

}

if(!isset($_GET['lang'])){
	if(empty($_COOKIE['lang'])){
		// si lang non précisé et non précisé dans cookie, on le met en fr par défaut
		$l["get_lang"] = $l['list_lang'][0];
	}

}else{
	$l['get_lang'] = $_GET['lang'];
}

if(!isset($_COOKIE['lang']) || empty($_COOKIE['lang']) || $_COOKIE['lang'] != $l['get_lang']){
	// si cookie non existant ou langue non identique, on le crée/modifie
	setcookie('lang', $l["get_lang"], time() + 365*24*3600, '/'); // cookie accessible partout et toujours au même endroit
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