<?php
	if(isset($_GET["tfItemID"])){
		$itemID = $_GET["tfItemID"];
		$itemName = $_GET["tfItemName"];
		$desc = $_GET["tfItemDescription"];
		$stock = $_GET["tfStockQty"];
		$price = $_GET["tfPrice"];
		
		require("conn.php");
		
		$sql = "update item set itemName = '$itemName',stockQuantity = '$stock', price = '$price',itemDescription = '$desc' where itemID = '$itemID'";
		mysqli_query($conn, $sql) or die(mysqli_error($conn));
		
		$rows = mysqli_affected_rows($conn);
		
		if($rows > 0){
			echo "<script>alert('You updated (item id: $itemID) information');";
			echo "window.location.href = 'ViewProduct.php';";
			echo "</script>";
		}else{
			echo "<script>alert('Please confirm your product information');";
			echo "window.location.href = 'ItemInformation.php?itemid=$itemID';";
			echo "</script>";
		}
	}
?>