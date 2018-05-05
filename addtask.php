
<?php
session_start();

$conn = new mysqli("localhost", $_SESSION['username'], $_SESSION['password'],"mydatabase");

$projectsresult = $conn->query("SELECT id FROM project WHERE project_manager_id ='".$_SESSION['projectmanagerid']."'");
if($projectsresult){
	$projectsarray = $projectsresult->fetch_array();
	if(in_array($_GET['projectid'],$projectsarray)){
		
		$result = $conn->query("INSERT INTO task (id,name,date,days,project_id,employee_id) VALUES ("."'".$_GET['taskid']."'".','."'".$_GET['name']."'".","."'".$_GET['date']."'".","."'".$_GET['days']."'".","."'".$_GET['projectid']
		."'".','."'".$_GET['employeeid']."'".")");

		if($result){
			echo "<h4>Task is added. To go back press:</h4>
				<form action='./assigntask.php' method='get'>
				<input type='submit' value='Press' name='add'/>
				</form>";
			
		}else{
			
			echo "Error: ".$conn->error;
			echo "<form action='./assigntask.php' method='get'>
				<input type='submit' value='To go back press' name='add'/>
				</form>";
		}
	}else{
		echo "Sorry, you are not the manager of that project.";
		echo "<form action='./assigntask.php' method='get'>
		<input type='submit' value='To go back press' name= 'add'/>
		</form>";
		
		
	}
}else{
	echo "Sorry you don't have any projects yet.";
	echo "<form action='assigntask.php'>
		<input type='submit' value='To go back press'/>
		</form>";
}	



?>