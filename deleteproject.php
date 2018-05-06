
<?php
session_start();

$conn = new mysqli("localhost", $_SESSION['username'], $_SESSION['password'],"mydatabase");
if($_POST['id']!=""){
	
	$result = $conn->query("DELETE FROM project WHERE id='".$_POST['id']."'");
	if($result){
		echo "Deleted";
		echo "<form action='./editprojects.php'>
		<input type='submit' value='To go back press' />
		</form>";
		}else{
			echo "Sorry, there is not a project manager with that id";
			echo "<form action='./editprojects.php' method='get'>
			<input type='submit' value='To go back press' name='delete'/>
			</form>";
		}
	
	
}else{
	
	echo "Error: Id was empty.";
	echo "<form action='./editprojects.php' method='get'>
	<input type='submit' value='To go back press' name='delete'/>
	</form>";
}
	
?>