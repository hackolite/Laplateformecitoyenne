<?php

if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
}
preg_match("/admin|lpc/", $_SESSION['login'], $valid);
if(!isset($_SESSION['login']) || !$valid){
	exit();
}

	$regexp_fichier = "/^(.+)\.(.+)$/";
	
	if(isset($_POST['url']) && !empty($_POST['url'])){

		preg_match("/editeur|font|js|img|serveur/", $_POST['url'], $valid);

		// restriction d'usage des fichiers sensibles si non admin
		if(!password_verify($_SESSION['login'], '$2y$10$qWqpCe1r8quDzCM14I6nEuLK1zmkw.bGURin6geum6L.IuPNvggbO')
			&& !empty($valid)
		){
			exit("<p style='color:red;'>Vous n'êtes pas autoriser à ouvrir ce contenu.</p>");
		}


		if(!file_exists($_POST['url'])){
			echo "<p style='color:red;'>Il semble que le contenu rechercher n'existe pas.</p>";
		}

		if(preg_match($regexp_fichier, $_POST['url'])){ 
		// si c'est un url de fichier

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