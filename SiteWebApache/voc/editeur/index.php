<?php
session_start();

if(!isset($_SESSION['login']) || $_SESSION['login'] != 'admin'):
?>

<form method="POST" action="login.php" require>
<input type="text" placeholder="username" name="user"  require>
<input type="password" placeholder="password" name="mdp" require>
<input type="hidden" name='lol' value='form'>
<input type="submit" value="Submit">

</form>



<?php
else:

	if(!isset($_POST['url'])){
		$_POST['url'] = '/';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="hlight/styles/monokai-sublime.css">
	<script src="hlight/script.js"></script>
</head>
<body>


	<nav>
		<a href='#' onclick="search_url();"><img alt='Back' src='back.png'></a>
		<a href='#' onclick="search_url('/');"><img alt='Racine' src='up.png' ></a>
		<form method="POST" action='' id='main_form'>
			<input type='text' id='url' name='url' value='<?php echo $_POST['url']; ?>'>
			<label>
				<img alt='search' src='search.png'>
				<input type="submit" value="" onclick="load(); return false;" class='nav_btt'>
			</label>
		</form>
		<a href='#' onclick='save();'><img alt='Save' src='save.png'> </a>
		<a href='#' onclick='dissocier();'><img alt='dissocier' src='dissocier.png'> </a>
		<a href='login.php?logout=o'><img alt='Déconnexion' src='disconnect.png'> </a>
	</nav>

	<div class="progress"></div>

	<div id='container'>
		<?php 
			include('file.php');
		?>
	</div>

	<div id="editeur" class='associer'>
		<div id="code"></div>
		<textarea id="edition"></textarea>
	</div>

<script>
function q(elmt){
	return document.querySelector(elmt);
}
function AJAX (e){
	/*
		e = {
			location, type, ready, settings, responseText
		}

	*/
	var xhr = new XMLHttpRequest();

	if(e.type == "GET"){
		e.location += "?" + e.settings;
	}

	xhr.open(e.type, e.location);
	
	if(e.type=="POST"){
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	}

	xhr.onreadystatechange = function(){

		progress.style.width = (xhr.readyState/4*100) + '%';

		if(xhr.status == 200 && xhr.readyState == 4){
			if(e.responseText == true){
				e.ready(xhr.responseText);
			}else{
				e.ready(xhr.response);
			}
			setTimeout(function(){
				progress.style.width = '0%';
			}, 1000);

			//console.log(xhr.responseText);
		}
	};

	if(e.type == "GET"){
		xhr.send(null);
	}
	else{
		xhr.send(e.settings);
	}
	progress.style.width = "10%";
	
}


var edition = q('#edition');
var code = q('#code');

var regexp_file = /^(.+)\.(.+)$/;
var progress = q('.progress');

edition.addEventListener('keypress', editCode);
edition.addEventListener('keyup', editCode);
edition.addEventListener('change', editCode);

function load(){
	let v = q('#url').value;
	let c = q('#container');
	AJAX({
		location: 'file.php',
		type: 'POST',
		settings: 'url=' + v,
		ready: function(rep){
			if(regexp_file.test(v)){
				// si c'est un fichier
				edition.value = rep;
				editCode();
				applyColor();
				resizeEdit();
			}else{
				c.innerHTML = rep;	
			}
		}	
	});
}

function search_url(url=null){
	let v = q('#url').value;

	if(url){
		q('#url').value = url;
	}else if(/^(.+)\/(.+)\/$/.test(v)){

		q('#url').value = RegExp.$1 + '/';
	}else if(regexp_file.test(v)){
		const rgp = /(.+)?\/(.+).(.+)/.test(v);
		q('#url').value = RegExp.$1 + '/';
	}

	load();
	return false;

}

function applyColor(){
  document.querySelectorAll('pre code').forEach((block) => {
    hljs.highlightBlock(block);
  });
}

function editCode(){
	// pour pas que le navigateur prenne en compte les balises html
	let v = edition.value.replace(/</ig, "&lt;");
	v = v.replace(/>/ig, "&gt;");

	code.innerHTML = '<pre><code>' + v + '</code></pre>';
	applyColor();
	resizeEdit();
}


function save(){
	let v = q('#url').value;
	if(!regexp_file.test(v)){
		return;
	}

	if(!confirm("Enregistrer dans: " + v + " ?")){
		return;
	}

	AJAX({
		location: 'file.php',
		type: 'POST',
		settings: 'url=' + v + "&save=" + encodeURIComponent(edition.value),
		ready: function(rep){
			alert(rep);
			console.log(encodeURIComponent(edition.value));
			//window.open(v, 'Page');
			load();
		}	
	});

}

function dissocier(){

	let editeur = q('#editeur');

	if(/associer/.test(editeur.className)){
		editeur.classList.remove('associer');
		editeur.classList.add('dissocier');
	}else{
		editeur.classList.remove('dissocier');
		editeur.classList.add('associer');
	}

}

function resizeEdit(){
	edition.style.width = getComputedStyle(q('#code'), null).width;
	edition.style.height = getComputedStyle(q('#code'), null).height;
}

</script>

<?php
endif;
?>

</body>
</html>