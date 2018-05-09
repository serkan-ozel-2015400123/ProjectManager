
<html>
<head>
<title>Employer Task Information Page</title>
</head>
<body>
	<?php

	$conn = new mysqli("localhost", "employee", "12345678","mydatabase");
	
	
	$result = $conn->query("SELECT id FROM task WHERE date=CURDATE() AND id IN (SELECT id FROM task WHERE id IN (SELECT task_id FROM employee_task WHERE employee_id ='".$_GET['id']."'))");
	
	if ($result) {
		if($result->num_rows>0){
			echo "Your task ids are :";
			while ($row = $result->fetch_assoc()){
				echo $row['id']." ";
			}
			echo "<form action='./employeehome.php'>
		<input type='submit' value='Press'/>
		</form>";
		}else{
			
		echo "No tasks today ";
		echo "<form action='./employeehome.php'>
		<input type='submit' value='Press'/>
		</form>";
		}
		
	}else{
		echo "Error something was wrong: ".$conn->error;
		echo "<form action='./employeehome.php'>
		<input type='submit' value='Press'/>
		</form>";
	}
			
	?>


</body>

</html>