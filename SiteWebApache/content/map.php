
<div id="map" class='visible'>
	<div id="mapid"></div>
	<script>

	var map = L.map('mapid').setView([48.8589507,2.2770202], 10);


	L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
	    // attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
	    maxZoom: 18,
	    id: 'mapbox/streets-v11',
	    tileSize: 512,
	    zoomOffset: -1,
	    zoomControl: false,
	    attributionControl: false,
	    accessToken: 'pk.eyJ1IjoiYmlrZW5kZXYiLCJhIjoiY2sxeHp3amcwMGdvYTNobDh6Ym55ZW1ibSJ9.lGWM8-RyVB2NoQRSgIL9nQ'
	}).addTo(map);

	L.control.attribution({
	  position: 'bottomleft',
	  prefix: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>'
	}).addTo(map);

	</script>

	<nav class='on_info'>
		<div id="search">

			<span class='img img_info' data-click="map_info"></span>
			<input type="text"name='pays' placeholder="<?php echo search('pays'); ?>">
			<input type="text" name='city' placeholder="<?php echo search('ville').' / '.search('code postal'); ?>">
			<span class='img img_search'></span>

		</div>
		<div id="info">
			<p>
			<?php
				echo search("LPC(.+).</span>", null, false);
			?>
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
