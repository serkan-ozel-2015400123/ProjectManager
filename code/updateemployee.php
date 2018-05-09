<?php

session_start();

$conn = new mysqli('localhost', $_SESSION['username'], $_SESSION['password'], 'mydatabase');
$result = $conn->query("UPDATE employee SET id = '".$_POST['newid']."' ,name = '".$_POST['name']."' WHERE id ='".$_POST['id']."'");
if($result){
	
	echo "Employee is updated. To go back press:
	<form action='./editemployees.php' >
	<input type='submit' value='Press' />
	</form>";
	
}else{	
	echo "Error something was wrong: ".$conn->error;
	echo "<form action='./editemployees.php' method='get'>
	<input type='submit' value='Press' name='update'/>
	</form>";
}
?>