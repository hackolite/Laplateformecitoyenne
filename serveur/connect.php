<?php

session_start();

$list_requis = ['id', 'username', 'email', 'postal'];


for($i=0; $i < sizeof($list_requis); $i++) { 
	$param = $list_requis[$i];
	if(!isset($_POST[$param]) || $_POST[$param] == ""){
		session_destroy();
		echo 'disconnect';
		exit();
	}

	$_SESSION[$param] = $_POST[$param]; // on créer la session

}

$_SESSION['session'] = 'true';
$_SESSION['start_time'] = time();

echo 'connect';