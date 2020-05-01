<?php
	session_start();
	session_destroy();
	setcookie("username",'');
	setcookie("password",'');
	header("location:home.php");
?>