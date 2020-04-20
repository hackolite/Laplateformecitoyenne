
<div id="map" class='visible'>
	<div id="mapid"></div>
	<script>


	var markerList=[];

	var map = L.map('mapid').setView([48.8589507,2.2770202], 8);


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


function eraseMarker()
{
	markerList.forEach((marker, i) => {
		marker.remove();
	});
}




	function getMarkers(type=[])
		{
			eraseMarker();
			let url= "http://0.0.0.0:5000/user_need";

			if (type.length!=0) {

				if(type.length==1) {
					url += "?type=" + type[0];
				}

			    var xmlHttp = new XMLHttpRequest();
			    xmlHttp.open( "GET", url, false ); // false for synchronous request
			    xmlHttp.send( null );
			    console.log(xmlHttp.responseText);
					var points = JSON.parse(xmlHttp.responseText);

					points.json_list.forEach((point, i) => {
							//default color
							console.log(point.type);
						  var color = "blue";
						  if (point.type=="medical") {
								console.log("medical");
								var coloredMarker = L.AwesomeMarkers.icon({
									icon: 'medkit',
									markerColor: "green",
									prefix: 'fa'
								});
						  }
						  else if (point.type=="maker") {
								console.log("maker");
								var coloredMarker = L.AwesomeMarkers.icon({
									icon: 'cogs',
									markerColor: "blue",
									prefix: 'fa'
								});
						  }



							console.log(coloredMarker);

							var desc = "<b>"+point.first_name+"</b><br />";

							if (point.fabricMask>0) {
								desc+="Masques en tissus : "+point.fabricMask+"<br />"
							}
							if (point.surgicalMask>0) {
								desc+="Masques chirugical : "+point.surgicalMask+"<br />"
							}
							if (point.constructionMask>0) {
								desc+="Masques de chantier : "+point.constructionMask+"<br />"
							}
							if (point.glasses>0) {
								desc+="Lunettes : "+point.glasses+"<br />"
							}
							if (point.blouse>0) {
								desc+="Blouses : "+point.blouse+"<br />"
							}
							if (point.visor>0) {
								desc+="Visière : "+point.visor+"<br />"
							}


						  //create the popup
						  var popup = L.popup()
						      .setContent(desc)

						  //create the marker
						  var marker = L.marker([point.latitude,point.longitude], {
						    icon: coloredMarker
						  })

							markerList.push(marker);

						  marker.bindPopup(popup);


						  //open popup when mouse over the marker
						  marker.on('mouseover', function (e) { this.openPopup(); });
						  //close popup when mouse is not over the marker
						  marker.on('mouseout', function (e) { this.closePopup(); });

						  //add the marker on the map
						  marker.addTo(map)
							});
					}
				}

	getMarkers(["medical","maker"]);


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
