<?php 
 $hostname = "127.0.0.1:3307";
 $database = "projectdb";
 $username = "root";
 $password = "";
 $conn = mysqli_connect($hostname, $username, $password, $database)
				or die(mysqli_connect_error);
?>