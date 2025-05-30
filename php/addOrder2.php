<?php
	session_start();
	if(isset($_GET["orderid"])){
		require("conn.php");
		
		$sql = "select * from customer where customeremail = '{$_SESSION["customeremail"]}'";
		$rs = mysqli_query($conn, $sql) or die (mysqli_error($conn));
		$numrows = mysqli_num_rows($rs);
		if ($numrows > 0){
			
			}else{
				//Not Exist
				$sql2 = "insert into customer values('{$_SESSION["customeremail"]}','{$_SESSION["customername"]}','{$_SESSION["customerphone"]}')";
		
				mysqli_query($conn, $sql2)
						or die(mysqli_error($conn));	
			}
		
		
		
		$sql = "insert into orders values('{$_SESSION["orderid"]}','{$_SESSION["customeremail"]}','{$_COOKIE["user"]}','{$_SESSION["orderdate"]}','{$_SESSION["deliveryaddress"]}','{$_SESSION["deliverydate"]}','{$_SESSION["totalprice"]}')";
		mysqli_query($conn, $sql) or die (mysqli_error($conn));
		
		for($i = 0;$i < count($_SESSION['itemid']); $i++){
			$sql = "insert into itemorders values('{$_SESSION["orderid"]}','{$_SESSION["itemid"][$i]}','{$_SESSION["qty"][$i]}','{$_SESSION["amount"][$i]}')";
			mysqli_query($conn, $sql) or die (mysqli_error($conn));
			$sql = "update item set stockQuantity = stockQuantity - {$_SESSION["qty"][$i]} where itemID = '{$_SESSION["itemid"][$i]}'";
			mysqli_query($conn, $sql) or die (mysqli_error($conn));
		}
		
		session_destroy();
		header("Location: ViewOrder.php");
	}
?>