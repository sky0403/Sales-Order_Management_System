<!doctype html>
<?php
if(!isset($_COOKIE["user"])){
	header("Location: ../home.html");
}else{
?>
<html>
  <head>
    <title>Item Information</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="../css/style.css">
	
	<!--Navigation Bar-->
    <link rel="stylesheet" href="../css/navbar.css">

	<script>
	function openNav() {
	  document.getElementById("mySidenav").style.width = "250px";
	}

	function closeNav() {
	  document.getElementById("mySidenav").style.width = "0";
	}
	
	function confirmUpdate(){
		var itemid = document.getElementById("ItemID").value;
		var itemName = document.getElementById("ItemName").value;
		var qty = document.getElementById("StockQty").value;
		var price = document.getElementById("Price").value;
		var desc = document.getElementById("itemdesc").value;
		if(confirm('Are you sure you want to update product (item ID:' + itemid + ') information?')){
			
			location.href="UpdateProduct.php?tfItemID=" + itemid + "&tfStockQty=" + qty + "&tfPrice=" + price + "&tfItemName=" + itemName + "&tfItemDescription=" + desc;
		}else{
			alert("Please confirm your product information");
		}
	}
	function cancelUpdate(){
		var itemid = document.getElementById("ItemID").value;
		if(confirm('Are you sure you want to cancel update product information?')){
			location.href="ViewProduct.php";
		}else{
			location.href="ItemInformation.php?itemid=" + itemid;
		}
	}
	</script>
  </head>
  <body>
  
	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="ViewProduct.php">Product List</a>
		<a href="MonthlyReport.php">Monthly Report</a>
		<a href="CustomerRecord.php">Customer Record</a>
		<a href="Logout.php">Log Out</a>
	</div>

	<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>



  <div class="content">
    
    <div class="container">
      <h2 class="mb-5" >Update Product Information</h2>
      

      <div class="table-responsive custom-table-responsive">
	  
		
		<?php
			if(isset($_GET["itemid"])){
				require("conn.php");
				$itemID = $_GET["itemid"];
				$sql = "select * from item where itemID = '$itemID' ";
				$rs = mysqli_query($conn,$sql)or die(mysqli_error($conn));
				$numrows = mysqli_num_rows($rs);
				$rc = mysqli_fetch_assoc($rs);
				$itemName = $rc["itemName"];
				$itemDesc = $rc["itemDescription"];
				$stock = $rc["stockQuantity"];
				$price = $rc["price"];
				echo "<form method='GET'>";
				echo "<fieldset>";
				echo "</br>";
				echo "<p>Item ID: <input type='text' required='required' id='ItemID' name='tfItemID' value='$itemID' disabled ='disabled' readonly='readonly' /></p>";
				echo "<p>Item Name: <input type='text' value='$itemName' id='ItemName' required='required' name='tfItemName'/></p>";
				echo "<p>Item Description:</br><textarea rows='5' id='itemdesc'cols='30'  name='tfItemDescription' >$itemDesc</textarea></p>";
				echo "<p>Stock Quantity: <input type='number' required='required'id='StockQty' value='$stock'name='tfStockQty' onKeyPress='if(this.value.length==5) return false;'/></p>";
				echo "<p>Price($): <input type='number' name='tfPrice' value='$price' required='required' id='Price' onKeyPress='if(this.value.length==5) return false;' /></p>";
				echo "<input type='button' value='Update' class='button' onclick='confirmUpdate()' />";
				echo "<input type='button' value='Cancel' class='button' onclick='cancelUpdate()' />";
				echo "</fieldset>";
				echo "</form>";
				mysqli_free_result($rs);
				mysqli_close($conn);
			}
		?>
		
      </div>


    </div>

  </div>
    

  </body>
</html>

<?php
}
?>