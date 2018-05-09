
<?php
session_start();

$conn = new mysqli("localhost", $_SESSION['username'], $_SESSION['password'],"mydatabase");

$projectsOwnedByProjectManager = $conn->query("SELECT * FROM projectmanager_project WHERE project_manager_id ='".$_SESSION['projectmanagerid']."'");
		
if($projectsOwnedByProjectManager){
	$notin = true;
	while($projectsarray = $projectsOwnedByProjectManager->fetch_array()){
		if(in_array($_GET['projectid'],$projectsarray)){
			$notin = false;
			$result = $conn->query("INSERT INTO task (id,name,date,days,project_id) VALUES ('".$_GET['taskid']."','".$_GET['name']."','".$_GET['date']."','".$_GET['days']."'
			,'".$_GET['employeeid']."')");

			if($result){
				echo "<h4>Task is added. To go back press:</h4>
					<form action='edittasks.php' method='get'>
					<input type='submit' value='Press' name='add'/>
					</form>";
				
			}else{
				
				echo "Error: ".$conn->error;
				echo "<form action='edittasks.php' method='get'>
					<input type='submit' value='To go back press' name='add'/>
					</form>";
			}
		}
	}
	
	if($notin){
		echo "Sorry, you are not the manager of that project.";
		echo "<form action='edittasks.php' method='get'>
		<input type='submit' value='To go back press' name= 'add'/>
		</form>";
		
		
	}
	
}else{
	echo "Sorry you don't have any projects yet.";
	echo "<form action='edittasks.php'>
		<input type='submit' value='To go back press'/>
		</form>";
}	



?>