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

    <link rel="stylesheet" href="../fonts/icomoon/style.css">

    <link rel="stylesheet" href="../css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="../css/style.css">
	
	<!-- Navigation Bar -->
    <link rel="stylesheet" href="../css/navbar.css">
	<script src="../js/navBar.js"></script>
	<script>
	$(function(){
		$('#datetimepicker1').datetimepicker();
	});
	
	function searchByMonth(){
		var month = document.getElementById("Searchmonth").value;
		location.href ="MonthlyReport.php?month=" + month;
	}
	</script>
    <title>Monthly Report</title>

  </head>
  <body>
  
  <div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="ViewProduct.php">Product List</a>
		<a href="MonthlyReport.php">Monthly Report</a>
		<a href="CustomerRecord.php">Customer Record</a>
		<a href="Logout.php">Log out</a>
	</div>

	<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>

  <div class="content">
    
    <div class="container">
      <h2 class="mb-5">Monthly Report</h2>
      

      <div class="table-responsive custom-table-responsive">
		<form method="post">
		<div class="searchMonthlyReport">
		 
		 </div>
          <?php
		  if(isset($_GET["month"])){
			 require("conn.php");
			 $YearMonth = $_GET["month"];
			 $sql = "select * from staff where position = 'Staff'";
			 $rs = mysqli_query($conn,$sql) or die(mysqli_error($conn));
			 echo "<input type='button' onclick='searchByMonth()' value='Search' class='button' />";
			 echo "<input type='month' name='searchMonth' id='Searchmonth' value='$YearMonth' class='button'min='2019-01' max='2030-12'/>";
			 echo "<table class='table custom-table'>";
			 echo "<thead>";
             echo "<tr>";
             echo "<th scope='col'>Staff ID</th>";
             echo "<th scope='col'>Staff Name</th>";
             echo "<th scope='col'>Number of order records</th>";
             echo "<th scope='col'>Total sales amount</th>";
             echo "</tr>";
			 echo "</thead>";
			 echo "<tbody>";
			 while($rc = mysqli_fetch_assoc($rs)){
				 $sql2 = "select count(*) as ordercount,sum(totalPrice) as totalsales from orders where staffID = '{$rc["staffID"]}' and dateTime like '%$YearMonth%'";
				 $rs2 = mysqli_query($conn,$sql2) or die(mysqli_error($conn));
				 $rc2 = mysqli_fetch_assoc($rs2);
				 echo "<tr scope = 'row'> ";
				 echo "<td>" . $rc["staffID"] . "</td>";
				 echo "<td>" . $rc["staffName"] . "</td>";
				 echo "<td>" . $rc2["ordercount"] . "</td>";
				 echo "<td>" . $rc2["totalsales"] . "</td>";
				 echo "</tr>";
				 echo "<tr class='spacer'><td colspan='100'></td></tr>";
			 }
			 echo "</tbody>";
			 mysqli_free_result($rs);
			 mysqli_close($conn);
		  }else{
			require("conn.php");
			 $sql = "select * from staff where position = 'Staff'";
			 $rs = mysqli_query($conn,$sql) or die(mysqli_error($conn));
			 echo "<input type='button' onclick='searchByMonth()' value='Search' class='button' />";
			 echo "<input type='month' name='searchMonth' id='Searchmonth' class='button'min='2019-01' max='2030-12'/>";
			 echo "<table class='table custom-table'>";
			 echo "<thead>";
             echo "<tr>";
             echo "<th scope='col'>Staff ID</th>";
             echo "<th scope='col'>Staff Name</th>";
             echo "<th scope='col'>Number of order records</th>";
             echo "<th scope='col'>Total sales amount</th>";
             echo "</tr>";
			 echo "</thead>";
			 echo "<tbody>";
			 while($rc = mysqli_fetch_assoc($rs)){
				 $sql2 = "select count(*) as ordercount,sum(totalPrice) as totalsales from orders where staffID = '{$rc["staffID"]}'";
				 $rs2 = mysqli_query($conn,$sql2) or die(mysqli_error($conn));
				 $rc2 = mysqli_fetch_assoc($rs2);
				 echo "<tr scope = 'row'> ";
				 echo "<td>" . $rc["staffID"] . "</td>";
				 echo "<td>" . $rc["staffName"] . "</td>";
				 echo "<td>" . $rc2["ordercount"] . "</td>";
				 echo "<td>" . $rc2["totalsales"] . "</td>";
				 echo "</tr>";
				 echo "<tr class='spacer'><td colspan='100'></td></tr>";
			 }
			 echo "</tbody>";
			 mysqli_free_result($rs);
			 mysqli_close($conn);
		  }
		?>
        </table>
		</form>
      </div>


    </div>

  </div>
    
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
	
  </body>
</html>

<?php
}
?>