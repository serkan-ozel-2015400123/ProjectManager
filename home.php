<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>


<?php

$conn = new mysqli("localhost", $_SESSION['username'], $_SESSION['password'],"mydatabase");

	function admin(){
		echo "<script type='text/javascript'>;
			window.location.href = './admin.php';
			</script>";
	}
	
	function projectmanager(){
		echo "<script type='text/javascript'>;
			window.location.href = './projectmanager.php';
			</script>";
	}
	
if ($conn->connect_error) {
	echo "<script type='text/javascript'>;
			window.location.href = './index.php';
			</script>";
}else{
	
	$result = $conn->query("SELECT CURRENT_USER();");
	
	
	
	
	$row = $result->fetch_assoc();
	$currentuser = $row["CURRENT_USER()"];
	
	echo "Current User is : ". substr($currentuser,0,-10);
	
	$projectmanagersquery = $conn->query("SELECT username FROM projectmanager");
	if ($projectmanagersquery->num_rows > 0) {
		$projectmanagers = $projectmanagersquery->fetch_array(MYSQLI_NUM);
		if(in_array($_SESSION['username'],$projectmanagers)){
			
			$id = $conn->query("SELECT id FROM projectmanager WHERE username='".$_SESSION['username']."'");
			if($id){$array = $id->fetch_array();}
			else{
				echo $conn->error;
			}
			$_SESSION['projectmanagerid'] = $array[0];
			projectmanager();
		}else{
			
			echo "<br><p>You are not added to the database write now. Wait an admin to add to the database.</p>";
			echo "<p>To go back press this button</p><form action='index.php'><input type='submit' value='Click'/></form>";
		}
	}
	
	
	$adminquery = $conn->query("SELECT username FROM admin");
	if($adminquery->num_rows > 0){
		$admins = $adminquery->fetch_array(MYSQLI_NUM);
		if(in_array($_SESSION['username'],$admins)){
			admin();
		}
	}
}
 
?>


</body>
</html>