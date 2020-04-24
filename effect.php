<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="effect.css">

<style>
@font-face{
	font-family: 'Avenir Condensed';
	src: url("font/avenir_next__condensed_demi.ttf");
	font-weight: normal;
}
</style>

</head>
<body>

<div class="main-container">
  <div class="first container share">
    <h1><span>l</span><span>a</span><span></span> <span>p</span></h1>
  </div>
  <div class="second container share">
    <h1><span>l</span><span>a</span><span>t</span><span>e</span><span>f</span><span>o</span><span>r</span><span>m</span><span>e</span></h1>
  </div>
<div class=" third container share">
    <h1><span></span> <span>c</span><span>i</span><span>t</span><span>o</span><span>y</span><span>e</span><span>n</span><span>n</span><span>e</span></h1>
  </div>
</div>
<script>
var t1 = "";

function convert(){
	var v = prompt("Texte: ");

	v = v.split('');


	for(var i = 0; i < v.length; i++){

		t1 += "<span>" + v[i] + "</span>";

	}

	

}

</script>
</body>
</html>