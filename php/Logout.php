<?php
	session_start();
	if(isset($_COOKIE["user"])){
		unset($_COOKIE["user"]); 
		setcookie("user", "", time()-3600);
	}
	session_destroy();
	header("Location: ../home.html");
?>