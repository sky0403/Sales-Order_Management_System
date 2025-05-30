<?php
	session_start();
	
	session_destroy();
	header("Location: ViewOrder.php");
?>