<?php

session_start();

$conn = new mysqli('localhost', $_SESSION['username'], $_SESSION['password'], 'mydatabase');




?>
<!DOCTYPE html>

<html>
    <head>
        <title>Assign tasks to employees</title>
    </head>
    <body>
	
		<ul>
			<li><h3> Please note, an employee can only have a task per day.</h3></li>
			<li><h3> You need to give project id and employee id exist in the database.</h3></li>
		</ul>
		<br>
		        
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
						
			$projectsOwnedByProjectManager = $conn->query("SELECT * FROM project WHERE project_manager_id =".$_SESSION['projectmanagerid']);
			if($projectsOwnedByProjectManager){
				if ($projectsOwnedByProjectManager->num_rows > 0) {
					echo "<p>The projects you have:</p>";
					echo "<table><tr><th>ID</th><th>Name</th><th>Start Date</th><th>Estimated Total Work Days</th><th>Area</th><th>Status</th><th>Project manager id</th></tr>";
				
				while($row = $projectsOwnedByProjectPanager->fetch_assoc()) {
					echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["start_date"]. "</td><td>" . $row["estimated_total_work_days"]. "</td><td>" . $row["area"]. "</td><td>" . $row["status"]. "</td><td>" . $row["project_manager_id"]. "</td></tr>";
				}
					echo "</table><br>";
				}else{
					echo "0 results";
				}
				
			}else{
				echo $conn->error;
			}
			
			$sql = "SELECT * FROM task";
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				echo "<p>All the tasks:</p>";
				echo "<table><tr><th>ID</th><th>Name</th><th>Date</th><th>Days</th><th>Project id</th><th>Employee id</th></tr>";
			while($row = $result->fetch_assoc()) {
				echo "<tr><td>" . $row["id"]. "</td><td>" . $row['name']. "</td><td>" . $row["date"]. "</td><td>" . $row["days"]. "</td><td>" . $row["project_id"]. "</td><td>" . $row["employee_id"]. "</td></tr>";
			}
				echo "</table><br>";
			}else{
				echo "0 results";
			}
			
			
			$employeeResult = $conn->query("SELECT * FROM employee");
			
			if ($employeeResult->num_rows > 0) {
				echo "<p>All the employees:</p>";
				echo "<table><tr><th>ID</th><th>Name</th><th>Project id</th></tr>";
				while($row = $employeeResult->fetch_assoc()) {
					echo "<tr><td>" . $row["id"]. "</td><td>" . $row['name']. "</td><td>" . $row["project_id"]. "</td></tr>";
				}
				echo "</table><br>";
			}else{
				echo "0 results";
			}
			
			

		$conn->close();
		}
					
		
		?>
		<br>
		<form action = "assigntask.php" method="get">
		<input type="submit" value="Add a task" name="add"/>
		<input type="submit" value="Update a task" name="update"/>
		<input type="submit" value="Delete a task" name="delete"/>
		<input type="submit" value="Log out" name="logout">
		</form>
		
		
		<?php
		$_SESSION['projectmanageroption']=NULL;
		if(isset($_GET['add'])){
			$_SESSION['projectmanageroption'] ="add" ;
		}else if(isset($_GET['update'])){
			$_SESSION['projectmanageroption'] ="update" ;
		}
		else if(isset($_GET['delete'])){
			$_SESSION['projectmanageroption'] ="delete" ;
		}else if(isset($_GET['logout'])){
			echo "<script type='text/javascript'>;
			window.location.href = './index.php';
			</script>";
		}
		
		?>
		
		
		<?php
		if($_SESSION['projectmanageroption'] == "add"){
		echo '<form action="addtask.php" method="get"> 
         <p>Task id: <input type="number" name="taskid" /></p>
		 <p>Name: <input type="text" name="name"/></p>
		 <p>Date: <input type="date" name="date" /></p>
		 <p>Days: <input type="number" name="days" /></p>
		 <p>Project id: <input type="number" name="projectid" /></p>
		 <p>Employee id: <input type="number" name="employeeid" /></p>
         <p><input type="submit" value="Add Task" /></p>
        </form>';
		}
		?>
		<?php
		if($_SESSION['projectmanageroption'] == "update"){
		echo '<h3>Here task-id is required. i.e cannot be empty. Then enter the new values of the other fields.</h3>	

		<form action="updatetask.php" method="get"> 
         <p>Old Task id: <input type="number" name="oldtaskid" /></p>
		 <p>New Task id: <input type="number" name="newtaskid" /></p>
		 <p>Name: <input type="text" name="name"/></p>
		 <p>Date: <input type="date" name="date" /></p>
		 <p>Days: <input type="number" name="days" /></p>
		 <p>Project id: <input type="number" name="projectid" /></p>
		 <p>Employee id: <input type="number" name="employeeid" /></p>
         <p><input type="submit" value="Update Task" /></p>
        </form>';
		}
		?>
		
		<?php
		if($_SESSION['projectmanageroption'] == "delete"){
		echo '<h3>Here task-id is required. i.e cannot be empty.</h3>	

		<form action="deletetask.php" method="get">
		<p>Task id: <input type="number" name="taskid" /></p>
		<p><input type="submit" value="Delete Task" /></p>
		</form>';
		}
		?>
		
    </body>
</html>
