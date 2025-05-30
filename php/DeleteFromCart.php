<?php
	session_start();
	if(isset($_GET["itemid"])){
		
		$key=array_search($_GET['itemid'],$_SESSION['itemid']);
		if($key!==false){
			unset($_SESSION['itemid'][$key]);
			unset($_SESSION['itemname'][$key]);
			unset($_SESSION['qty'][$key]);
			unset($_SESSION['amount'][$key]);
			$_SESSION["itemid"] = array_values($_SESSION["itemid"]);
			$_SESSION["itemname"] = array_values($_SESSION["itemname"]);
			$_SESSION["qty"] = array_values($_SESSION["qty"]);
			$_SESSION["amount"] = array_values($_SESSION["amount"]);
		}
		for($i = 0;$i<count($_SESSION['itemid']); $i++){
				$total += $_SESSION["amount"][$i];
		}
		$_SESSION["totalprice"] = $total;
		$_SESSION["OriginalPrice"] = $total;
		
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
		//for($i = 0;$i < count($_SESSION["itemid"]); $i++){
			//if($_SESSION['itemid'][$i] == $_GET["itemid"]){
			//	unset($_SESSION['itemid'][$i]);
			//	unset($_SESSION['itemname'][$i]);
			//	unset($_SESSION['qty'][$i]);
			//	unset($_SESSION['amount'][$i]);
			//	$_SESSION["totalprice"] = $_SESSION["totalprice"] - $_SESSION['amount'][$i];
			//}
		//}
	}
?>