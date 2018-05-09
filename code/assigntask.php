
<?php
session_start();

$conn = new mysqli("localhost", $_SESSION['username'], $_SESSION['password'],"mydatabase");

$projectsOwnedByProjectManager = $conn->query("SELECT * FROM projectmanager_project WHERE project_manager_id ='".$_SESSION['projectmanagerid']."'");

if($projectsOwnedByProjectManager){
	$projectids = array();
	while($projectsarray = $projectsOwnedByProjectManager->fetch_array()){
		array_push($projectids,$projectsarray[1]);
	}
	$taskExist = $conn->query("SELECT * FROM task WHERE id='".$_GET['taskid']."'");
	if($taskExist){
		$theTask = $taskExist->fetch_assoc();
		if(in_array($theTask['project_id'],$projectids)){
			
			
			$tasksOfTheEmployee=  $conn->query("SELECT task_id FROM employee_task WHERE employee_id = '".$_GET['employeeid']."'");
			
			$startdates = array();
			if($tasksOfTheEmployee){
				while($row = $tasksOfTheEmployee->fetch_array()){
					$dateresult = $conn->query("SELECT date FROM task WHERE id = '".$row[0]."'");
					if($dateresult){
						array_push($startdates,$dateresult->fetch_array()[0]);
					}
				}
				
			}
			
			if(!in_array($theTask['date'],$startdates)){
				$result = $conn->query("INSERT INTO employee_task (employee_id,task_id) VALUES ('".$_GET['employeeid']."','".$_GET['taskid']."')");
				if($result){
					echo "Assigned.";
					echo "<form action='edittasks.php'>
					<input type='submit' value='To go back press'/>
					</form>";
					
				}else{
					echo "Sorry, there is an error with INSERT query :".$conn->error;
					echo "<form action='edittasks.php' method='get'>
					<input type='submit' value='To go back press' name= 'assign'/>
					</form>";
				}
			}else{
				echo "Sorry, there is another task on that employee on the same date.";
				echo "<form action='edittasks.php' method='get'>
				<input type='submit' value='To go back press' name= 'assign'/>
				</form>";
			}
			
		
		}else{
			echo "Sorry, you are trying to assign a task which is not in your project.";
			echo "<form action='edittasks.php' method='get'>
			<input type='submit' value='To go back press' name= 'assign'/>
			</form>";
		}
	}else{
		echo "Sorry, the task doesn't exist in the database.";
		echo "<form action='edittasks.php' method='get'>
		<input type='submit' value='To go back press' name= 'assign'/>
		</form>";
		
	}
	
	
}else{
	echo "Sorry you don't have any projects yet.";
	echo "<form action='edittasks.php'>
		<input type='submit' value='To go back press'/>
		</form>";
}	



?>