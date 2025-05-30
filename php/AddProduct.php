<?php
	session_start();
	
	if(isset($_POST["tfOrderID"])){
		$itemid = $_POST["hditemID"];
		$qty = $_POST["qty".$itemid];
		$total = 0;
		$_SESSION["orderid"] = $_POST["tfOrderID"];
		$_SESSION["email"] =  $_POST["tfCusEmail"];
		$_SESSION["customername"] = $_POST["tfCustName"];
		$_SESSION["domain"] = $_POST["domain"];
		$_SESSION["customeremail"] = $_POST["tfCusEmail"] . $_POST["domain"];
		$_SESSION["customerphone"] = $_POST["tfCustPhone"];
		$_SESSION["orderdate"] = $_POST["tforderDNT"];
		if($_POST["tfdDate"] != ""){
			$_SESSION["deliverydate"] = $_POST["tfdDate"];
			$_SESSION["deliveryaddress"] = $_POST["tfdAddress"];
		}else{
			$_SESSION["deliverydate"] = null;
			$_SESSION["deliveryaddress"] = null;
		}
		require("conn.php");
		$sql = "SELECT * FROM item where itemID = $itemid";
		$rs = mysqli_query($conn, $sql) or die (mysqli_error($conn));
		$rc = mysqli_fetch_assoc($rs);
		$itemname = $rc["itemName"];
		$price = $rc["price"];
		$amount = $price * $qty;
		if(isset($_SESSION['itemid'])){
			$key=array_search($itemid,$_SESSION['itemid']);
			if($key!==false){
				$_SESSION['itemid'][$key] = $itemid;
				$_SESSION['itemname'][$key] = $itemname;
				$_SESSION['qty'][$key] = $qty;
				$_SESSION['amount'][$key] = $amount;
				for($i = 0;$i<count($_SESSION['itemid']); $i++){
					$total += $_SESSION["amount"][$i];
				}
				$_SESSION["totalprice"] = $total;
			}else{
				array_push($_SESSION['itemid'],$itemid);
				array_push($_SESSION['itemname'],$itemname);
				array_push($_SESSION['qty'],$qty);
				array_push($_SESSION['amount'],$amount);
				for($i = 0;$i<count($_SESSION['itemid']); $i++){
					$total += $_SESSION["amount"][$i];
				}
				$_SESSION["totalprice"] = $total;
				$_SESSION["OriginalPrice"] = $total;
			}
		}else{
			$_SESSION['itemid'] = array();
			$_SESSION['itemname'] = array();
			$_SESSION['qty'] = array();
			$_SESSION['amount'] = array();
			array_push($_SESSION['itemid'],$itemid);
			array_push($_SESSION['itemname'],$itemname);
			array_push($_SESSION['qty'],$qty);
			array_push($_SESSION['amount'],$amount);
			for($i = 0;$i<count($_SESSION['itemid']); $i++){
				$total += $_SESSION["amount"][$i];
			}
			$_SESSION["totalprice"] = $total;
			$_SESSION["OriginalPrice"] = $total;
		}
		if(isset($_SESSION["totalprice"])){
			if($_SESSION["totalprice"] >= 10000){
				$_SESSION["totalprice"] = $_SESSION["totalprice"]*0.88;
			}else if($_SESSION["totalprice"] >= 5000){
				$_SESSION["totalprice"] = $_SESSION["totalprice"]*0.92;
			}else if($_SESSION["totalprice"] >=3000){
				$_SESSION["totalprice"] = $_SESSION["totalprice"]*0.97;
			}else{
				$_SESSION["totalprice"] = $_SESSION["totalprice"];
			}
		}
		
		header("Location: CreateOrder.php");
	}
?>