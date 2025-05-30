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
	
	<!-- Navigation Bar -->
    <link rel="stylesheet" href="../css/navbar.css">
	<script src="../js/navBar.js"></script>
	
	<script>
	function UpdateItem(id){
		if(confirm("Are you sure you want to update this Product (item id: " +  id + ") ?")){
			document.forms[0].hditemID.value = id;
			var itemid = document.forms[0].hditemID.value
			location.href="ItemInformation.php?itemid=" + itemid;
		}
	}
	</script>
	
    <title>View Product</title>
  </head>
  <body>
  
	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="ViewProduct.php">Product List</a>
		<a href="MonthlyReport.php">Monthly Report</a>
		<a href="CustomerRecord.php">Customer Record</a>
		<a href="../Home.html">Log Out</a>
	</div>

	<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>

  <div class="content">
    
    <div class="container">
      <h2 class="mb-5">View Product</h2>
      

      <div class="table-responsive custom-table-responsive">

		<form method="post">
		<input type="hidden" name="hditemID">
        <table class="table custom-table">
		<?php
			require("conn.php");
			 $sql = "select * from item";
			 $rs = mysqli_query($conn,$sql) or die(mysqli_error($conn));
			 echo "<thead>";
			 echo "<tr>";
			 echo "<th scope='col'>Item ID</th>";
			 echo "<th scope='col'>Item Name</th>";
			 echo "<th scope='col'>Desciption</th>";
			 echo "<th scope='col'>Stock Quantity</th>";
			 echo "<th scope='col'>Unit Price($)</th>";
			 echo "</tr>";
			 echo "</thead>";
			 
			 echo "<tbody>";
			 while($rc = mysqli_fetch_assoc($rs)){
				 echo "<tr scope = 'row'> ";
				 echo "<td>" . $rc["itemID"] . "</td>";
				 echo "<td>" . $rc["itemName"] . "</td>";
				 echo "<td>" . $rc["itemDescription"] . "</td>";
				 echo "<td>" . $rc["stockQuantity"] . "</td>";
				 echo "<td>" . $rc["price"] . "</td>";
				 echo "<td><input type='button' value='Update' onclick=UpdateItem({$rc["itemID"]})  class='button1' name='update'/></td>";
				 echo "</tr>";
				 echo "<tr class='spacer'><td colspan='100'></td></tr>";
			 }
			 echo "</tbody>";
			 mysqli_free_result($rs);
			 mysqli_close($conn);
		?>
        </table>
		<input type="button" value="Add new product" class="button1" onclick="location.href='InsertItem.php'" name="insert"/>
		</form>
      </div>


    </div>

  </div>
  
    

  </body>
</html>
<?php
}
?>