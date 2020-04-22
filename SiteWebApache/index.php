<!-- Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
	integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
	crossorigin=""/>

<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
	integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
	crossorigin=""></script>




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
}else if($_GET['page'] == 'team'){
	include('content/team.php');
}


include('content/_bottom.php');

?>
