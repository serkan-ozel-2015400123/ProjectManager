<?php

session_start();

$conn = new mysqli('localhost', $_SESSION['username'], $_SESSION['password'], 'mydatabase');


?>
<!DOCTYPE html>

<html>
    <head>
        <title>Edit projects</title>
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
			
	?>
<?php
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
			?>
<?php
			
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
			
			

		$conn->close();
		}
					
		
?>
<br>
		<form action = "editprojects.php" method="get">
		<input type="submit" value="Add a project" name="add"/>
		<input type="submit" value="Update a project" name="update"/>
		<input type="submit" value="Delete a project" name="delete"/>
		<input type="submit" value="Log out" name="logout">
		<input type="submit" value="Admin Home" name="admin">
		</form>
		
		
		<?php
		$_SESSION['projectoperation']=NULL;
		if(isset($_GET['add'])){
			$_SESSION['projectoperation'] ="add" ;
		}else if(isset($_GET['update'])){
			$_SESSION['projectoperation'] ="update" ;
		}
		else if(isset($_GET['delete'])){
			$_SESSION['projectoperation'] ="delete" ;
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
		if($_SESSION['projectoperation'] == "add"){
			
		echo '
		<h3>Enter some info, if you want a field to be NULL leave it empty: </h3>
		<form action="updateproject.php" method="get"> 
         <p>Id of the project you want to update: <input type="number" name="id" /></p>
		 <p> Name :<input type="text" name="name" /></p>
		 <p> Start date: <input type="date" name="startdate" /></p>
		 <p>Estimated Total Work Days: <input type="number" name="estimatedtotalworkdays" /></p>
		 <p> Area: <input type="text" name="area" /></p>
		 <p>Status:  <input type="text" name="status" /></p>
		 <p> Project manager id: <input type="number" name="projectmanagerid" /></p>
         <p><input type="submit" value="Click" /></p>
        </form>';
		}
		?>
		<?php
		if($_SESSION['projectoperation'] == "update"){
		echo '
		<h3>Enter some info, if you don\'t want to change a field leave it empty, if you want a text field to be NULL, type NULL in it. :</h3>	

		<form action="updateproject.php" method="get"> 
         <p>Id of the project you want to update: <input type="number" name="id" /></p>
		 <p> Name :<input type="text" name="name" /></p>
		 <p> Start date: <input type="date" name="startdate" /></p>
		 <p>Estimated Total Work Days: <input type="number" name="estimatedtotalworkdays" /></p>
		 <p> Area: <input type="text" name="area" /></p>
		 <p>Status:  <input type="text" name="status" /></p>
		 <p> Project manager id: <input type="number" name="projectmanagerid" /></p>
         <p><input type="submit" value="Click" /></p>
        </form>';
		}
		?>
		
		<?php
		if($_SESSION['projectoperation'] == "delete"){
		echo '<h3>Here task-id is required. i.e cannot be empty.</h3>	

		<form action="deleteproject.php" method="get"> 
         <p> <input type="number" name="id" /></p>
         <p><input type="submit" value="Click" /></p>
        </form>';
		}
		?>
		
    </body>
</html>
