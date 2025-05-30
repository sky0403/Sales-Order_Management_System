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
	<script src="../js/navBar.js">
	</script>
	<script>
	function confirmDelete(){
		if(confirm("Are you sure you want to delete this customer relative record?")){
			
		}else{
			alert("You dont have delete record");
		}
	}
	</script>

    <title>Customer Record</title>

  </head>
  <body>
  <?php
	if(isset($_GET["customeremail"])){
		$email = $_GET["customeremail"];
		require("conn.php");
		$sql2 = "select customerName from customer where customerEmail = '$email'";
		$rs2 = mysqli_query($conn,$sql2) or die(mysqli_error($conn));
		$rc2 = mysqli_fetch_assoc($rs2)
	
  ?>
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
	<h2 class="mb-5"><?php echo $rc2["customerName"] ?></h2>
      

      <div class="table-responsive custom-table-responsive">
		<form method="post" action="DeleteCustomerRecords.php">
		<input type="hidden" name="hdCustomerName" <?php echo "value='{$rc2["customerName"]}'" ?>>
		<input type="hidden" name="hdCustomerEmail" <?php echo "value='$email'" ?> value=>
        <table class="table custom-table">
		<?php
			 $sql = "select * from orders where customerEmail = '$email'";
			 $rs = mysqli_query($conn,$sql) or die(mysqli_error($conn));
			 echo "<thead>";
			 echo "<tr>";
			 echo "<th scope='col'>Order ID</th>";
			 echo "<th scope='col'>Order Date</th>";
			 echo "<th scope='col'>Total Price</th>";
			 echo "</tr>";
			 echo "</thead>";
			 
			 echo "<tbody>";
			 while($rc = mysqli_fetch_assoc($rs)){
				 echo "<tr scope = 'row'> ";
				 echo "<td>" . $rc["orderID"] . "</td>";
				 echo "<td>" . $rc["dateTime"] . "</td>";
				 echo "<td>" . $rc["totalPrice"] . "</td>";
				 echo "</tr>";
				 echo "<tr class='spacer'><td colspan='100'></td></tr>";
			 }
			 echo "</tbody>";
			 mysqli_free_result($rs); 
			 mysqli_close($conn);
	}
		?>
        </table>
		<input type="submit" value="Delete Customer Record"class="button1"onclick="return confirm('Are you sure you want to delete this customer relative records?')" name="delete"/>
		</form>
      </div>


    </div>

  </div>
    

  </body>
</html>
<?php
}
?>