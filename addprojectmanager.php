<?php
session_start();

$conn = new mysqli("localhost", $_SESSION['username'], $_SESSION['password'],"mydatabase");

if(!(($_POST['username']=="") || ($_POST['password']==""))){
	if($_POST['passwordagain']==$_POST['password']){
		$result = $conn->query("CREATE USER ".$_POST['username']."@localhost IDENTIFIED BY '".$_POST['password']."'");

		if($result){
			$conn->query("GRANT SELECT, INSERT, UPDATE, DELETE ON *.* TO ".$_POST['username']."@localhost REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0");
			
			$conn->query("INSERT INTO projectmanager (id,username) VALUES ('".$_POST['id']."','".$_POST['username']."')");
				
				echo "User is added. To go back press:
					<form action='./editprojectmanagers.php'>
					<input type='submit' value='Press'/>
					</form>";
			
		}else{
			
			echo "Error:".$conn->error;
				echo "<form action='./editprojectmanagers.php' method='get'>
					<input type='submit' value='Clikc' name='add'/>
					</form>";
		}
	}else{
		
		echo "Error: Passwords are not same";
				echo "<form action='./editprojectmanagers.php' method='get'>
					<input type='submit' value='To go back press' name='add'/>
					</form>";
	}
}
else if(($_POST['username']=="") || ($_POST['password']=="")){
	echo "Error: Don't leave any box empty. ";
				echo "<form action='./editprojectmanagers.php' method='get'>
					<input type='submit' value='To go back press' name='add'/>
					</form>";
	
}



?>