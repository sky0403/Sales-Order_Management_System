<?php
	if(isset($_POST["hdCustomerEmail"])){
		$email = $_POST["hdCustomerEmail"];
		require("conn.php");
		
		$sql = "select orderID from orders where customerEmail = '$email'";
		$rs = mysqli_query($conn,$sql) or die(mysqli_error($conn));
		
		while($rc = mysqli_fetch_assoc($rs)){
			$sql2 = "delete from itemorders where orderID = '{$rc["orderID"]}'";
			mysqli_query($conn,$sql2) or die(mysqli_error($conn));
		}
		
		$sql3 = "delete from orders where customerEmail = '$email'";
		mysqli_query($conn,$sql3) or die(mysqli_error($conn));
		
		$sql4 = "delete from customer where customerEmail = '$email'";
		mysqli_query($conn,$sql4) or die(mysqli_error($conn));
		
		mysqli_free_result($rs); 
		mysqli_close($conn);
		
		header("Location: CustomerRecord.php");
		echo "<script>alert('You have deleted $email relative records')</script>";
	}
?>