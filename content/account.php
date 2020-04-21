<?php

if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}

// affichage des infos du compte
if(!isset($_SESSION['session']) || $_SESSION['session'] != 'true'):
	// si pas de session, on arrête et détruit tout
	echo "\n\n\n\nalert";
	session_destroy();
else:

?>

<div id="account" class="formulaire hidden">
	<div class='close_btt' title="<?php echo search('fermer'); ?>" data-click="account">+</div>
	<form method="POST">
		<div class="left form visible">
			<img class='account' src='img/account.png'> 
			<div class="info" id="<?php echo $_SESSION['id']; ?>">

				<label><?php echo search('nom'); ?>:</label>
				<input type="text" disabled readonly value='<?php echo $_SESSION["username"]; ?>'>
				
				<label><?php echo search('email'); ?>:</label>
				<input type="text" disabled readonly value='<?php echo $_SESSION["email"]; ?>'>
				
				<label><?php echo search('code postal'); ?>:</label>
				<input type="text" disabled readonly value='<?php echo $_SESSION["postal"]; ?>'>
				
				<label><?php echo search('password'); ?>:</label>
				<input type="password" value="monmotdepasse" disabled>
				
			</div>
		</div>
		<div class="form right hidden"></div>

		<div class='bottom'>
			<div class="btt_submit fill red off next" onclick="document.location.href='/serveur/disconnect.php';">
				<?php echo search('disconnect'); ?>
			</div>
			<div class="btt_submit empty green off submit" data-click='submit' data-form='account'>
				<?php echo search('edit'); ?>
			</div>
		</div>
	</form>

</div>

<?php

endif;

?>