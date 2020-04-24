<?php
if(!isset($_GET['action'])){
	exit();
}	
if($_GET['action'] == 'signup'){
	$color = 'green';
}else if($_GET['action'] == 'signin'){
	$color = 'black';
}
?>
<div id="<?php echo $_GET['action']; ?>" class='formulaire hidden <?php echo $color; ?>'>
	<div class='close_btt' title="<?php echo search('fermer'); ?>" data-click="<?php echo $_GET['action'];?>">+</div>
	<form method="POST">

		<div class='title'>
			<span class="img <?php echo $_GET['action']; ?>"></span>
			<span class="text"><?php 
			// affichage du titre
				if($_GET['action'] == 'signup'){
					echo search("sign up"); 
				}else if($_GET['action'] == 'signin'){
					echo search("sign in");
				}

			?></span>
		</div>

		<div class="form left shown">
			<div class='article'>

			<?php
			if($_GET['action'] == 'signup'):
			?>

			<input type="text" name="username" require placeholder="<?php echo search('nom');?>">
			<input type="email" name="email" require placeholder="<?php echo search('email');?>">
			<input type="text" name="postal" require placeholder="<?php echo search('code postal');?>">
			<label class='mdp'>
			<input type="password" name="mdp" require placeholder="<?php echo search('password'); ?>">
			<span class='mdp'>Afficher</span>
			</label>

			<label class='checkbox off'>
				<input type="checkbox" data-click='checkbox' name="cgu">
			</label>
			<p>
				<?php echo search("En(.+)platforme.");?>
			</p>

			<?php
			elseif($_GET['action'] == 'signin'):
			?>

			<input type="email" name="email" require placeholder="<?php echo search('email'); ?>">
			<input type="password" name="mdp" require placeholder='<?php echo search("password");?>'>

			<?php
			endif;
			?>

			</div>
			<div class="white_space"></div>
		</div>

		<div class="form right hidden"></div>

		<div class='bottom'>
			<div class="btt_submit fill red off next" data-click='<?php echo $_GET['action']; ?>'>
				<?php echo search('annuler'); ?>
			</div>
			<div class="btt_submit empty <?php echo $color; ?> off submit" data-click='submit' data-form='<?php echo $_GET['action']; ?>'>
				<?php echo search('valider'); ?>
			</div>
		</div>

	</form>
</div>