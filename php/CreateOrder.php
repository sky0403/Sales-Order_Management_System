<!doctype html>
<?php
session_start();
if(!isset($_COOKIE['user'])){
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
	<script src="../js/navBar.js">
	</script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script>
	function confirmdata(id){
		//var orderid = document.getElementById("OrderID").value;
		//var email = document.getElementById("CusEmail").value;
		//var domain = document.getElementById("domain").value;
		//var phone = document.getElementById("CustPhone").value;
		//var staffid = document.getElementById("StaffID").value;
		//var orderdate = document.getElementById("OrderDate").value;
		//var address = document.getElementById("dAddress").value;
		//var deliverydate = document.getElementById("dDate").value;
		//alert(orderid + email + domain + phone + staffid + orderdate + address + deliverydate);
		var orderid = document.getElementById("OrderID").value;
		var customeremail = document.getElementById("CusEmail").value;
		var customername = document.getElementById("CustName").value;
		var customerphone = document.getElementById("CustPhone").value;
		if(customeremail == "" || customername == "" || customerphone == ""){
			alert("Please fill in * field");
		}else{
			var phoneno = /^[0-9]{8}$/;
			if(customerphone.match(phoneno)){
				document.forms[0].hditemID.value = id;
				document.forms[0].submit();
				alert("You added (item id: " + id + " in to cart)");
			}else{
				alert("Phone number should be 8 digit");
			}
		}
		//location.href="AddProduct.php?orderid=" + orderid + "&itemid=" + itemid + "&qty=" + qty;
	}
	function deletefromcart(id){
		location.href = "DeleteFromCart.php?itemid=" + id;
	}
	function cancelorder(){
		if(confirm("Do you want to cancel create order?")){
			location.href="CancelCreateOrder.php";
		}else{
			
		}
	}
	function createorder(id){
		var orderid = document.getElementById("OrderID").value;
		if(confirm("Do you want to create order(order id: " + orderid + ") ?")){
			location.href="addOrder2.php?orderid=" + orderid;
		}else{
			alert("Please confirm your order information");
		}
	}
	
	/*function getDiscount(){
		$(document).read(function(){
			var price = document.getElementById("total").value;
			var sURL = 'http://localhost:1234/api/' + price;
			$.ajax({
				type:'GET',
				url:sURL,
				dataType:'json',
				success:function(result){
					return alert(result);
				},
				error:function(err){
					console.log(err);
				}
			});
		});
	}*/
	function getDiscount(){
		var price = document.getElementById("total").value;
		$.get(
			'http://localhost:1234/api/' + price,
			function(NewtotalPrice){
				return document.order.discount.value = NewtotalPrice;
			}
		)
	}
	</script>
	
    <title>Create Order</title>

  </head>
  <body>
  <div class="content">
    <div class="container">
      <h2 class="mb-5">Please fill in the form</h2>
      
      <div class="table-responsive custom-table-responsive">
	  
		<form method="POST"  action="AddProduct.php" name="order">
		<input type="hidden" name="hditemID">
		<fieldset>
		
		</br>
		
		<?php
		if(!isset($_SESSION["orderid"])){
			require("conn.php");
			$sql = "select max(orderID) as orderID from orders";
			$rs = mysqli_query($conn,$sql) or die (mysqli_error($conn));
			$rc = mysqli_fetch_assoc($rs);
			$orderID = $rc["orderID"];
			mysqli_free_result($rs);
			mysqli_close($conn);
			$orderID++;
			date_default_timezone_set('Asia/Hong_Kong');
			$date = date('Y-m-d h:i:s');
		?>
		
        <p>Order ID: <input type="text" readonly="readonly" required="required" name="tfOrderID" value="<?=$orderID?>" id="OrderID" style="background-color:#808080;"/></p>
		
		<p>*Customer's Email: <input type="text" required="required" name="tfCusEmail" id="CusEmail"/>  <select name="domain" id="domain"><option value="@gmail.com">@gmail.com</option><option value="@hotmail.com">@hotmail.com</option><option value="@yahoo.com">@yahoo.com</option></select></p>
		
		<p>*Customer's Name: <input type="text" required="required" name="tfCustName" id="CustName"></p>
		
		<p>*Customer's Phone Number: <input type="tel" pattern="^[0-9]{8}" title="8 digit" required="required" name="tfCustPhone" id="CustPhone"></p>
		
		<p>Staff ID: <input type="text" name="tfStaffID" id="StaffID"value="<?=$_COOKIE["user"]?>" readonly="readonly" style="background-color:#808080;"></p>
		
		<p>Order Date & Time: <input type="datetime" id="OrderDate" required="required" name="tforderDNT"  value="<?php echo $date?>" readonly="readonly"  style="background-color:#808080;"/></p>
		
		<p>Delivery Address: </br><textarea rows="5" cols="25" name="tfdAddress" id="dAddress" min="<?php echo $date?>"></textarea></br></br>
		
		<p>Delivery Date: <input type="date" name="tfdDate" id="dDate" min="<?=date('Y-m-d');?>"/></p>
		
		<h2>Product List:</h2>
		<div class="table-responsive custom-table-responsive">
		<table class="table custom-table">
			<tr>
				<th scope="col">Item ID</th>
				<th scope="col">Item name</th>
				<th scope="col">Item Description</th>
				<th scope="col">Quantity</th>
				<th scope="col">Price($)</th>
				<th></th>
				<th></th>

			</tr>
			<?php
				require("conn.php");
				$sql = "SELECT * FROM item where stockQuantity>0 order by itemID asc";
				$rs = mysqli_query($conn, $sql) or die (mysqli_error($conn));
				while ($rc = mysqli_fetch_assoc($rs)){
					echo "<tr>";
					echo "<td>" . $rc["itemID"] . "</td>";
					echo "<td>" . $rc["itemName"] . "</td>";
					echo "<td>" . $rc["itemDescription"] . "</td>";
					echo "<td>" . $rc["stockQuantity"] . "</td>";
					echo "<td>" . $rc["price"] . "</td>";
					echo "<td><input type='number' name='qty".$rc["itemID"] ."' value='1' onkeydown='if(event.key===\".\"){event.preventDefault();}' oninput='event.target.value=event.target.value.replace(/[^0-9]*/g,\"\");' min='1' max = '" .$rc["stockQuantity"]. "'/></td>";
					echo "<td><input type='button' value='Add' onclick='confirmdata({$rc["itemID"]})' class='button'/></td>";
					echo "</tr>";
					echo "<tr class='spacer'><td colspan='100'></td></tr>";
				}
				mysqli_free_result($rs);
				mysqli_close($conn);
			?>

		</table>
		</div>
		</br>
		<input type="button" value="Submit" class="button"/>
		<input type="button" value="Cancel" onclick="cancelorder()" class="button"/>
		</br>
		<?php
		}else{
		?>
		<p>Order ID: <input type="text" readonly="readonly" required="required" name="tfOrderID" value="<?=$_SESSION["orderid"]?>" id="OrderID" style="background-color:#808080;"/></p>
		
		<p>*Customer's Email: <input type="text" required="required" name="tfCusEmail" value="<?=$_SESSION["email"]?>" id="CusEmail"/>  <select name="domain" id="domain"></option><option value="@gmail.com" <?php if($_SESSION["domain"] == "@gmail.com" ){echo "selected";}else{echo "";}?>>@gmail.com</option><option value="@hotmail.com" <?php if($_SESSION["domain"] == "@hotmail.com" ){echo "selected";}else{echo "";}?>>@hotmail.com</option><option value="@yahoo.com" <?php if($_SESSION["domain"] == "@yahoo.com" ){echo "selected";}else{echo "";}?>>@yahoo.com</option></select></p>
		
		<p>*Customer's Name: <input type="text" required="required" name="tfCustName" id="CustName" value="<?=$_SESSION["customername"]?>"></p>
		
		<p>*Customer's Phone Number: <input type="tel" pattern="^[0-9]{8}" title="8 digit" required="required" name="tfCustPhone" value="<?=$_SESSION["customerphone"]?>" id="CustPhone"></p>
		
		<p>Staff ID: <input type="text" name="tfStaffID" value="<?=$_COOKIE["user"]?>" readonly="readonly" style="background-color:#808080;"></p>
		
		<p>Order Date & Time: <input type="datetime" id="OrderDate" required="required" name="tforderDNT"  value="<?=$_SESSION["orderdate"]?>" readonly="readonly"  style="background-color:#808080;"/></p>
		
		<p>Delivery Address: </br><textarea rows="5" cols="25" name="tfdAddress"><?php if(isset($_SESSION["deliveryaddress"])){ echo $_SESSION["deliveryaddress"];}else{echo "";}?></textarea></br></br>
		
		<p>Delivery Date: <input type="date" name="tfdDate" value="<?php if(isset($_SESSION["deliverydate"])){ echo $_SESSION["deliverydate"];}else{echo "";}?>" min="<?=date('Y-m-d');?>"/></p>
		
		<h2>Product List:</h2>
		<div class="table-responsive custom-table-responsive">
		<table class="table custom-table">
			<tr>
				<th scope="col">Item ID</th>
				<th scope="col">Item name</th>
				<th scope="col">Item Description</th>
				<th scope="col">Quantity</th>
				<th scope="col">Price($)</th>
				<th></th>
				<th></th>

			</tr>
			<?php
				require("conn.php");
				$sql = "SELECT * FROM item where stockQuantity>0 order by itemID asc";
				$rs = mysqli_query($conn, $sql) or die (mysqli_error($conn));
				while ($rc = mysqli_fetch_assoc($rs)){
					echo "<tr>";
					echo "<td>" . $rc["itemID"] . "</td>";
					echo "<td>" . $rc["itemName"] . "</td>";
					echo "<td>" . $rc["itemDescription"] . "</td>";
					echo "<td>" . $rc["stockQuantity"] . "</td>";
					echo "<td>" . $rc["price"] . "</td>";
					echo "<td><input type='number' name='qty".$rc["itemID"] ."'value='1' onkeydown='if(event.key===\".\"){event.preventDefault();}' oninput='event.target.value=event.target.value.replace(/[^0-9]*/g,\"\");' min='1' max = '" .$rc["stockQuantity"]. "'/></td>";
					echo "<td><input type='button' value='Add' onclick=confirmdata({$rc["itemID"]}) class='button'/></td>";
					echo "</tr>";
					echo "<tr class='spacer'><td colspan='100'></td></tr>";
				}
				mysqli_free_result($rs);
				mysqli_close($conn);
			?>

		</table>
		</div>
		</br>
		
		
		<?php
		if(isset($_SESSION["itemid"])){
		?>
		<h2>Ordered item:</h2>
		<div class="table-responsive custom-table-responsive">
		<table class="table custom-table">
			<tr>
				<th scope="col">Item ID</th>
				<th scope="col">Item name</th>
				<th scope="col">Quantity</th>
				<th scope="col">Price($)</th>
				<th></th>

			</tr>
		<?php
			for($i = 0;$i < count($_SESSION['itemid']); $i++){
				echo "<tr>";
				echo "<td>".$_SESSION["itemid"][$i]."</td>";
				echo "<td>".$_SESSION["itemname"][$i]."</td>";
				echo "<td>".$_SESSION["qty"][$i]."</td>";
				echo "<td>".$_SESSION["amount"][$i]."</td>";
				echo "<td><input type='button' value='Delete' onclick=deletefromcart({$_SESSION["itemid"][$i]}) class='button'/></td>";
				echo "</tr>";
				echo "<tr class='spacer'><td colspan='100'></td></tr>";
			}
		?>

		</table>
		</div>
		</br>
		<p>Total Price: <input type="text" name="total" id="total" value="<?=$_SESSION["OriginalPrice"]?>" readonly></p>
		
		<p><input type="button" onclick="getDiscount()" value="Get Discounted Price"></p>
		<p>Discounted Price:<input type="text" name="discount" id="discount" readonly></p>
		<input type="button" value="Submit" class="button"  onclick="createorder()"/>
		<input type="button" value="Cancel" onclick="cancelorder()" class="button"/>
		</br>
		
		<?php
		}else{
			
		}
		}
		?>
		</fieldset>
		</form>
      </div>


    </div>

  </div>
    

  </body>
</html>
<?php
}
?>