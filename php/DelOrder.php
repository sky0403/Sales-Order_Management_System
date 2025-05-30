<?php
	if (isset($_POST["hdOrderID"])){
		$orderID = $_POST["hdOrderID"];
		require("conn.php");
		$sql = "DELETE FROM itemorders WHERE orderID = '$orderID'";
		mysqli_query($conn, $sql) or die (mysqli_error($conn));
		
		$sql2 = "DELETE FROM orders WHERE orderID = '$orderID'";
		mysqli_query($conn, $sql2) or die (mysqli_error($conn));

		$rows = mysqli_affected_rows($conn);
		
		
		if ($rows > 0){
			header("Location: ViewOrder.php");
		}
	}
?>