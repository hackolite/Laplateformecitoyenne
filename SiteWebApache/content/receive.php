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
				if($_GET['action'] == 'recevoir'){
					$color = 'green';
					echo search("medical staff"); 
				}else if($_GET['action'] == 'donner'){
					$color = 'blue';
					echo search("les makers"); 
				}

			?></span>
		</div>

		<div class="form left visible">
			<div class='article'>
<?php

$pre = "img/materiel/";
// liste des champs de saisies à implémenter
// ordre: text illustratif, image_url
$ressources = [

["masque en tissu","mask_tissue.png"],
["masque de chirurgie", "mask_chirurgie.png"],
["masque de chantier", "mask_chantier.png"],
["lunettes", "glasses.png"],
["blouse", "doctor.png"],
["visor", "visor.png"]

];

$html = [];


for ($i=0; $i < sizeof($ressources); $i++){
	array_push($html, [search($ressources[$i][0]), $pre.$ressources[$i][1] ]);
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
							<div class="label"><?php echo search('besoin').' / '.search('jour'); ?></div>
							<input type="number" name="" placeholder="<?php echo search('nombres'); ?>...">
						</div>
					</label>
				</div>
<?php
endfor;
?>
			</div>
			<div class='bottom'>
				<div class="btt_submit fill  <?php echo $color; ?> off next" data-click='next'>
					<?php echo search('next'); ?>
				</div>
			</div>
		</div>
		<div class="form right hide">
			<input type="text" name="name" placeholder="<?php echo search("nom");?>">
			<input type="text" name="postal" placeholder="<?php echo search("code postale");?>">
			<input type="email" name="email" placeholder="<?php echo search("email");?>">

			<label class='checkbox off'>
				<input type="checkbox" data-click='checkbox'>
			</label>
			<p>
				<?php echo search("En(.+)platforme.");?>
			</p>


			<div class='bottom'>
				<div class="btt_submit fill <?php echo $color; ?> off next" data-click='next'>
					<?php echo search('return'); ?>
				</div>
				<div class="btt_submit empty <?php echo $color; ?> off submit" data-click='submit' data-form='<?php echo $_GET['action']; ?>'>
					<?php echo search('valider'); ?>
				</div>
			</div>

		</div>
		
	</form>
</div>