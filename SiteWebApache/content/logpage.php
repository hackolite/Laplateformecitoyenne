<?php
if(!isset($_GET['action'])){
	exit();
}	

?>
<div id="<?php echo $_GET['action']; ?>" class='formulaire hide'>
	<div class='close' title="<?php echo search('fermer'); ?>" data-click="<?php echo $_GET['action'];?>">+</div>
	<form method="POST">

		<div class='title'>
			<span class="img <?php echo $_GET['action']; ?>"></span>
			<span class="text"><?php 
			// affichage du titre
				if($_GET['action'] == 'signup'){
					$color = 'green';
					echo search("sign up"); 
				}else if($_GET['action'] == 'signin'){
					$color = 'black';
					echo search("sign in"); 
				}

			?></span>
		</div>

		<div class="form left visible">
			<div class='article'>

			<?php
			if($_GET['action'] == 'signup'):
			?>

			<input type="text" name="name" placeholder="<?php echo search('nom');?>">
			<input type="email" name="email" placeholder="<?php echo search('email');?>">
			<input type="text" name="postale" placeholder="<?php echo search('code postale');?>">
			<input type="password" name="mdp" placeholder="<?php echo search('password'); ?>">

			<label class='checkbox off'>
				<input type="checkbox" data-click='checkbox'>
			</label>
			<p>
				<?php echo search("En(.+)platforme.");?>
			</p>

			<?php
			elseif($_GET['action'] == 'signin'):
			?>

			<input type="email" name="email" placeholder="<?php echo search('email'); ?>">
			<input type="password" name="mdp" placeholder='<?php echo search("password");?>'>

			<?php
			endif;
			?>

			</div>
		</div>

		<div class="form right hide"></div>

		<div class='bottom'>
			<div class="btt_submit fill <?php echo $color; ?> off next" data-click='next'>
				<?php echo search('return'); ?>
			</div>
			<div class="btt_submit empty <?php echo $color; ?> off submit" data-click='submit' data-form='<?php echo $_GET['action']; ?>'>
				<?php echo search('valider'); ?>
			</div>
		</div>

	</form>
</div>