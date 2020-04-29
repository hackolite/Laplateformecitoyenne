<?php


include('content/_head.php'); // l'en-tête contenant les fonctions de bases

// on affiche la page demandé

if(!isset($_SESSION['session']) || $_SESSION['session'] != 'true'){
	// si pas de session on inclut le formualire d'inscription et de connexion
	$_GET['action'] = 'signin';
	include('content/logpage.php');
	$_GET['action'] = 'signup';
	include('content/logpage.php');
}else{

	// On vérifie si la session est toujours valide
	$temps = time() - $_SESSION['start_time'];

	if($temps > 60*60){ // déconnexion au bout d'une heure
		if(isset($_SESSION['id'])){
			$id = $_SESSION['id'];
			session_destroy();
			header('Location: /logout/expired/'.$id);
			exit();
		}
		session_destroy();
		header('Location: /');
		exit();
	}

	// sinon on inclut les informations du compte
	include('content/account.php');
}

if($_GET['page'] == 'home'){
	if(isset($_SESSION["session"]) && $_SESSION["session"] == "true"){
		// on affiche la carte si session
		include('content/map.php');
		$_GET['action'] = 'recevoir';
		include('content/receive.php');

		$_GET['action'] = 'donner';
		include('content/receive.php');
	}else{
		// sinon page d'accueil normal
		include('content/home.php');
	}


}else if($_GET['page'] == 'about'){
	include('content/about.php');
}else if($_GET['page'] == 'team'){
	include('content/team.php');
}
else{
?>
<script>
	document.location.href="/error.php?v=404";
</script>
<?php
}

include('content/_bottom.php');

?>
