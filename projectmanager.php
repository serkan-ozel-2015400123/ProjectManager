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


<form action="assigntask.php">
<p>To add/update/delete tasks press this button:</p><input type="submit" value="Go to tasks page"/>
</form>
<br>
<form action="index.php">
<input type="submit" value="Log out"/>
</form>

</body>

</html>