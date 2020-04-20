<?php

if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}

if(!isset($_SESSION['login']) || $_SESSION['login'] != 'admin'){
	exit();
}

	$regexp_fichier = "/^(.+)\.(.+)$/";
	
	if(isset($_POST['url']) && !empty($_POST['url'])){


		if(preg_match($regexp_fichier, $_POST['url'])){

			if(isset($_POST['save'])){
				// sauvegarde du fichier
				$f = fopen($_POST['url'], 'w');
				fwrite($f, $_POST['save']);

				echo "\nSauvegardé dans ".$_POST['url'];

			}else{
				// renvoie le contenu du fichier
				$f = fopen($_POST['url'], 'a+');
				$size = filesize($_POST['url']);
				if($size > 0){
					echo fread($f, filesize($_POST['url']));
				}
				
			}

			fclose($f);
			exit();
		}


		$files = scandir($_POST['url']);
	}else{
		$files = scandir('/');
	}



	for ($i=2; $i < sizeof($files); $i++):
?>
	
	<?php
		if(!preg_match($regexp_fichier, $files[$i])):
			$suffixe = '/';
	?>
		<div class='form_file folder'>
	<?php
		else:
			$suffixe = '';
	?>
		<div class='form_file file'>
	<?php 
		endif;
	?>
		<span class="png"></span>
		<input type="hidden" name='url' value='<?php echo $_POST['url'].$files[$i].'/'; ?>' >
		<input type="submit" class='btt_file' value='<?php echo $files[$i]; ?>' onclick='search_url("<?php echo $_POST['url'].$files[$i].$suffixe;?>"); return false;'>
	</div>
<?php
	endfor;
?>