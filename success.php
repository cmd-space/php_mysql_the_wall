<?php  

	session_start();
	include('connection.php');

	if(empty($_SESSION['user_name']))
	{
		$_SESSION['errors'][] = 'You lousy little cheat. Play fair next time!';
		header('location: index.php');
		die();
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Success</title>
	<style>
		*
		{
			margin-top: .25em;
			margin-bottom: .25em;
			font-family: sans-serif;
		}
		#header
		{
			/*padding-bottom: .25em;
			padding-top: .25em;*/
			border-bottom: 1px solid black;
		}
		#header h2,
		#header a,
		#header p
		{
			display: inline-block;
		}
		#header p
		{
			padding-left: 70%;
		}
		#header a
		{
			padding-left: 1em;
		}
		.error
		{
			color: red;
		}
		.success
		{
			color: green;
		}
		#message_output,
		#messages
		{
			width: 80%;
			margin-left: auto;
			margin-right: auto;
		}
		#submit_message
		{
			display: block;
			padding: .3em .5em;
			background-color: blue;
			color: white;
			margin-left: 92%;
		}
	</style>
</head>
<body>
	<div id='header'>
		<h2>CodingDojo Wall</h2>
		<p>Welcome <?=$_SESSION['user_name']?>!</p>
		<a href="process.php">Logout</a>
	</div>
	<?php  
		if(!empty($_SESSION['errors']))
		{
			foreach($_SESSION['errors'] as $error)
			{
				echo '<p class="error">'.$error.'</p>';
			}
			unset($_SESSION['errors']);
		}
		if(!empty($_SESSION['message_success']))
		{
			echo '<p class="success">'.$_SESSION['message_success'].'</p>';
			unset($_SESSION['message_success']);
		}
	?>
	<div id='messages'>
		<p>Post a message</p>
		<form action="process.php" method="post">
			<textarea name="message" cols="200" rows="10"></textarea>
			<input type="hidden" name="action" value="post_message" >
			<input type="submit" id="submit_message" value="Post a message">
		</form>
	</div>
	<div id="message_output">
		<?php
			if(!empty($_SESSION['all_messages']))
			{
				foreach($_SESSION['all_messages'] as $message)
				{
					// var_dump($message);  
					echo $message['first_name'].' '.$message['last_name'].' - '
					.$message['created_at'].'<br>'.
					'<p class="indent">'.$message['message'].'</p>';
				}
			}
			// unset($_SESSION['all_messages']);
		?>
	</div>
</body>
</html>