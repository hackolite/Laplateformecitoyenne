<?php
$url_param_list = [];
$url_param = "";
foreach ($_GET as $name => $value) {
	if($name != "lang"){
		array_push($url_param_list, $name . "=" . $value);
	}
}

for($i=0; $i < sizeof($url_param_list); $i++) { 
	if($i != 0){
		$url_param = $url_param."&";
	}else if($i == 0){
		$url_param = $url_param."?";
	}

	$url_param = $url_param . $url_param_list[$i];
}

?>
<header>
	<div id="logo">
		<a href="/">
			<img src="img/small_logo.png" >
			<span>La Platforme Citoyenne</span>
		</a>
		<p id="lang">
			<a href="<?php 
			
			if(strlen($url_param) > 0){
				echo $url_param.'&';
			}else{
				echo '?';
			}
			
			?>lang=fr">FR</a>
			<a href="<?php 
			
			if(strlen($url_param) > 0){
				echo $url_param.'&';
			}else{
				echo '?';
			}
			
			?>lang=en">EN</a>
		</p>
	</div>
	<div id="bouton">
		<ul>
			<?php

				// on affiche le compte utilisateur
				if(isset($_SESSION['session']) && $_SESSION['session'] == 'true'):
			?>
			<li class="btt_submit fill signin red" data-click="account"><?php echo search("connecté"); ?></li>
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
				echo "?page=about&lang=".$l['list_lang'][$l['lang']];?>'><?php echo search("about"); ?></a></li>
			<li class="btt"><a class="btt" href='<?php
				echo "?page=team&lang=".$l['list_lang'][$l['lang']];?>'><?php echo search("team"); ?></a></li>
			<li class="btt"><a class="btt" href=''><?php echo search("files"); ?></a></li>
		</ul>
	</div>
</header>

<div class="white_space"></div>