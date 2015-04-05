<?php  

	session_start();
	require('connection.php');

	if(!empty($_POST['action']) && $_POST['action'] == 'post_message')
	{
		if(empty($_POST['message']))
		{
			$_SESSION['errors'][] = 'You must type something within the message field to post a message!';
		}
		else
		{
			$query = "INSERT INTO messages (user_id, message, created_at, updated_at)
					  VALUES('{$_SESSION['user_id']}', '{$_POST['message']}', NOW(), NOW())";
			// run_mysql_query($query);
			if(run_mysql_query($query))
			{
				$_SESSION['message_success'] = 'Congratulations! Your message has been posted!';
				$messages_query = "SELECT * FROM users
								   JOIN messages 
								   ON users.id = messages.user_id
								   ORDER BY messages.created_at DESC";
				$_SESSION['all_messages'] = fetch($messages_query);
			}
			else
			{
				$_SESSION['errors'][] = 'We have encountered an error! Please submit your message again!';
			}		  
		}
		header('location: success.php');
		die();
	}

?>