<?php
session_start();

$conn = new mysqli("localhost", $_SESSION['username'], $_SESSION['password'],"mydatabase");

if(isset($_GET['completeinput'])){
	
	$result = $conn->query("CALL completed('".$_GET['completeinput']."')");
	if($result){
		if($result->num_rows >0){
			echo "The ids of them: ";
			while($row =$result->fetch_assoc()){
				echo $row['id']." ";
			}
		}else{
			echo "No result";
		}
	}else{
		echo $conn->error;
	}
}
if(isset($_GET['incompleteinput'])){
	
	$result = $conn->query("CALL incompleted('".$_GET['incompleteinput']."')");
	if($result){
		if($result->num_rows >0){
			echo "The ids of them: ";
			while($row =$result->fetch_assoc()){
				echo $row['id']." ";
			}
		}else{
			echo "No result";
		}
	}else{
		echo $conn->error;
	}
}



?>
<form action="admin.php"><input type="submit" value ="Go back"/></form>
<form action="storedprocedureadmin.php" method= "get"><p>For complete projects, enter some input: (id or ALL )</p><input type = "text" name="completeinput"/><input type="submit" value="Click"/></form>
<form action="storedprocedureadmin.php" method= "get"><p>For incomplete projects, enter some input: (id or ALL )</p><input type = "text" name="incompleteinput"/><input type="submit" value="Click"/></form>