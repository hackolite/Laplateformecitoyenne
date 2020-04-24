<?php

/*
if(!isset($_GET['v']) || empty($_GET['v'])){
	header('Location: /');
}*/
require('voc/voc.php');

require('serveur/lang.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<style>
body {
	background: #dedede;
}
.page-wrap {
	min-height: 100vh;
}
	</style>
</head>
<body>

	<div class="page-wrap d-flex flex-row align-items-center">
	    <div class="container">
	        <div class="row justify-content-center">
	            <div class="col-md-12 text-center">
	            	<img src="/img/small_logo.png" alt="Logo">
	                <span class="display-1 d-block"><?php echo strtoupper(search('error')).' '.$_GET['v'];?></span>
	                <div class="mb-4 lead"><?php echo search('sorry').', '.search('la page que(.+)chargée').'.'; ?></div>
	                <a href="/" class="btn btn-link"><?php echo search('Back to Home');?></a>
	            </div>
	        </div>
	    </div>
	</div>

</body>
</html>
