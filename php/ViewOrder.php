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
	function confirmDelete(id){
		if(confirm("Are you sure to delete this order record (id: " + id + ") ?")){
			document.forms[0].hdOrderID.value = id;
			document.forms[0].submit();
		}
	}
	
	function searchOrder(){
		var email = document.getElementById("customeremail").value;
		location.href ="ViewOrder.php?customerEmail=" + email;
	}
	</script>
    <title>View Order</title>

  </head>
  <body>
  
  <div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a href="CreateOrder.php">Create Order</a>
		<a href="ViewOrder.php">Order List</a>
		<a href="Logout.php">Log out</a>
	</div>

	<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>

  <div class="content">
    
    <div class="container">
      <h2 class="mb-5">View Order</h2>
      

      <div class="table-responsive custom-table-responsive">

		<form method="post" action="DelOrder.php">
		<input type="hidden" name = "hdOrderID">
		<input type="button" onclick="searchOrder()" value="Search" class="button" />
		<input type="text" name="searchCustomerEmail" id="customeremail" class="button" placeholder="Enter email address"/>
        
        <table class="table custom-table">
		
          <thead>
            <tr>  
              <th scope="col">Order ID</th>
              <th scope="col">Customer's Email</th>
              <th scope="col">Staff ID</th>
              <th scope="col">Order Date & Time</th>
              <th scope="col">Delivery Address</th>
              <th scope="col">Delivery Date</th>
            </tr>
          </thead>
		  
          <tbody>
        <?php
			if(isset($_GET["customerEmail"])){
				require("conn.php");
				$email = $_GET["customerEmail"];
				$sql = "select * from orders where customerEmail like '%$email%' ";
				$rs = mysqli_query($conn, $sql) or die (mysqli_error($conn));
				
				while ($rc = mysqli_fetch_assoc($rs)){
					echo "<tr>";
					echo "<td>" . $rc["orderID"] . "</td>";
					echo "<td>" . $rc["customerEmail"] . "</td>";
					echo "<td>" . $rc["staffID"] . "</td>";
					echo "<td>" . $rc["dateTime"] . "</td>";
					echo "<td>" . $rc["deliveryAddress"] . "</td>";
					echo "<td>" . $rc["deliveryDate"] . "</td>";
					echo "<td><input type='button' value='View' onclick='location.href = \"Order.php?orderID={$rc['orderID']} \"' class='button'/></td>";
					echo "<td><input type='submit' value='Delete' class='button' ></td>";
					echo "</tr>";
				}
				mysqli_free_result($rs);
				mysqli_close($conn);
			}else{
				require("conn.php");
				
				$sql = "SELECT * FROM orders";
				$rs = mysqli_query($conn, $sql) or die (mysqli_error($conn));
				
				while ($rc = mysqli_fetch_assoc($rs)){
					echo "<tr>";
					echo "<td>" . $rc["orderID"] . "</td>";
					echo "<td>" . $rc["customerEmail"] . "</td>";
					echo "<td>" . $rc["staffID"] . "</td>";
					echo "<td>" . $rc["dateTime"] . "</td>";
					echo "<td>" . $rc["deliveryAddress"] . "</td>";
					echo "<td>" . $rc["deliveryDate"] . "</td>";
					echo "<td><input type='button' value='View' onclick='location.href = \"Order.php?orderID={$rc['orderID']} \"' class='button'/></td>";
					echo "<td><input type='submit' value='Delete' class='button' onclick=confirmDelete({$rc["orderID"]}) ></td>";
					echo "</tr>";
				}
				mysqli_free_result($rs);
				mysqli_close($conn);
			}
		?>
          </tbody>
        </table>
		<input type="button" value="Place Order" onclick="location.href = 'CreateOrder.php'" class="button"/>
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