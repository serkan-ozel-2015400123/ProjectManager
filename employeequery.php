
<html>
<head>
<title>Employer Task Information Page</title>
</head>
<body>
<?php

	$conn = new mysqli("localhost", "employee", "12345678","mydatabase");
	if ($conn->connect_error) {
		printf("Connect failed: %s\n", $conn->connect_error);
		exit();
	}else{
		if (isset($_GET['name']) && !empty($_GET['name'])) {
			$result = $conn->query("SELECT task_id FROM employee WHERE name='".$_GET['name']."'");
			//printf("Select returned %d rows.\n", $result->num_rows);
			echo "<br>";
			
			$task_id;
			if ($result->num_rows == 0) {
				header("Location: ./employeehome.php?message=This name does not exist in the database!");
			} else {
				$datarow = $result->fetch_array(MYSQLI_ASSOC);
				$task_id = $datarow['task_id'];
			}
		
		
		}else {
			header("Location: ./employeehome.php?message= Please enter your name.");
		}
		
		$row;
		if($taskquery = $conn->query("SELECT name FROM task WHERE id='".$task_id."'")){
			$row = $taskquery->fetch_assoc();
		}else{
			header("Location: ./employeehome.php?message=".$conn->error);
		}
		if ($taskquery->num_rows == 0) {
			echo "You don't have any tasks.";
		} else {
			echo "Your task today is " .$row['name'];
		}
	}
	
	
    $taskquery->close();
		

 
?>
<form action="employeehome.php">
<h3>To go back, please press this button.</h3>
<input type="submit" value="Go back"></input>
</form>
</body>

</html>