<?php
session_start();
require('connection.php');


 // var_dump($_SESSION);
 // die();

if(isset($_SESSION['logged_in']))
{
	header('location: index.php');
}
 	
	$query = "SELECT messages.*, users.id FROM messages LEFT JOIN users ON users.id = messages.user_id ORDER BY messages.created_at DESC";
		
		// echo $query;
		// die();
	$messages = fetch_all($query);



// var_dump($messages);
?>
<html>
<head>
	<title></title>
</head>
<body>
	<div id="welcome"
	<?php 
	echo "<h4>Welcome to the WALL {$_SESSION['user']['first_name']}</h4>";
	?>
	</div>
	<div id="logoff">
		<a href='process.php'> Log off</a>
	</div>


	
	<form action = 'process.php' method = 'post'>
		<textarea name = 'message'></textarea>
		<input type = 'hidden' name = 'action' value = 'message'>
		<input type = 'submit' value = 'message'>
	</form>

	<div id = 'content'>
	<?php
			foreach($messages as $message)
			{
				echo "<h3> {$_SESSION['user']['first_name']} {$_SESSION['user']['last_name']} - {$message['created_at']} </h3>
					  <h4>{$message['message']}</h4><form action = 'process.php' method = 'post'>
		<textarea name = 'comment'></textarea>
		<input type = 'hidden' name = 'action' value = 'comment'>
		<input type = 'submit' value = 'comment'>
	</form>";
			}
?>		


<?php

function ordinal($num)
{
    // Special case "teenth"
    if ( ($num / 10) % 10 != 1 )
    {
        // Handle 1st, 2nd, 3rd
        switch( $num % 10 )
        {
            case 1: return $num . 'st';
            case 2: return $num . 'nd';
            case 3: return $num . 'rd';  
        }
    }
    // Everything else is "nth"
    return $num . 'th';
}







	?>
	</div>	
</body>
</html>

