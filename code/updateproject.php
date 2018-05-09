<?php
session_start();

$conn = new mysqli("localhost", $_SESSION['username'], $_SESSION['password'],"mydatabase");

if($_POST['id']!=""){
		$result = $conn->query("UPDATE project SET id = '".$_POST['newid']."', name='".$_POST['name']."', start_date = '".$_POST['startdate']."', estimated_total_work_days = '".$_POST['estimatedtotalworkdays']."', area= '".$_POST['area']."', status='".$_POST['status']."' WHERE project.id = '".$_POST['id']."'");
		
		if($result){
			echo "Project is updated. To go back press:
			<form action='./editprojects.php'>
			<input type='submit' value='Press'/>
			</form>";
		}else{
			echo "Error: Error while updating project: ".$conn->error;
			echo "<form action='./editprojects.php' method='get'>
			<input type='submit' value='Click to go back' name='update'/>
			</form>";
		}
	
}    
else if($_POST['id']== ""){
	echo "Error: Don't leave id empty. ";
	echo "<form action='./editprojects.php' method='get'>
	<input type='submit' value='To go back press' name='update'/>
	</form>";
	
}



?>