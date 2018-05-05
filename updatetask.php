

<?php
session_start();

$conn = new mysqli("localhost", $_SESSION['username'], $_SESSION['password'],"mydatabase");

$result = $conn->query("UPDATE task SET id = ".$_GET['newtaskid'].','."name =".$_GET['name'].","."date = ".$_GET['date'].","."days = ".$_GET['days'].","."project_id=".$_GET['projectid']
.","."employee_id = ".$_GET['employeeid']." WHERE id = ".$_GET['oldtaskid']);

if($result){
	echo "<h4>Task is added. To go back press:</h4>
		<form action='assigntask.php'>
		<input type='submit' value='Press'/>
		</form>";
	
}else{
	echo "Error: ".$conn->error;
}


?>