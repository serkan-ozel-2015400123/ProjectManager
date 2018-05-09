<?php
session_start();

$conn = new mysqli("localhost", $_SESSION['username'], $_SESSION['password'],"mydatabase");

$result = $conn->query("INSERT INTO project (id,name,start_date,estimated_total_work_days,area,status) VALUES ('".$_POST['id']."','".$_POST['name']."','".$_POST['startdate']."','".$_POST['estimatedtotalworkdays']."','".$_POST['area']."','".$_POST['status']."')");

if($result){
	echo "Project is added. To go back press:
	<form action='./editprojects.php'>
	<input type='submit' value='Press'/>
	</form>";
}else{
	echo "Error: Error while adding project: ".$conn->error;
	echo "<form action='./editprojects.php' method='get'>
	<input type='submit' value='Click to go back' name='add'/>
	</form>";
}
?>