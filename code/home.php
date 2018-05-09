<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>


<?php
$deneme = new mysqli("localhost", "employee", "12345678","mydatabase");

$conn = new mysqli("localhost", $deneme->real_escape_string($_SESSION['username']), $deneme->real_escape_string($_SESSION['password']),"mydatabase");

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
	echo "<p>Username or password was incorrect, to go back press this button</p><form action='index.php'><input type='submit' value='Click'/></form>";
}else{
	$adminquery = $conn->query("SELECT username FROM admin WHERE username ='".$_SESSION['username']."'");

	$projectmanagersquery = $conn->query("SELECT id,username FROM projectmanager WHERE username='".$_SESSION['username']."'");
	if ($projectmanagersquery->num_rows > 0) {
		$_SESSION['projectmanagerid'] = $projectmanagers['id'];
		projectmanager();	
		}	
	else if($adminquery-> num_rows > 0 ) admin();
	else{
		echo "<br><p>Somehow, you are not added to the database write now. Wait an another admin to add you to the database.</p>";
		echo "<p>To go back press this button</p><form action='index.php'><input type='submit' value='Click'/></form>";
	}
}
	
	
 
?>


</body>
</html>