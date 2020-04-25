<?php
$url_param_list = [];
$url_param = "";
foreach ($_GET as $name => $value) {
	if($name != "lang"){
		//array_push($url_param_list, $name . "=" . $value);
		array_push($url_param_list,$value);
	}
}

for($i=0; $i < sizeof($url_param_list); $i++) { 
	/*if($i != 0){
		$url_param = $url_param."&";
	}else if($i == 0){
		$url_param = $url_param."?";
	}*/

	$url_param = /*$url_param*/'/'.$url_param_list[$i];
}

?>
<header>
	<div id="logo">
		<a href="/<?php echo $l['list_lang'][$l['lang']];?>">
			<img src="img/_logo<?php echo $version["logo.png"]; ?>.png" >
			<div id="title">
				<div class="first s-container share">
					<h1><span>l</span><span>a</span><span></span> <span>p</span></h1>
				</div>
				<div class="second s-container share">
					<h1><span>l</span><span>a</span><span>t</span><span>e</span><span>f</span><span>o</span><span>r</span><span>m</span><span>e</span></h1>
				</div>
				<div class=" third s-container share">
					<h1><span></span> <span>c</span><span>i</span><span>t</span><span>o</span><span>y</span><span>e</span><span>n</span><span>n</span><span>e</span></h1>
				</div>
			</div>
		</a>
		<div id="lang">
			<a href="<?php 

			// on met en surbrillance la langue sélectionnée
			if($l['get_lang'] == 'en'){
				$classLang = ["", "on"];
			}else{
				$classLang = ["on", ""];
			}

			// lors d'un changement de langue, on garde les autres paramètres GET
			/*if(strlen($url_param) > 0){
				echo $url_param.'&';
			}else{
				echo '?';
			}*/
			// avec la réécriture htaccess, on a plus besoin de passer les paramètres GET mais directements dans l'url
			echo 'fr'.$url_param;
			?>" class="<?php echo $classLang[0]; ?>">FR</a>
			<a href="<?php 
			
			/*if(strlen($url_param) > 0){
				echo $url_param.'&';
			}else{
				echo '?';
			}*/
			echo 'en'.$url_param;
			?>" class="<?php echo $classLang[1]; ?>">EN</a>
		</div>
	</div>
	<div id="bouton">
		<ul>
			<?php

				// on affiche le compte utilisateur
				if(isset($_SESSION['session']) && $_SESSION['session'] == 'true'):
			?>
			<li class="btt_submit fill account red" data-click="account"><?php echo search("mon compte"); ?></li>
			<?php
				// on affiche les boutons inscriptions et connexions si aucun compte n'est logger
				else:
			?>
			<li class="btt_submit empty signup green" data-click="signup"><?php echo search("inscription"); ?></li>
			<li class="btt_submit empty signin black" data-click="signin"><?php echo search("connexion"); ?></li>
			<?php
				endif;
			?>
			<li class="btt"><a class="btt" href='<?php
				echo $l['list_lang'][$l['lang']]."/about";?>'><?php echo search("about"); ?></a></li>
			<li class="btt"><a class="btt" href='<?php
				echo $l['list_lang'][$l['lang']]."/team";?>'><?php echo search("team"); ?></a></li>
			<li class="btt"><a class="btt" href=''><?php echo search("files"); ?></a></li>
		</ul>
	</div>
</header>

<div class="white_space"></div>

<div id="_box" class="off red">
	<div class="close_btt" data-click='box'>+</div>
	<p class='mssg'>Une erreur s'est produite lors de la tentative de connexion</p>
	
</div>