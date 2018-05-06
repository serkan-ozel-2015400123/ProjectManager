<?php
session_start();

$conn = new mysqli("localhost", $_SESSION['username'], $_SESSION['password'],"mydatabase");

if(!(($_POST['id']=="")||($_POST['password']==""))){
	if($_POST['password']==$_POST['passwordagain']){
		$result = $conn->query("SELECT * FROM projectmanager WHERE id='".$_POST['id']."'");
		if($result){
			
			$row = $result->fetch_assoc();
			$conn->query("SELECT * FROM projectmanager WHERE id='".$_POST['id']."'");
			
			
			if($conn->query("SET PASSWORD FOR ".$row['username']."@localhost = PASSWORD('".$_POST['password']."')")){
				echo "Password has been changed for user ".$row['username'];
				echo "<form action='./editprojectmanagers.php'>
				<input type='submit' value='To go back press' />
				</form>";
				
			}else{
				echo "Sorry, some error happened while changing your pass".$conn->error;
				echo "<form action='./editprojectmanagers.php' method='get'>
				<input type='submit' value='To go back press' name='update'/>
				</form>";
			}
		}else{
			echo "Sorry, there is not a project manager with that id";
				echo "<form action='./editprojectmanagers.php' method='get'>
				<input type='submit' value='To go back press' name='update'/>
				</form>";
			
		}
	}else{
		echo "Sorry, the passwords did not match.";
				echo "<form action='./editprojectmanagers.php' method='get'>
				<input type='submit' value='To go back press' name='update'/>
				</form>";

	}	
}else if((($_POST['id']=="")||($_POST['password']==""))){
	echo "Error: Don't leave box(es) empty";
			echo "<form action='./editprojectmanagers.php' method='get'>
				<input type='submit' value='To go back press' name='update'/>
				</form>";
}



?>