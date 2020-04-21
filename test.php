<?php

session_start();

// faux compte php login

$_SESSION["id"]= "jrg42erg";
$_SESSION["username"]= "Cécile";
$_SESSION["email"]= "cecile@gmail.com";
$_SESSION["postal"]= "75001";
$_SESSION["session"]= "true";
$_SESSION["start_time"] = time();