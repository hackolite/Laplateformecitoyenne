<?php

session_start();

/*
	##### GESTION DU LANGAGE DU SITE ####
*/

require('voc/voc.php');

require('serveur/lang.php');

require('serveur/versioning.php');


if(!isset($_GET['page'])){ // si page non définie, c l'accueil
	$_GET['page'] = 'home';
}

?>
<!--
© 2020 LaPlateformeCitoyenne.com - All rights reserved
						/!\/!\
Any reproduction, total or partial, and any representation of the substantial content of this site, 
of one or more of its components(event without the © mention), by any process whatsoever, without 
the express authorization of La Plateforme Citoyenne, is prohibited, and constitutes an infringement 
punishable by Articles L.335-2 et seq. of the Intellectual Property Code.

More informations on the website.




---#----##----###-#----##--###-###-####-###-####-##-##-###--
---#---####---###-#---####--#--##--###--# #-####-#-#-#-##---
---###-#--#---#---###-#--#--#--###-#----###-#--#-#---#-###--
-----###-#--#-####------------------------------------------
-----#----##---#--------------------------------------------
-----###--##---#--------------------------------------------



-->
<!DOCTYPE html>
<html lang="<?php echo $l['get_lang']; ?>">
<head>
	<base href="/">
	<meta charset="utf-8">
	<meta name="description" content="La plateforme citoyenne est un site internet permettant de visualiser localement les besoins médicaux et les « makers » à partir d' une carte interactive, afin de favoriser les échanges locaux.">
	<title><?php 
		$page_text = str_replace("à", "a", search($_GET['page']));
		echo ucfirst($page_text); 

	?> - La Plateforme Citoyenne</title>
	<link rel="stylesheet" type="text/css" href="/effect<?php echo $version["effect.css"]; ?>.css" importance='high'>
	<link rel="stylesheet" type="text/css" href="/style<?php echo $version["style.css"]; ?>.php" importance='high'>
	<link rel="stylesheet" type="text/css" href="mobile<?php echo $version["style.css"]; ?>.php" media="(orientation: portrait) and (max-width: 1060px)">
	<link rel="icon" type="image/png" href="img/minia_logo<?php echo $version["logo.png"]; ?>.png" />
	<?php 
	if($_GET['page'] == 'home'): 
		// si page home, on inclut tous les fichiers à index et à la map
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

	<?php
	else:
	?>
	<style>
		/*
		Réajustement problème avec leaflet
		*/
		#title{
			top: 20px;
		}
	</style>

	<?php endif; ?>
	<script src="js/controller<?php echo $version["controller.js"]; ?>.js"></script>
	<script>

		// message
var mssg = {
	logout: {
		auto:"<?php echo search("Vous(.+)succés.");?>", 
		expired:"<?php echo search("Votre session(.+)reconnecter."); ?>"
	},
	compterequit: "<?php echo search("Vous(.+)continuer.");?>",
	form: {
		error: "<?php echo search("Une erreur(.+)validation");?>",
		valid: "<?php echo search("Form validate !"); ?>"
	},
	account: {
		noexist: "<?php echo search("aucun compte(.+)saisies");?>",
		error: "<?php echo search("connection error"); ?>"
	},
	indisponible: "<?php echo search("non disponible(.+)moment"); ?>",
	serveur: {
		error: "<?php echo search("Erreur inattendue(.+)serveur"); ?>"
	},
	cgu: "<?php echo search("please accept(.+)of us"); ?>"

}
	<?php
	if(isset($_GET['logout']) && !empty($_GET['logout'])
		&& isset($_GET['id']) && !empty($_GET['id'])):
		// permet d'afficher le message de déconnexion, et de le transmettre à Python
	?>

		var logout = ['<?php echo $_GET['logout']; ?>', '<?php echo $_GET['id']; ?>'];

	<?php
	endif;
	?>
	</script>


</head>
<body>

	<?php include('content/header.php'); ?>

	<div id="page">