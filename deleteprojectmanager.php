
<?php
session_start();

$conn = new mysqli("localhost", $_SESSION['username'], $_SESSION['password'],"mydatabase");
if($_POST['id']!=""){
	
				
	// DROP USER 'aas'@'localhost'
	$result = $conn->query("SELECT * FROM projectmanager WHERE id='".$_POST['id']."'");
	if($result){
		$row = $result->fetch_assoc();
		
		$deleted=$conn->query("DROP USER ".$row['username']."@localhost");
		if($deleted){
			$conn->query("DELETE FROM projectmanager WHERE id='".$_POST['id']."'");
			echo "Deleted";
			echo "<form action='./editprojectmanagers.php'>
			<input type='submit' value='To go back press' />
			</form>";
		}else{
			echo "Sorry, an error happened while deleting: ".$conn->error;
			echo "<form action='./editprojectmanagers.php' method='get'>
			<input type='submit' value='To go back press' name='delete'/>
			</form>";
		}
	}else{
		echo "Sorry, there is not a project manager with that id";
		echo "<form action='./editprojectmanagers.php' method='get'>
		<input type='submit' value='To go back press' name='delete'/>
		</form>";	
	}
	
	
}else{
	
	echo "Error: Id was empty.";
	echo "<form action='./editprojectmanagers.php' method='get'>
	<input type='submit' value='To go back press' name='delete'/>
	</form>";
}
	
?>