
<?php
session_start();

$conn = new mysqli("localhost", $_SESSION['username'], $_SESSION['password'],"mydatabase");

if($conn->query("INSERT INTO projectmanager_project (project_manager_id,project_id) VALUES ('".$_POST['projectmanagerid']."','".$_POST['projectid']."')")){
	echo "Assigned.";
	echo "<form action='editprojects.php'>
	<input type='submit' value='To go back press' />
	</form>";
}else{
	echo "Sorry, there is an error with INSERT query :".$conn->error;
	echo "<form action='editprojects.php' method='get'>
	<input type='submit' value='To go back press' name= 'assign'/>
	</form>";
	
}



?>