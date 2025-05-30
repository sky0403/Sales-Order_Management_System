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
	<script src="../js/navBar.js">
	</script>
	
    <title>Add new Product</title>

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
      <h2 class="mb-5">Fill in the product information</h2>
      

      <div class="table-responsive custom-table-responsive">
	  <?php
		if(isset($_POST["tfItemName"])){
			
			require("conn.php");
			$itemname = $_POST["tfItemName"];
			$itemid = $_POST["tfitemid"];
			$itemdesc = $_POST["tfItemDescription"];
			$stock = $_POST["tfStockQty"];
			$price = $_POST["tfPrice"];
			$sql = "select * from item where itemID = '$itemid'";
			
			$rs = mysqli_query($conn,$sql)
					or die(mysqli_error($conn));
			$numrows = mysqli_num_rows($rs);
			
			if ($numrows > 0){
				//Exist
				echo "<script> alert('Record Already Exist')</script>";
			}else{
				//Not Exist
				$sql2 = "INSERT INTO item values('$itemid', 
													  '$itemname', 
													  '$itemdesc', 
													  '$stock',
													  '$price'
													  )";
				mysqli_query($conn, $sql2)
						or die(mysqli_error($conn));
						
				$rows = mysqli_affected_rows($conn);
				
				if($rows > 0){
					echo "<script>alert('You have added new item!')</script>";
					header("Location: ViewProduct.php");
				}
						
			}
		}else{
			require("conn.php");
			$sql3 = "select MAX(itemID) as maxid from item";
			$rs = mysqli_query($conn,$sql3) or die(mysqli_error($conn));
			$rc = mysqli_fetch_assoc($rs);
			$maxid = $rc["maxid"];
			$newid = $maxid + 1;
	  ?>
		<form method="post" action="InsertItem.php">	
		<fieldset>
		</br>
        <p>Item ID: <input type="text" required="required"name="tfitemid" <?php echo "value='$newid'" ?> readonly="readonly" style="background-color:#808080;"/></p>
		<p>Item Name: <input type="text" required="required" name="tfItemName" id="ItemName" value=""/></p>
		<p>Item Description:</br><textarea rows="5" cols="30" name="tfItemDescription"  ></textarea></p>
		<p>Stock Quantity: <input type="number" required="required" name="tfStockQty" id="StockQty" value="" onKeyPress="if(this.value.length==5) return false;" min="0"max="99999"/></p>
		<p>Price($): <input type="number" name="tfPrice" required="required" id="Price" onKeyPress="if(this.value.length==6) return false;" min="0"max="999999"></p>
		<input type="submit" value="Insert" class="button"  name="insert" onclick="return confirm('Are you sure you want to add new product?')"/>
		<input type="reset" value="Clear" class="button"/>
		
		</br>
		</fieldset>
		</form>
		<?php
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