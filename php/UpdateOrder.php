<?php
	if(isset($_POST["orderID"])){
		$orderid = $_POST["orderID"];
		$deliverydate = $_POST["dDate"];
		$deliveryaddress = $_POST["dAddress"];
		
		require("conn.php");
		$sql = "update orders set deliveryAddress = '$deliveryaddress',deliveryDate = '$deliverydate' where orderID = '$orderid'";
		mysqli_query($conn, $sql) or die(mysqli_error($conn));
		
		$rows = mysqli_affected_rows($conn);
		
		if($rows > 0){
			echo "<script>alert('You updated (order id: $orderid) delivery information');";
			echo "window.location.href = 'ViewOrder.php';";
			echo "</script>";
		}else{
			echo "<script>alert('Please confirm your order information');";
			echo "window.location.href = 'Order.php?orderID=$orderid;";
			echo "</script>";
		}
	}
?>