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



function test() {
  const url ="http://0.0.0.0:5000/addmarker"

  var data = {name:"john", description:"100"};

  $post(url, data).then(function(response){
    if(response.data){
      console.log("success");
    } else {
      console.log("failure");
    }
  });
}



function testGet()
{
    const url ="http://0.0.0.0:5000/user_need?type=maker"

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", url, false ); // false for synchronous request
    xmlHttp.send( null );
    console.log(xmlHttp.responseText);
    return xmlHttp.responseText;
}



function testDelete()
{
    const url ="http://0.0.0.0:5000/delete_user?email=member@example.com"

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", url, false ); // false for synchronous request
    xmlHttp.send( null );
    // console.log(xmlHttp.responseText);
    return xmlHttp.responseText;
}