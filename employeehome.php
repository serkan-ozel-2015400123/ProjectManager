

<html>
<head>
<title>Employer Task Information Page</title>
</head>
<body>
<h1>Welcome to project management system, our precious employee!</h1>
<h3> Please enter your name here to see your task today!</h3>
<?php
	if(isset($_GET['message'])) {
		echo "Unable to retrieve information: ". $_GET['message'];
	}
?>
<form action="employeequery.php" method="get"><p>Your name: </p><input type="text" name="name"/>
<input type="submit" value="Submit"/>
</form>
</body>

</html>