<?php
session_start();

$conn = new mysqli("localhost", $_SESSION['username'], $_SESSION['password'],"mydatabase");

$result = $conn->query("DELETE FROM task WHERE id = ".$_GET['taskid']);

if($result){
	echo "<h4>Task is added. To go back press:</h4>
		<form action='assigntask.php'>
		<input type='submit' value='Press'/>
		</form>";
	
}else{
	echo "Error: ".$conn->error;
}


?>