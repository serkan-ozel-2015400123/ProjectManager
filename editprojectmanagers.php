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
			// CREATE USER 'aas'@'localhost' IDENTIFIED VIA mysql_native_password USING '***';GRANT SELECT, INSERT, UPDATE, DELETE ON *.* TO 'aas'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
			// DROP USER 'aas'@'localhost'
			// SET PASSWORD FOR root@localhost = PASSWORD('your_root_password');
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
		<form action = "editprojectmanagers.php" method="get">
		<input type="submit" value="Add a project manager" name="add"/>
		<input type="submit" value="Update a project manager's password " name="update"/>
		<input type="submit" value="Delete a project manager" name="delete"/>
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
		}
		
		?>
		
		
		<?php
		
			if($_SESSION['projectManagerOperation'] == "add"){
				echo '
				<h3>Enter the username and password of the project manager.</h3>	

				<form action="addprojectmanager.php" method="post"> 
				 <p>User name: <input type="text" name="username" /></p>
				 <p>Password: <input type="password" name="password" /></p>
				 <p>Password again: <input type="password" name="passwordagain" /></p>
				 <p><input type="submit" value="Click" /></p>
				</form>';
			}
			
			if($_SESSION['projectManagerOperation'] == "update"){
				echo '
				<h3>Enter the id of the project manager that you want to update its password.</h3>	

				<form action="updateprojectmanager.php" method="post"> 
				 <p> Id of the project manager: <input type="number" name="id" /></p>
				 <p> New password: <input type="password" name="password" /></p>
				 <p><input type="submit" value="Click" /></p>
				</form>';
			}
		
			if($_SESSION['projectManagerOperation'] == "delete"){
				echo '<h3>Enter the id of the project manager you want to delete.</h3>	

				<form action="deleteprojectmanager.php" method="post"> 
				 <p> Id of the project manager: <input type="number" name="id" /></p>
				 <p><input type="submit" value="Click" /></p>
				</form>';
			}
		?>
		
    </body>
</html>
