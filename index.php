<?php
	session_start();
 //var_dump($_SESSION);
  	
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>DDR_User Login</title>
</head>
<body>
<?php

	
if(isset($_SESSION['errors']))
	{
		foreach ($_SESSION['errors'] as $error)
		{
			echo $error."<br>";
		}
		unset($_SESSION['errors']);
	} 

if(isset($_SESSION['auth_mess']))	
	{
			echo $_SESSION['auth_mess']."<br>";
 	
 		unset($_SESSION['auth_mess']);		
 
	}

	
?>
	<h3 id="login">
		Login
		<h4>
<form id="login" action="process.php" method="post">
			<Label for="email">Email *</label>
				<input type="text" name="email" placeholder="Email"/><br>
			<Label for="password">Password *</label>
				<input type="password" name="password" placeholder="Password"/><br>
				<input type="submit" value="login">
				<input type = "hidden" name="action" value="login"	/>	

		</form>
		</h4>
	</h3>
	<h3 id="register">
		Register
	</h3>
		<h4>
		<form action="process.php" method="post">
			<input type="hidden" name="action" value="register"/>
			
			<Label for="first_name">First Name *</label><input type="text" name="first_name" placeholder="First Name"/><br/>
			<Label for="last_name">Last Name *</label><input type="text" name="last_name" placeholder="Last Name"/><br/>
			<Label for="email">Email *</label><input type="text" name="email" placeholder="Email address"/><br/>
			<Label for="password">Password *</label><input type="password" name="password" placeholder="Password"/><br/>
			<Label for="confirm_password">Confirm Password *</label><input type="password" name="confirm_password" placeholder="Confirm Password"/><br>
			<input type="submit" value="register"/>
	</form>
	</h4>	
</body>
</html>
<?php
unset($_SESSION['errors']);
?>