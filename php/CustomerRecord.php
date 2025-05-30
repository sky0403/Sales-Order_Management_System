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
	function customerDetail(email){
		location.href="CustomerDetail.php?customeremail=" + email;
	}
	</script>

    <title>Customer Record</title>

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
      <h2 class="mb-5">Customer relative order</h2>
      

      <div class="table-responsive custom-table-responsive">
		<form method="post">
		<input type="hidden" name="hdcustomerEmail">
        <table class="table custom-table">
		<?php
			 require("conn.php");
			 $sql = "select * from customer";
			 $rs = mysqli_query($conn,$sql) or die(mysqli_error($conn));
			 echo "<thead>";
			 echo "<tr>";
			 echo "<th scope='col'>Customer Name</th>";
			 echo "<th scope='col'>Customer Email</th>";
			 echo "<th scope='col'>Phone Number</th>";
			 echo "<th scope='col'>Order Count</th>";
			 echo "</tr>";
			 echo "</thead>";
			 
			 echo "<tbody>";
			 while($rc = mysqli_fetch_assoc($rs)){
				 $sql2 = "select count(*) as ordernumber from orders where customerEmail = '{$rc["customerEmail"]}'";
				 $rs2 = mysqli_query($conn,$sql2) or die(mysqli_error($conn));
				 $rc2 = mysqli_fetch_assoc($rs2);
				 echo "<tr scope = 'row'>";
				 echo "<td>" . $rc["customerName"] . "</td>";
				 echo "<td>" . $rc["customerEmail"] . "</td>";
				 echo "<td>" . $rc["phoneNumber"] . "</td>";
				 echo "<td>" . $rc2["ordernumber"] . "</td>";
				 echo "<td><input type='button' value='Customer Order Detail' onclick=customerDetail('{$rc["customerEmail"]}')  class='button1'/></td>";
				 echo "</tr>";
				 echo "<tr class='spacer'><td colspan='100'></td></tr>";
			 }
			 echo "</tbody>";
			 mysqli_free_result($rs);
			 mysqli_free_result($rs2);
			 mysqli_close($conn);
		?>
        </table>
		</form>
      </div>


    </div>

  </div>
    

  </body>
</html>
<?php
}
?>