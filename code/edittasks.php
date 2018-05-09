<?php

session_start();

$conn = new mysqli('localhost', $_SESSION['username'], $_SESSION['password'], 'mydatabase');


$_SESSION['projectmanagerid'] = $conn->query("SELECT id FROM projectmanager WHERE username='".$_SESSION['username']."'")->fetch_array()[0];

?>
<!DOCTYPE html>

<html>
    <head>
        <title>Edit tasks</title>
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
			die("Connection failed: ".$conn->connect_error);
		}else{
						
			
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
			
			
			$employeeResult = $conn->query("SELECT * FROM employee");
			
			if ($employeeResult->num_rows > 0) {
				echo "<p>All the employees:</p>";
				echo "<table><tr><th>ID</th><th>Name</th></tr>";
				while($row = $employeeResult->fetch_assoc()) {
					echo "<tr><td>".$row["id"]."</td><td>".$row['name']."</td></tr>";
				}
				echo "</table><br>";
			}else{
				echo "0 results";
			}
			
			
			$xx = $conn->query("SELECT * FROM employee_task");
			
			if ($xx->num_rows > 0) {
				echo "<p>All the task assignments:</p>";
				echo "<table><tr><th>Employee id </th><th>Task id</th></tr>";
				while($row = $xx->fetch_assoc()) {
					echo "<tr><td>".$row["employee_id"]."</td><td>".$row['task_id']."</td></tr>";
				}
				echo "</table><br>";
			}else{
				echo "0 results";
			}
			
			$yy = $conn->query("SELECT * FROM projectmanager_project");
			
			if ($yy->num_rows > 0) {
				echo "<br>Your project manager id: ".$_SESSION['projectmanagerid'];
				echo "<br>";
				echo "<p>All the project assignments :</p>";
				echo "<table><tr><th>Project manager id </th><th>Project id</th></tr>";
				while($row = $yy->fetch_assoc()) {
					echo "<tr><td>" .$row["project_manager_id"]."</td><td>".$row['project_id']."</td></tr>";
				}
				echo "</table><br>";
			}else{
				echo "0 results";
			}
			
			

		$conn->close();
		}
					
		
		?>
		<br>
		<form action = "edittasks.php" method="get">
		<input type="submit" value="Add a task" name="add"/>
		<input type="submit" value="Update a task" name="update"/>
		<input type="submit" value="Delete a task" name="delete"/>
		<input type="submit" value="Assign a task to an employee" name="assign"/>
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
			
		}else if(isset($_GET['assign'])){
			$_SESSION['projectmanageroption'] ="assign" ;
			
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
		
		<?php
		if($_SESSION['projectmanageroption'] == "assign"){
		echo '<h3>Here task id and employee id is required. i.e cannot be empty.</h3>	

		<form action="assigntask.php" method="get">
		<p>Task id: <input type="number" name="taskid" /></p>
		<p> Employee id: <input type="number" name="employeeid"/></p>
		<p><input type="submit" value="Assign Task" /></p>
		</form>';
		}
		?>
		
    </body>
</html>
