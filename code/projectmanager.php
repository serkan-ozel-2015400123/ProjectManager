<?php
session_start();

?>
<!DOCTYPE html>

<html>
<head>
<title>Project manager home page</title>
<?php

 echo "Welcome ".$_SESSION['username'];
 
?>

</head>

<body>


<form action="edittasks.php">
<p>To add/update/delete tasks press this button:</p><input type="submit" value="Go to tasks page"/>
</form>
<form action="storedproceduremanager.php">
<p>To see compelete and incomplete projects: </p><input type="submit" value="Go to stored procedure page"/>
</form>
<br>
<form action="index.php">
<input type="submit" value="Log out"/>
</form>

</body>

</html>