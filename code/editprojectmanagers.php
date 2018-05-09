<?php

session_start();

$conn = new mysqli('localhost', $_SESSION['username'], $_SESSION['password'], 'mydatabase');


?>
<!DOCTYPE html>

<html>
    <head>
        <title>Edit project managers</title>
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
					echo "<table><tr><th>ID</th><th>Name</th><th>Start Date</th><th>Estimated Total Work Days</th><th>Area</th><th>Status</th></tr>";
				
				while($row = $resultArray->fetch_assoc()) {
					echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["start_date"]. "</td><td>" . $row["estimated_total_work_days"]. "</td><td>" . $row["area"]. "</td><td>" . $row["status"]. "</td></tr>";
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
					echo "<table><tr><th>ID</th><th>Name</th></tr>";
				
				while($row = $resultArray->fetch_assoc()) {
					echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td></tr>";
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
		<form action = "editprojectmanagers.php" method="get">
		<input type="submit" value="Add a project manager" name="add"/>
		<input type="submit" value="Update a project manager's password " name="update"/>
		<input type="submit" value="Delete a project manager" name="delete"/>
		<input type="submit" value="Admin Home" name="admin">
		<input type="submit" value="Log out" name="logout">
		</form>
		
		
		<?php
		$_SESSION['projectManagerOperation']=NULL;
		if(isset($_GET['add'])){
			$_SESSION['projectManagerOperation'] ="add" ;
		}else if(isset($_GET['update'])){
			$_SESSION['projectManagerOperation'] ="update" ;
		}
		else if(isset($_GET['delete'])){
			$_SESSION['projectManagerOperation'] ="delete" ;
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
		
			if($_SESSION['projectManagerOperation'] == "add"){
				echo '
				Enter the username and password of the project manager. Don\'t leave, <b>username</b> and <b>password</b> empty.
				Note that you cannot create a user with the same username of another user.
				<hr>
	
				<form action="addprojectmanager.php" method="post">
				 <p>Id:<input type="number" name="id"/></p>
				 <p>User name: <input type="text" name="username" /></p>
				 <p>Password: <input type="password" name="password" /></p>
				 <p>Password again: <input type="password" name="passwordagain" /></p>
				 <p><input type="submit" value="Click" /></p>
				</form>';
			}
			
			if($_SESSION['projectManagerOperation'] == "update"){
				echo '
				Enter the id of the project manager that you want to update its password. Don\'t leave <b>id</b> and <b>password</b> empty.
				<hr>


				<form action="updateprojectmanager.php" method="post"> 
				 <p> Id of the project manager: <input type="number" name="id" /></p>
				 <p> New password: <input type="password" name="password" /></p>
				 <p> New password again: <input type="password" name="passwordagain" /></p>
				 <p><input type="submit" value="Click" /></p>
				</form>';
			}
		
			if($_SESSION['projectManagerOperation'] == "delete"){
				echo 'Enter the id of the project manager you want to delete. Don\'t leave <b>id</b> empty.
				<hr>

				<form action="deleteprojectmanager.php" method="post"> 
				 <p> Id of the project manager: <input type="number" name="id" /></p>
				 <p><input type="submit" value="Click" /></p>
				</form>';
			}
		?>
		
    </body>
</html>
