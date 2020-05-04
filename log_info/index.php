<?php

session_start();

if((!isset($_SESSION["session"]) || $_SESSION["session"] != "true") || !isset($_GET["edit"])){
	// si tokens non existant ou compte dj loggé
	if($_GET["edit"] != "mdp"){
		header("Location: /error.php?v=404");
	}
}

if($_GET["edit"] == "mdp" && isset($_SESSION["session"]) && $_SESSION["session"] == "true"){
	// si mdp mais une session est ouverte, on retourne à l'accueil
	header("Location: /error.php?v=404");
}

$_page = "loginfo";
$dossier = "../";
include($dossier."content/_head.php");


?>
<style>
.paragraphe{
	min-height: 800px;
	overflow: hidden;
}
.paragraphe form{
	overflow: hidden;
}

.paragraphe form h1 {
    text-align: center;
    line-height: normal;
    animation-delay: 500ms;
    animation-duration: 800ms;
    color: #ee0042;
    margin-bottom: 50px;
    padding-bottom: 35px;
    border-bottom: 4px solid;
}
.paragraphe p{
	text-align: center;
	font-size: 14px;
	width: 80%;
	margin: auto;
}
.paragraphe .btt_submit{
	font-weight: normal;
	right: unset;
	position: unset;
	margin: auto;
}
.paragraphe label.legend{
	position: relative;
    left: 110px;
    text-align: left;
    display: block;
    text-transform: capitalize;
    font-size: 23px;
    color: #000;
    font-weight: normal;
}
.paragraphe form input{
	margin-top: 6px;
	text-align: center;
}

.paragraphe .mdp input{
	text-align: left;
	background: #cfffbb;
}

.paragraphe form .first{
	animation-delay: 0s;
	animation-duration: 1.2s;
}
.paragraphe form .second{
	margin-top: 50px;
	animation-delay: 0.4s;
	animation-duration: 1.2s;
}

.paragraph .btt_submit{
    margin-bottom: 45px;
}


@media (orientation: portrait) and (max-width: 1060px){
	.paragraphe label{
		padding: 45px 0px;
    	font-size: 66px!important;
	}
	.paragraphe p{
		font-size: 44px!important;
	    line-height: 57px;
	    padding: 19px 15px;
	    box-sizing: border-box;
	}
	span.mdp{
		display: none!important;
	}
	.paragraphe h1{
		font-size: 52px;
	}
}

</style>

<div class="paragraphe center formulaire">
	
	<?php
	if($_GET["edit"] == "profil"):
	?>
	<form method="POST" action="" class="zoomIn animated" id="update">
		<h1 class="zoomIn animated"><?php echo search("editing(.+)profil"); ?> 😎</h1>
		<div class="zoomIn animated first">
			<label class="legend"><?php echo search('nom'); ?>:</label>
				<input type="text" maxlength="20" name="username" value='<?php echo $_SESSION["username"]; ?>'>
			
			
			<label class="legend"><?php echo search('email'); ?>:</label>
				<input type="text" maxlength="48" name="email" value='<?php echo $_SESSION["email"]; ?>'>
			
			
			<label class="legend"><?php echo search('code postal'); ?>:</label>
				<input type="text" maxlength="5" name="postal" value='<?php echo $_SESSION["postal"]; ?>'>
		</div>

		<div class="zoomIn animated second">
			<input type="password" name="mdp" require maxlength="20" placeholder="<?php echo search('password'); ?>">
			<p><?php echo search("le mot de passe(.+)chiffre"); ?>. (%AbcD46_)</p>

			<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
			<label class='mdp'>
				<input type="password" name="new_mdp" require maxlength="20" placeholder="<?php echo search("new").' '.search('password'); ?>" data-required="false">
				<span class='mdp' data-click='mdp'><?php echo ucfirst(search('afficher')); ?></span>
			</label>
			<div class="btt_submit empty blue off submit" data-click="submit" data-form="update">
				<?php echo search("valider"); ?>
			</div>
		</div>
	</form>
	<?php
	elseif($_GET["edit"] == "mdp"):
		if(!isset($_GET["token"])):
			// si présence de token, alors on applique les modifications
	?>
	<form method="POST" action="" class="zoomIn animated" id="recup_mdp">
		<h1 class="zoomIn animated"><?php echo search("I forgot(.+)password"); ?> 😪</h1>
		<p><?php echo search("Nous vous(.+)passe"); ?></p>
		<input type="text" name="email" placeholder="email">
		<div class="btt_submit empty green off submit" data-click="submit" data-form="recup_mdp">
			<?php echo search("valider"); ?>
		</div>
	</form>
	<?php
		else:
	?>
	<form method="POST" action="" class="zoomIn animated" id="change_mdp">
		<h1 class="zoomIn animated"><?php echo search("Reinit my password"); ?> 🥰</h1>
		<p><?php echo search("The password(.+)number"); ?></p>
		<input type="hidden" name="token" value="<?php echo $_GET["token"]; ?>" >
		<label class='mdp'>
			<input type="password" name="mdp" require maxlength="20" placeholder="<?php echo search("new").' '.search('password'); ?>">
			<span class='mdp' data-click='mdp'><?php echo ucfirst(search('afficher')); ?></span>
		</label>
		<div class="btt_submit empty green off submit" data-click="submit" data-form="change_mdp">
			<?php echo search("valider"); ?>
		</div>
	</form>
	<?php
		endif;
	endif;
	?>

	<div class="white_space"></div>

</div>

	<div class="white_space"></div>
	<div class="white_space"></div>


<?php 
	include($dossier."content/_bottom.php");
?>