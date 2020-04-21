<?php
session_start();

// déconnection du compte utilisateurs côté php
try {
	$id = $_SESSION['id'];

	session_destroy();
	header('Location: /?logout=auto&id='.$id);
	exit();

} catch (Exception $e) {
	/*si catch, c que session['id'] n'existe pas*/
	echo $e;
	exit();
}
session_destroy();
header('Location: /');

?>