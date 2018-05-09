<?php

session_start();

$conn = new mysqli('localhost', $_SESSION['username'], $_SESSION['password'], 'mydatabase');
$result = $conn->query("INSERT INTO employee (id,name) VALUES ('".$_POST['id']."','".$_POST['name']."')");

if($result){
	echo "Employee is added. To go back press:
	<form action='./editemployees.php'>
	<input type='submit' value='Press'/>
	</form>";
}else{	
	echo "Error something was wrong: ".$conn->error;
	echo "<form action='./editemployees.php' method='get'>
	<input type='submit' value='Press' name='add'/>
	</form>";
	
}


?>