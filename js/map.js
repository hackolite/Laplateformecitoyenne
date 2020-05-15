document.addEventListener('DOMContentLoaded', (event) => {

	initSearch();
	try{
		initMap();
	}catch(err){
		console.error(err);
	}
	
});

const initMap = ()=>{	
	let localisation = {
		lat: 48.8534,
		long: 2.3488
	};
	var markerList=[];
	drawMap();
	if ("geolocation" in navigator) {
	  /* la géolocalisation est disponible */
		navigator.geolocation.getCurrentPosition(function(position) {
			// on localise l'utilisateur pour afficher sont emplacement sur la carte
			localisation.lat = position.coords.latitude;
			localisation.long = position.coords.longitude;
			
			map.setView([localisation.lat, localisation.long], 10);

			// traçage de la position de l'utilisateur
			L.circleMarker([localisation.lat, localisation.long], {
				radius: 10,
				color: "#ff4b7d",
				opacity: 1,
				fillColor: "#ee0042",
				fillOpacity: 0.4	
			}).addTo(map);
		});
	} else {
		f.box("La géolocalisation n'est pas disponible sur votre navigateur.")
	}	

function drawMap(localise=false){
	map = L.map('mapid').setView([localisation.lat, localisation.long], 10);


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
}


function eraseMarker(){
	markerList.forEach((marker, i) => {
		marker.remove();
	});
}


getMarkers = (type=[])=>{
	eraseMarker(); // on efface les anciens marqueur
	// à adapter pour éviter les requêtes vers le serveur trops nombreuses
	let url= "https://laplateformecitoyenne.com:5000/user_need";

	if (type.length!=0) {
		// choix du type de marker à afficher
		if(type.length==1) {
			// si un seul élément, on l'indique dans la requête GET
			url += "?type=" + type[0];
		}
		// sinon, user_need suffit pour indiquer tous les points existants

		// requête au serveur en GET
		f.AJAX({
			location: url,
			settings: null,
			type: 'GET',
			ready: (rep)=>{
				try{
					afficherPoint(JSON.parse(rep));
				}catch(err){
					// erreur de codage JSON
					console.error(err);
				}
				
			},
			error: (err)=>{
				console.error(err);
			}
		});
	}
};

var afficherPoint = (points)=>{

	points.json_list.forEach((point, i) => {
		//default color
		if (point.latitude!=undefined && point.longitude !=undefined){
			var color = "blue";
			if (point.type=="medical") {
				var coloredMarker = L.AwesomeMarkers.icon({
					icon: 'medkit',
					markerColor: "green",
					prefix: 'fa'
				});
			}
			else if (point.type=="maker") {
				var coloredMarker = L.AwesomeMarkers.icon({
					icon: 'cogs',
					markerColor: "blue",
					prefix: 'fa'
				});
			}
			else {
				var coloredMarker = L.AwesomeMarkers.icon({
					icon: 'cogs',
					markerColor: "red",
					prefix: 'fa'
				});
			}

			var desc = "<ul class='map_popup'>";
				desc += "<li><h3 class='"+point.type+"'>"+point.first_name+"</h3></li>";

			desc += "<li><a data-click='chatWith' username='"+point.username+"' href='#'>Lancer une discussion</a><li>";

			if (point.fabricMask>0) {
				desc+="<li>"+mssg.map.tissu+" : "+point.fabricMask+"</li>";
			}
			if (point.surgicalMask>0) {
				desc+="<li>"+mssg.map.chirurgical+" : "+point.surgicalMask+"</li>";
			}
			if (point.constructionMask>0) {
				desc+="<li>"+mssg.map.chantier+" : "+point.constructionMask+"</li>";
			}
			if (point.glasses>0) {
				desc+="<li>"+mssg.map.lunette+" : "+point.glasses+"</li>";
			}
			if (point.blouse>0) {
				desc+="<li>"+mssg.map.blouse+" : "+point.blouse+"</li>";
			}
			if (point.visor>0) {
				desc+="<li>"+mssg.map.visor+" : "+point.visor+"</li>";
			}

		    if (point.email) {
		    	let mail = point.email;
		    	if(point.email.length > 20){
		    		mail = point.email.substring(0,20) + "...";
		    	}
	            desc+="<li>Email : <a href='mailto:"+point.email+"'>"+mail+"</a></li>";
	        }

	        desc += "</ul>";


			//create the popup
			var popup = L.popup({minWidth: 100, maxWidth: 500})
				.setContent(desc);

			//create the marker
			var marker = L.marker([point.latitude,point.longitude], {
				icon: coloredMarker,
			});

			markerList.push(marker);
			marker.bindPopup(popup);

			//open popup when mouse over the marker
			marker.on('mouseover', function (e) { this.openPopup(); });
			//close popup when mouse is not over the marker
			//marker.on('mouseout', function (e) { this.closePopup(); });

			//add the marker on the map
			marker.addTo(map);
		}
	});
}
getMarkers(["medical","maker"]);
};





// BAR DE RECHERCHE LOCALISATION
const initSearch = ()=>{
	/*
		BAR DE RECHERCHE
	*/
	console.log("hello");
	var pays = f.query("#search [name='pays']");
	var old_value = "";

	var elmt = f.query("#search .option.pays");

	elmt.onblur =  (e)=>{
		console.log("elle");
		elmt.innerHTML = "";
	};

	pays.addEventListener("keyup", (e)=>{

		

		if(e.target.value != old_value && e.target.value != "" && /([a-z]+)/i.test(e.target.value)){

			f.AJAX({
				location: "/voc/pays.php",
				type: "GET",
				settings: "v=" + encodeURIComponent(pays.value.replace("é", "e")) + "&lang=" + lang,
				ready: (rep)=>{
					rep = rep.split(",");
					elmt.innerHTML = "";
					for (var i = 0; i < rep.length-1; i++) { // -1 car le dernier est vide du à la virgule
						elmt.innerHTML += "<div>" + rep[i] + "</div>";
					}
					
				},
				error: (err)=>{
					console.erro(err);
				}
			});

			old_value = e.target.value;

		}else if(e.target.value == ""){
			elmt.innerHTML = "";
		}


	});

}

