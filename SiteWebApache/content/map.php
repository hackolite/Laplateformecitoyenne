
<div id="map" class='visible'>	
	<div id="mapid">

	</div>

	<nav class='on_info'>
		<div id="search">
			
			<span class='img img_info' data-click="map_info"></span>
			<input type="text"name='pays' placeholder="<?php echo search('pays'); ?>">
			<input type="text" name='city' placeholder="<?php echo search('ville'); ?>">
			<span class='img img_search'></span>

		</div>
		<div id="info">
			<p>
			LPC est une platforme de liaison, créee suite à la crise du COVID-19, entre <span class="green">les personnels médicaux</span> qui souhaitent <span class="green">recevoir</span> du matériels et <span class="blue">les makers</span> de tous horizons qui peuvent <span class="blue">fournir/donner</span> du matériels.
			</p> 
		</div>
	</nav>
	<bottom>

		<div class="legend">
			<p> <?php echo search("afficher"); ?> :</p>
			<ul>
				<li>
					<span class="checkbox on blue makers"></span>
					<span class="text"><?php echo search("Makers");?></span>
				</li>
				<li>
					<span class="checkbox on green medicals"></span>
					<span class="text"><?php echo search("mediCals");?></span>
				</li>
			</ul>
		</div>

		<div class="btt_submit fill green" data-click="recevoir">
			<?php echo search("recevoir"); ?>
		</div>
		<div class="btt_submit fill blue" data-click="donner">
			<?php echo search("give") ?>	
		</div>

	</bottom>
</div>