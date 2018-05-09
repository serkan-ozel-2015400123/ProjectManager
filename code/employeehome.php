

<html>
<head>
<title>Employer Task Information Page</title>
</head>
<body>
<h1>Welcome to project management system, our precious employee!</h1>
<h3> Please enter your id here to see your task today!</h3>
<form action="employeequery.php" method= "get"> <input type ="number" name ="id"/><input type="submit" value="submit"/></form>

<?php
	$conn = new mysqli("localhost", "employee", "12345678","mydatabase");

$sql = "SELECT * FROM task";
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				echo "<p>All the tasks:</p>";
				echo "<table><tr><th>ID</th><th>Name</th><th>Date</th><th>Days</th><th>Project id</th></tr>";
			while($row = $result->fetch_assoc()) {
				echo "<tr><td>".$row["id"]."</td><td>".$row['name']."</td><td>".$row["date"]."</td><td>".$row["days"]."</td><td>".$row["project_id"]."</td></tr>";
			}
				echo "</table><br>";
			}else{
				echo "0 results";
			}
?>
<form action="index.php"><input type="submit" value="Go back"/></form>
</body>

</html>