<?php
session_start();
require('connection.php');

// var_dump($_SESSION);
if (isset($_POST['action']) and $_POST['action'] =='register')

{
	$_SESSION['errors'] = array();
	
	if (empty($_POST['email']) or empty($_POST['password']) or empty($_POST['confirm_password']))  //or empty($_POST['username']))
	{
		$_SESSION['errors'][] = "Please Complete all Fields";
	}
	
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	{
		$_SESSION['errors'][] = "Your email is invalid";
	}
	
	if (!unique($_POST['email']))

	{
		$_SESSION['errors'][] = "Your email already exists";
	}	

	if(strlen($_POST['password'])<6)
	
	{
		$_SESSION['errors'][] = "Passwords must be at least 6 characters";
	}

	if($_POST['password'] !== $_POST['confirm_password'])
	{
		$_SESSION['errors'][] = "Passwords must match";
	}
	
	if(count($_SESSION['errors'])<1)
	{
	 	$_SESSION['errors'][] = 'Registration Successful';
		$first_name = mysql_real_escape_string($_POST['first_name']);
		$last_name = mysql_real_escape_string($_POST['last_name']);
		$email = mysql_real_escape_string($_POST['email']);
		$password = md5($_POST['password']);
		
		$query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) VALUES ('{$first_name}','{$last_name}','{$email}', '{$password}', NOW(), NOW())";
	// 	echo $query;
	// die();
		mysql_query($query);

	 }
	 	
	 	header('location: index.php');
}

elseif(isset($_POST['action']) and $_POST['action'] =='login') 

{
	

 	$password = md5($_POST['password']);
	$email = mysql_real_escape_string($_POST['email']);
	$query = "SELECT * FROM users WHERE email ='{$email}' AND password ='{$password}'";
	// echo $query;
	// die();
	
	$user = fetch_all($query);
	if(count($user) < 1)
	{

	 	$_SESSION['auth_mess'] = 'Authentication unsuccessful';
		
// var_dump($_SESSION);
		header('location: index.php');

	}
	else  
	{
 		$_SESSION['logged in'] = true;
 		$_SESSION['user']['id'] = $user[0]['id'];
 		$_SESSION['user']['email'] =$user[0]['email'];
 		$_SESSION['user']['first_name'] =$user[0]['first_name'];
 		$_SESSION['user']['last_name'] =$user[0]['last_name'];
 		
		
		header('location: home.php');
		
	} 
	
}
elseif(isset($_POST['action']) AND $_POST['action'] == 'message')
{
	$message = mysql_real_escape_string($_POST['message']);
	$id = $_SESSION['user']['id'];
	$query = "INSERT INTO messages (message, user_id, created_at, updated_at) VALUES ('{$message}', '{$id}', NOW(), NOW())";
	mysql_query($query);
	header('location: home.php');
}

elseif(isset($_POST['action']) AND $_POST['action'] == 'comment')
{
	$comment = mysql_real_escape_string($_POST['comment']);
	$id = $_SESSION['user']['id'];
	$query = "INSERT INTO comments (message_id, comment, user_id, created_at, updated_at) VALUES ('{$message_id}','{$comment}', '{$id}', NOW(), NOW())";
	mysql_query($query);
	header('location: home.php');
}	

else
{

session_destroy();

}




function unique($email)  
{
	$esc_email = mysql_real_escape_string($email);
	$query = "SELECT * FROM users WHERE email = '{$esc_email}'";
	$result = fetch_all($query);
	if(count($result) > 0)
	{
		return false;
	}	
	else 
	{
		return true;
	}
}


?>