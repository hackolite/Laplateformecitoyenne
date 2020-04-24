<?php
if(!isset($_GET['action'])){
	exit();
}	
if($_GET['action'] == 'recevoir'){
	$color = 'green';
}else if($_GET['action'] == 'donner'){
	$color = 'blue';
}
?>
<div id="<?php echo $_GET['action']; ?>" class='formulaire hidden <?php echo $color;?>'>
	<div class='close_btt' title="<?php echo search('fermer'); ?>" data-click="<?php echo $_GET['action'];?>">+</div>
	<form method="POST">

		<div class='title'>
			<span class="img <?php echo $_GET['action']; ?>"></span>
			<span class="text"><?php 
			// affichage du titre
				if($_GET['action'] == 'recevoir'){
					$quantite = search('besoin');
					echo search("medical staff"); 
				}else if($_GET['action'] == 'donner'){
					$quantite = search('production');
					echo search("les makers"); 
				}

			?></span>
		</div>

		<div class="form left shown">
			<div class='article'>
<?php

$pre = "img/materiel/";
// liste des champs de saisies à implémenter
// ordre: text illustratif, image_url, name des input
$ressources = [

["masque en tissu","mask_tissue.png", "fabricMask"],
["masque de chirurgie", "mask_chirurgie.png", "surgicalMask"],
["masque de chantier", "mask_chantier.png", "constructionMask"],
["lunettes", "glasses.png", "glasses"],
["blouse", "doctor.png", "blouse"],
["visor", "visor.png", "visor"]

];

$html = [];


for ($i=0; $i < sizeof($ressources); $i++){
	// on applique les traductions, les prefix de dossier pour l'url des images et les name
	array_push($html, [search($ressources[$i][0]), $pre.$ressources[$i][1], $ressources[$i][2] ]);
}

for($i = 0; $i < sizeof($html); $i++):
?>
				<div class='section'>
					<label title="<?php echo $html[$i][0];?>">
						<div class="left">
							<div class="text">
								<?php echo $html[$i][0]; ?>
							</div>
							<div class="img">
								<img src="<?php echo $html[$i][1]; ?>" >
							</div>
						</div>
						<div class="right">
							<div class="label"><?php 
							echo $quantite.' / '.search('jour'); ?></div>
							<input type="number" name="<?php echo $html[$i][2]; ?>"placeholder="<?php echo search('nombres'); ?>..." min="0" max="1000000000">
						</div>
					</label>
				</div>
<?php
endfor;
?>
			</div>
			<!--<div class='bottom'>
				<div class="btt_submit fill  <?php echo $color; ?> off next" data-click='next'>
					<?php echo search('next'); ?>
				</div>
			</div>-->
			<div class='bottom'>
				<div class="btt_submit fill red off next" data-click='<?php echo $_GET['action']; ?>'>
					<?php echo search('annuler'); ?>
				</div>
				<div class="btt_submit empty <?php echo $color; ?> off submit" data-click='submit' data-form='<?php echo $_GET['action']; ?>'>
					<?php echo search('valider'); ?>
				</div>
			</div>
			<div class="white_space"></div>
		</div>
		<div class="form right hidden">
			<!--<input type="text" name="name" placeholder="<?php echo search("nom");?>">
			<input type="text" name="town" placeholder="<?php echo search("ville");?>">
			<input type="email" name="email" placeholder="<?php echo search("email");?>">

			<label class='checkbox off'>
				<input type="checkbox" data-click='checkbox'>
			</label>
			<p>
				<?php echo search("En(.+)platforme.");?>
			</p>-->


		</div>
		
	</form>
</div>