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
	&& password_verify($_POST['mdp'], '$2y$10$oGPo3YYc2SncsCSWJEfzIeuyvSY8dpw8fyjm5OP.dHSMUDoPUNVv2')
){

	$_SESSION['login'] = 'admin';
	header('Location: ../editeur/');
}

?>
