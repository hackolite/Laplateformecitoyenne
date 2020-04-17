var map = L.map('mapid').setView([48.8589507,2.2770202], 10);

debugState = false;
squareList = [];

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


var markersPosition = JSON.parse(document.getElementById("data-handler").dataset.geocode);
console.log(markersPosition);

var markersList = [];

markersPosition.forEach((point, i) => {

  //get the color from the config file
  // color = markersConfig[point.type].color

  //default color
  color = "red"
  if (point.type=="hopital") {
    color = "green";
  }
  else if (point.type=="maker") {
    color = "blue";
  }

  //create the marker
  var coloredMarker = L.AwesomeMarkers.icon({
    "markerColor": color
  });

  //create the popup
  var popup = L.popup()
      .setContent(point.desc)

  //create the marker
  var marker = L.marker([point.lat,point.lng], {
    icon: coloredMarker
  })

  marker.bindPopup(popup);

  marker.on("click", onClickMarker)

  //open popup when mouse over the marker
  marker.on('mouseover', function (e) { this.openPopup(); });
  //close popup when mouse is not over the marker
  marker.on('mouseout', function (e) { this.closePopup(); });

  //add the marker on the map
  marker.addTo(map)

  //append the marker to the list of marker. This is used to get the id of the clicked marker
  markersList.push({
    name:point.name,
    id:point.id,
    type:point.type,
    markerObject: marker
  });
});

function onClickMarker(e) {
  console.log(e);
  console.log(markersList);
  markersList.forEach((marker, i) => {
    console.log(marker);
    if (marker.markerObject._latlng==e.latlng) {
      openChat(marker.id,marker.name)
    }
  });
}



function openChat(id,name) {
  console.log("open chat for id :",id)
  document.getElementById("myChat").style.display = "block";
  document.getElementById("chat-name").innerHTML = name;

}

function closeChat() {
  document.getElementById("myChat").style.display = "none";
}
