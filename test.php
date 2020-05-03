<?php

session_start();

// faux compte php login

$_SESSION["id"]= "42";
$_SESSION["username"]= "Cécile Bot";
$_SESSION["email"]= "cecile@robot.no";
$_SESSION["postal"]= "75001";
$_SESSION["session"]= "true";
$_SESSION["token"]=bin2hex(random_bytes(5));
$_SESSION["start_time"] = time();

// controller JS ligne 360
// #TEST à SUPPRIMER
/*var rep = {
	"id": "jrg42erg",
	"username": "Cécile",
	"email": "cecile@gmail.com",
	"postal": "75001",
	"statuscode": "200"
};
f.page.form[form](rep);
return;*/

echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];