<?php
	session_start();
	if(isset($_POST['tfStaffID'])){
		$staffid = $_POST["tfStaffID"];
		$Password = $_POST["tfPassword"];
		require("conn.php");
		$sql = "select * from staff where staffID = '$staffid' and password = '$Password';";
		$rs = mysqli_query($conn,$sql);
		$numrows = mysqli_num_rows($rs);
		$rc = mysqli_fetch_assoc($rs);
		if($numrows > 0 ){
			if($rc["position"] == "Manager"){
				echo "<script>alert('Login successful! You login as Manager');";
				echo "location.href = 'ViewProduct.php';";
				echo "</script>";
				setcookie("user",$staffid,time()+3600 );
				mysqli_free_result($rs);
				mysqli_close($conn);
			}else{
				echo "<script>alert('Login successful! You login as Staff'); ";
				echo "location.href = 'ViewOrder.php';";
				echo "</script>";
				setcookie("user",$staffid,time()+3600 );
				mysqli_free_result($rs);
				mysqli_close($conn);
			}
		}else{
			echo "<script>alert('Invalid staff id or password'); ";
			echo "location.href = '../home.html';";
			echo "</script>";
			
			mysqli_free_result($rs);
			mysqli_close($conn);
		}
	}
?>