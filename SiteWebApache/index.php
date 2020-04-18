<?php 


include('content/_head.php'); // l'en-tête contenant les fonctions de bases

// on affiche la page demandé

if($_GET['page'] == 'index'){
	include('content/map.php'); 
	$_GET['action'] = 'recevoir';
	include('content/receive.php');

	$_GET['action'] = 'donner';
	include('content/receive.php');  

	if(!isset($_SESSION['session']) || $_SESSION['session'] != 'true'){
		// si pas de session on inclut le formualire d'inscription et de connexion
		$_GET['action'] = 'signin';
		include('content/logpage.php');
		$_GET['action'] = 'signup';
		include('content/logpage.php');
	}


}else if($_GET['page'] == 'about'){
	include('content/about.php');
}


include('content/_bottom.php');

?>
