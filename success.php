<?php  

	session_start();
	include('connection.php');

	if(empty($_SESSION['user_name']))
	{
		$_SESSION['errors'][] = 'You lousy little cheat. Play fair next time!';
		header('location: index.php');
		die();
	}

	$messages_query = "SELECT users.id AS user_id, users.first_name AS first_name, users.last_name AS last_name,
					   messages.message AS message, messages.created_at AS created_at, messages.id AS id 
					   FROM users
					   JOIN messages 
					   ON users.id = messages.user_id
					   ORDER BY created_at DESC";
	$all_messages = fetch($messages_query);

	$comment_query = "SELECT users.first_name AS first_name, users.last_name AS last_name,
					  comments.coment AS comment, comments.created_at AS created_at,
					  comments.message_id AS message_id
					  FROM users
					  JOIN comments on users.id = comments.user_id";
	$comments = fetch($comment_query);

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
		.bold
		{
			font-weight: bold;
		}
		#header
		{
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
		#delete
		{
			display: block;
			padding: .3em .5em;
			background-color: red;
			color: white;
			margin-left: 92%;

		}
		#submit_message
		{
			display: block;
			padding: .3em .5em;
			background-color: blue;
			color: white;
			margin-left: 92%;
		}
		#submit_comment
		{
			display: block;
			padding: .3em .5em;
			background-color: green;
			color: white;
			margin-left: 92%;
		}
		.indent
		{
			padding-left: 2em;
		}
		.comments
		{
			padding-left: 2.5em;
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
				foreach($all_messages as $message)
				{
					echo '<p class="bold">'.$message['first_name'].' '.$message['last_name'].' - '
					.$message['created_at'].'</p><br>'.
					'<p class="indent">'.$message['message'].'</p>';
					if($_SESSION['user_id'] == $message['user_id'])
					{
						echo '<form action="process.php" method="post">
								<input type="hidden" name="row" value="'.$message["id"].'">
								<input type="hidden" name="action" value="delete">
							  	<input type="submit" value="Delete message" id="delete">
							  </form>';
					}

					if(!empty($comments))
					{
						foreach($comments as $comment)
						{
							if($message['id'] == $comment['message_id'])
							{
								echo '<div class="comments"><p class="bold">'.$comment['first_name'].
									 ' '.$comment['last_name'].' - '.$comment['created_at'].'</p>
									 <p>'.$comment['comment'].'</p></div>';
							}
						}
					
					}
					echo '<p>Post a comment</p>
						  <form action="process.php" method="post">
						  	<textarea name="comment" cols="195" rows="5"></textarea>
						  	<input type="hidden" name="action" value="post_comment" >
						  	<input type="hidden" name="message_id" value="'.$message['id'].'">
						  	<input type="submit" id="submit_comment" value="Post a comment">
						  </form>';
				}
			}
		?>
	</div>
</body>
</html>