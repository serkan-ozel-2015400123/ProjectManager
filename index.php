
<?php
session_start();
session_unset();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Project Management System</title>
    </head>
    <body>
	
		<h1> Welcome to project management system!</h1>
		<br>
		<p> To login,</p>
			<ul>
				<li> If you are an admin, enter your admin login information.</li>
				<li> If you are a project manager, enter your project manager login information.</li>
				<li> If you are an employee, press employee button below. </li>
			</ul>
			
        <form action="./" method="post">
         <p>Your username: <input type="text" name="username" /></p>
         <p>Your password: <input type="password" name="password" /></p>
         <p><input type="submit" value="Login" /></p>
        </form>
		
		
		<form action="employeehome.php">
		<input type="submit" value="I am an employee" />
		</form>
		
<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
     $_SESSION['username'] = $_POST['username'];
	 $_SESSION['password'] = $_POST['password'];
	 unset($_POST);
	 echo "<script type='text/javascript'>
		   window.location.href = './home.php'
			</script>";
	 
}
?> 
		
    </body>
</html>
