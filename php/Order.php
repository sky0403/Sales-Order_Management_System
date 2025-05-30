<!doctype html>
<?php
if(!isset($_COOKIE["user"])){
	header("Location: ../home.html");
}else{
?>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="../css/style.css">
	
	<!--Navigation Bar-->
    <link rel="stylesheet" href="../css/navbar.css">
	<script src="../js/navBar.js"></script>
	
	
	<script>
	
	function confirmSubmit(){
		var orderid = document.getElementById("orderID").value;
		if(confirm('Are you sure you want to update (order id :' + orderid + ') information?')){
			alert("You have update Order ID " + orderid + " information");
		}else{
			alert("Please confirm your order information update");
		}
	}
	
		function startForm(){
			document.order.orderID.disabled = true;
			document.order.cusEmail.disabled = true;
			document.order.cusPhone.disabled = true;
			document.order.cusName.disabled = true;
			document.order.staffID.disabled = true;
			document.order.staffName.disabled = true;
			document.order.orderDNT.disabled = true;
			document.order.dAddress.disabled = true;
			document.order.dDate.disabled = true;
		}
		
		function updateAll(){
			document.order.orderID.disabled = false;
			document.order.cusEmail.disabled = false;
			document.order.cusPhone.disabled = false;
			document.order.cusName.disabled = false;
			document.order.staffID.disabled = false;
			document.order.staffName.disabled = false;
			document.order.orderDNT.disabled = false;
			document.order.dAddress.disabled = false;
			document.order.dDate.disabled = false;
		}
		
		function updateDelivery(){
			document.order.orderID.disabled = false;
			document.order.cusEmail.disabled = true;
			document.order.cusPhone.disabled = true;
			document.order.cusName.disabled = true;
			document.order.staffID.disabled = true;
			document.order.staffName.disabled = true;
			document.order.orderDNT.disabled = true;
			document.order.dAddress.disabled = false;
			document.order.dDate.disabled = false;
		}
	</script>
	

    <title>View Product</title>

  </head>
  <body onload="startForm()">
  
	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="CreateOrder.php">Create Order</a>
		<a href="ViewOrder.php">Order List</a>
		<a href="Logout.php">Log Out</a>
	</div>

	<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>

  <div class="content">
    
    <div class="container">
	
      <!--<h2 class="mb-5">Please fill in the form</h2>-->
      
      <div class="table-responsive custom-table-responsive" >
	  
		<form method="post" action="UpdateOrder.php" name="order">
		<fieldset>
		
		</br>
		<?php
			if(isset($_GET["orderID"])){
			require("conn.php");
			$orderid = $_GET["orderID"];
			$sql3 = "select * from orders where orderID = '$orderid'";
			$rs3 = mysqli_query($conn, $sql3) or die (mysqli_error($conn));
			$rc3 = mysqli_fetch_assoc($rs3);
			$sql4 = "select * from customer where customerEmail = '{$rc3["customerEmail"]}'";
			$rs4 = mysqli_query($conn,$sql4) or die(mysqli_error($conn));
			$rc4 = mysqli_fetch_assoc($rs4);
			$sql5 = "select * from staff where staffID = '{$rc3["staffID"]}'";
			$rs5 = mysqli_query($conn,$sql5) or die(mysqli_error($conn));
			$rc5 = mysqli_fetch_assoc($rs5);
			$totalprice = $rc3["totalPrice"];
			date_default_timezone_set('Asia/Hong_Kong');
		?>
        <p>Order ID: <input type="text" id="orderID" required="required" name="orderID" value=<?=$orderid?> readonly="readonly" style="background-color:#808080;"></p>
		
		<p>Customer's Email: <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.com$" title="include '.com' at the last" required="required" name="cusEmail" value=<?=$rc3["customerEmail"]?>></p>
		
		<p>Customer's Name: <input type="text" required="required" name="cusName" value="<?=$rc4["customerName"]?>"></p>
		
		<p>Customer's Phone Number: <input type="tel" pattern="^(852-)[0-9]{8}" title="852-xxxxxxxx" required="required" name="cusPhone" value="<?=$rc4["phoneNumber"]?>"></p>
		
		<p>Staff ID: <input type="text" pattern="^[S][0-9]{5}" title="Capital S with 5 digit" required="required" name="staffID" value="<?=$rc3["staffID"]?>"></p>
		
		<p>Staff Name: <input type="text" required="required" name="staffName" value="<?=$rc5["staffName"]?>" ></p>
		
		<p>Order Date & Time: <input type="datetime" required="required" name="orderDNT" value="<?=$rc3["dateTime"]?>"/></p>
		
		<p>Delivery Address: </br><textarea rows="5" cols="25" name="dAddress" required="required" name="DeliveryAddress"/><?php echo $rc3["deliveryAddress"]?></textarea></p>
		
		<p>Delivery Date: <input type="date" required="required" name="dDate" value="<?=$rc3["deliveryDate"]?>" min="<?=date('Y-m-d');?>" ></p>
		<h2>Ordered Item List</h2>
		<div class="table-responsive custom-table-responsive">
		<table class="table custom-table">
			<tr>
				<th scope="col">Item ID</th>
				<th scope="col">Item name</th>
				<th scope="col">Quantity</th>
				<th scope="col">Amount</th>

			</tr>
			<?php
				$sql = "SELECT * FROM itemorders where orderID = '$orderid' ORDER BY itemID ASC";
				$rs = mysqli_query($conn, $sql) or die (mysqli_error($conn));
				while ($rc = mysqli_fetch_assoc($rs)){
					$sql2 = "SELECT * FROM item where itemID = '{$rc["itemID"]}'";
					$rs2 = mysqli_query($conn, $sql2) or die (mysqli_error($conn));
					$rc2 = mysqli_fetch_assoc($rs2);
					echo "<tr>";
					echo "<td>" . $rc["itemID"] . "</td>";
					echo "<td>" . $rc2["itemName"] . "</td>";
					echo "<td>" . $rc["orderQuantity"] . "</td>";
					echo "<td>" . $rc["price"] . "</td>";
					echo "</tr>";
					echo "<tr class='spacer'><td colspan='100'></td></tr>";
				}
				
				
				
				mysqli_free_result($rs);
				mysqli_free_result($rs2);
				mysqli_free_result($rs3);
				mysqli_free_result($rs4);
				mysqli_free_result($rs5);
				mysqli_close($conn);
			}
			?>
			
		</table>
		</div>
		</br>
		<p>Total Price: <input type="text" name="total" value="<?=$totalprice?>" readonly="readonly" disabled="true"></p>

		<input type="submit" value="Submit" class="button" name="Submit" onclick="return confirm('Are you sure you want to update this order information?');"/>
		<input type="button" value="Update delivery" class="button2" onclick="updateDelivery();"/>
		</br>
		</fieldset>
		</form>
		
    </div>
  </div>
    

  </body>
</html>
<?php
}
?>