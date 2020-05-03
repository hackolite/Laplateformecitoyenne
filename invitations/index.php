<?php

session_start();

if(!isset($_GET["token"]) ||  empty($_GET["token"]) || isset($_SESSION["session"])){
	// si tokens non existant ou compte dj loggé
	header("Location: /");
}

$_page = "mdp";
$dossier = "../";
include($dossier."content/_head.php");


?>
<style>
.paragraphe{
	height: unset;
	min-height: 450px;
}

.paragraphe form h1{
	text-align: center;
	animation-delay: 500ms;
	animation-duration: 800ms;
	color: #ee0042;
	margin-bottom: 90px;
	height: ;
}
.paragraphe .btt_submit{
	font-weight: normal;
	right: unset;
	position: unset;
	margin: auto;
}

</style>
<div class="paragraphe center formulaire">
	
	<form method="POST" action="">

		<h1 class="zoomIn animated">Envore une étape et on décolle !</h1>
		<input type="hidden" name="token">
		<label class='mdp'>
			<input type="password" name="mdp" require min="7" max="20" placeholder="<?php echo search('password'); ?>">
			<span class='mdp' data-click='mdp'><?php echo ucfirst(search('afficher')); ?></span>
		</label>
		<div class="btt_submit empty black off submit" data-click="submit" data-form="signin">
			<?php echo search("valider"); ?>
		</div>
	</form>

</div>


<?php 
	include($dossier."content/_bottom.php");
?>