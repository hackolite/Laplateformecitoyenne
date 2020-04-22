<?php
if(session_status() !== PHP_SESSION_ACTIVE){
	session_start();
	echo "Start";
}

if(isset($_GET['logout'])){
	session_destroy();
	echo "\nLog out";
	header('Location: ../editeur/');
	exit();
}


if(isset($_POST['lol']) 
	&& password_verify($_POST['lol'], '$2y$10$ctzc7f9UTxqBZn/ZPkXuHutBJZsQHEVxPQjOhEaWfRGc4veB.0uBC')
	&& password_verify($_POST['mdp'], '$2y$10$J6EIV7KvkydMc3Iwor67AONjjqbWclLMun4y/Rpj1lD2GbdtaHL7W')
){

	$_SESSION['login'] = $_POST['user'];
	header('Location: ../editeur/');
}else{
	session_destroy();
	header('Location: ../editeur/');
}

?>
