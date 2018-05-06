<?php

session_start();

$conn = new mysqli('localhost', $_SESSION['username'], $_SESSION['password'], 'mydatabase');


?>
<!DOCTYPE html>

<html>
    <head>
        <title>Edit employees</title>
    </head>
    <body>
		        
		<style>
		table {
			border-collapse: collapse;
			width: 50%;
		}
		table, th, td {
			border: 1px solid black;
			text-align: center;
		}
		th{
			height: 30px;
			
		}
		</style>


<?php
	if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}else{
						
			$resultArray = $conn->query("SELECT * FROM employee");
			if($resultArray){
				if ($resultArray->num_rows > 0) {
					echo "<p>Employees:</p>";
					echo "<table><tr><th>ID</th><th>Name</th><th>Project id</th></tr>";
				
				while($row = $resultArray->fetch_assoc()) {
					echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["project_id"]. "</td></tr>";
				}
					echo "</table><br>";
				}else{
					echo "0 results";
				}
				
			}else{
				echo $conn->error;
			}
			
			$resultArray = $conn->query("SELECT * FROM project");
			if($resultArray){
				if ($resultArray->num_rows > 0) {
					echo "<p>Projects: </p>";
					echo "<table><tr><th>ID</th><th>Name</th><th>Start Date</th><th>Estimated Total Work Days</th><th>Area</th><th>Status</th><th>Project manager id</th></tr>";
				
				while($row = $resultArray->fetch_assoc()) {
					echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["start_date"]. "</td><td>" . $row["estimated_total_work_days"]. "</td><td>" . $row["area"]. "</td><td>" . $row["status"]. "</td><td>" . $row["project_manager_id"]. "</td></tr>";
				}
					echo "</table><br>";
				}else{
					echo "0 results";
				}
				
			}else{
				echo $conn->error;
			}
			
			$resultArray = $conn->query("SELECT * FROM projectmanager");
			
			if($resultArray){
				if ($resultArray->num_rows > 0) {
					echo "<p>Project managers:</p>";
					echo "<table><tr><th>ID</th><th>Username</th></tr>";
				
				while($row = $resultArray->fetch_assoc()) {
					echo "<tr><td>" . $row["id"]. "</td><td>" . $row["username"]. "</td></tr>";
				}
					echo "</table><br>";
				}else{
					echo "0 results";
				}
				
			}else{
				echo $conn->error;
			}

		$conn->close();
		}
					
		
?>
	
			
<br>
		<form action = "editemployees.php" method="get">
		<input type="submit" value="Add an employee" name="add"/>
		<input type="submit" value="Update an employee " name="update"/>
		<input type="submit" value="Delete an employee " name="delete"/>
		<input type="submit" value="Admin Home" name="admin">
		<input type="submit" value="Log out" name="logout">
		</form>
		
		
		<?php
		$_SESSION['']=NULL;
		if(isset($_GET['add'])){
			$_SESSION[''] ="add" ;
		}else if(isset($_GET['update'])){
			$_SESSION[''] ="update" ;
		}
		else if(isset($_GET['delete'])){
			$_SESSION[''] ="delete" ;
		}else if(isset($_GET['logout'])){
			echo "<script type='text/javascript'>;
			window.location.href = './index.php';
			</script>";
		}else if(isset($_GET['admin'])){
			echo "<script type='text/javascript'>;
			window.location.href = './admin.php';
			</script>";
		}
		
		?>
		
		
		<?php
		if($_SESSION[''] == "add"){
		echo '
		Enter info please:
		<form action="addemployee.php" method="get"> 
         <p> Id: <input type="number" name="id" /></p>
		 <p> Name: <input type="text" name="name" /></p>
		 <p> Project id: <input type="number" name="projectid" /></p>
         <p><input type="submit" value="Click" /></p>
        </form>';
		}
		?>
		<?php
		if($_SESSION[''] == "update"){
		echo '
		Enter info please but <b>id</b> cannot be empty:
		<form action="updateemployee.php" method="get"> 
          <p> Id: <input type="number" name="id" /></p>
		 <p> Name: <input type="text" name="name" /></p>
		 <p> Project id: <input type="number" name="projectid" /></p>
         <p><input type="submit" value="Click" /></p>
        </form>';
		}
		?>
		
		<?php
		if($_SESSION[''] == "delete"){
		echo 'Enter info please but <b>id</b> cannot be empty:

		<form action="deleteemployee.php" method="get"> 
		 <p> Id: <input type="number" name="id" /></p>
         <p><input type="submit" value="Click" /></p>
        </form>';
		}
		?>
		
    </body>
</html>
