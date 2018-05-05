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
						
			$resultArray = $conn->query("sql");
			if($resultArray){
				if ($resultArray->num_rows > 0) {
					echo "<p></p>";
					echo "<table><tr><th></th><th></th></tr>";
				
				while($row = $resultArray->fetch_assoc()) {
					echo "<tr><td>" . $row["id"]. "</td></tr>";
				}
					echo "</table><br>";
				}else{
					echo "0 results";
				}
				
			}else{
				echo $conn->error;
			}
			
			
			$resultArray = $conn->query("sql");
			if($resultArray){
				if ($resultArray->num_rows > 0) {
					echo "<p></p>";
					echo "<table><tr><th></th><th></th></tr>";
				
				while($row = $resultArray->fetch_assoc()) {
					echo "<tr><td>" . $row["id"]. "</td></tr>";
				}
					echo "</table><br>";
				}else{
					echo "0 results";
				}
				
			}else{
				echo $conn->error;
			}
			
			
			$resultArray = $conn->query("sql");
			if($resultArray){
				if ($resultArray->num_rows > 0) {
					echo "<p></p>";
					echo "<table><tr><th></th><th></th></tr>";
				
				while($row = $resultArray->fetch_assoc()) {
					echo "<tr><td>" . $row["id"]. "</td></tr>";
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
		<form action = ".php" method="get">
		<input type="submit" value="Add a " name="add"/>
		<input type="submit" value="Update a " name="update"/>
		<input type="submit" value="Delete a " name="delete"/>
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
		}
		
		?>
		
		
		<?php
		if($_SESSION[''] == "add"){
		echo '<form action="" method="get"> 
         <p> <input type="" name="" /></p>
		 <p> <input type="" name="" /></p>
		 <p> <input type="" name="" /></p>
		 <p> <input type="" name="" /></p>
		 <p> <input type="" name="" /></p>
         <p><input type="submit" value="" /></p>
        </form>';
		}
		?>
		<?php
		if($_SESSION[''] == "update"){
		echo '
		<h3></h3>	

		<form action="" method="get"> 
         <p> <input type="" name="" /></p>
		 <p> <input type="" name="" /></p>
		 <p> <input type="" name="" /></p>
		 <p> <input type="" name="" /></p>
		 <p> <input type="" name="" /></p>
         <p><input type="submit" value="" /></p>
        </form>';
		}
		?>
		
		<?php
		if($_SESSION[''] == "delete"){
		echo '<h3>Here task-id is required. i.e cannot be empty.</h3>	

		<form action="" method="get"> 
         <p> <input type="" name="" /></p>
		 <p> <input type="" name="" /></p>
		 <p> <input type="" name="" /></p>
		 <p> <input type="" name="" /></p>
		 <p> <input type="" name="" /></p>
         <p><input type="submit" value="" /></p>
        </form>';
		}
		?>
		
    </body>
</html>
