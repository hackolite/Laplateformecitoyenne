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
	<title>Error - La Plateforme Citoyenne</title>
  <link rel="icon" type="image/png" href="img/minia_logo.png" />
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
* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

body {
  width: 100%;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  font-family: "Quicksand", sans-serif;
  font-size: 42px;
  background: #f7f7f7;
}

span {
  margin: 0 15px;
  line-height: 0.7;
  text-shadow: 0 0 2px rgba(0, 0, 0, 0.45);
  animation: span 3s ease-in infinite alternate;
}

.main {
  display: flex;
  justify-content: center;
  align-items: flex-start;
}

.letter {
  display: inline-flex;
  height: 30px;
  width: 30px;
  /* border: 2.5px solid #FF1EAD; */
  border: 5px solid #363636;
  border-radius: 40px;
  box-shadow: 0 0 2px rgba(0, 0, 0, 0.75), inset 0 0 2px rgba(0, 0, 0, 0.45);
  animation: letter 3s ease-in-out infinite alternate;
}

@keyframes span {
  0%,
  30% {
    margin: 0 10px;
  }
  70%,
  100% {
    margin: 0 -2px;
  }
}
@keyframes letter {
  0%,
  30% {
    width: 30px;
  }
  70%,
  100% {
    width: 30vw;
  }
}

	</style>
</head>
<body>

	<div class="page-wrap d-flex flex-row align-items-center">
	    <div class="container">
	        <div class="row justify-content-center">
	            <div class="col-md-12 text-center">
	            	<img src="/img/_logo.png" alt="Logo" width="50%">
	                <span class="display-1 d-block main">
	                	<span class="main" style="font-size: 40px;">
		                	<span>E</span>
		                	<span>R</span>
		                	<span>R</span>
		                	<span class="letter"></span>
		                	<span>R</span>
		                </span>
	                	<span><?php echo $_GET['v'];?></span>
	                </span>
	                <div class="mb-4 lead"><?php echo search('sorry').', '.search('la page que(.+)chargée').'.'; ?></div>
	                <a href="/" class="btn btn-link"><?php echo search('Back to Home');?></a>
	            </div>
	        </div>
	    </div>
	</div>

</body>
</html>
