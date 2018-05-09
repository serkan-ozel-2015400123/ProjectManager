<?php
session_start();

?>
<!DOCTYPE html>

<html>
<head>
<title>Admin home page</title>
<?php

 echo "Welcome ".$_SESSION['username'];
?>

</head>

<body>


<form action="editprojectmanagers.php">
<p>To add/update/delete project managers press this button:</p><input type="submit" value="Go to project managers page"/>
</form>
<br>
<form action="editprojects.php">
<p>To add/update/delete projects press this button:</p><input type="submit" value="Go to project management page"/>
</form>
<br>
<form action="editemployees.php">
<p>To add/update/delete employees press this button:</p><input type="submit" value="Go to employee management page"/>
</form>
<br>
<form action="storedprocedureadmin.php">
<p>To see compelete and incomplete projects: </p><input type="submit" value="Go to stored procedure page"/>
</form>



<form action="index.php">
<input type="submit" value="Log out"/>
</form>

</body>

</html>