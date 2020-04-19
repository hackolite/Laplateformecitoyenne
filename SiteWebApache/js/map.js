var onReady2 = function(){



};

function getMarkers(type)
	{
	    const url ="http://0.0.0.0:5000/user_need/?type=" + type;

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

				  marker.bindPopup(popup);


				  //open popup when mouse over the marker
				  marker.on('mouseover', function (e) { this.openPopup(); });
				  //close popup when mouse is not over the marker
				  marker.on('mouseout', function (e) { this.closePopup(); });

				  //add the marker on the map
				  marker.addTo(map)
					});
			}

		getMarkers();