<?php  

	session_start();
	include('connection.php');

	$messages_query = "SELECT * FROM users
					   JOIN messages 
					   ON users.id = messages.user_id
					   ORDER BY messages.created_at DESC";
	$_SESSION['all_messages'] = fetch($messages_query);

	if(!empty($_POST['action']) && $_POST['action'] == 'register')
	{	
		if(empty($_POST['f_name']) || is_numeric($_POST['f_name']))
		{
			$_SESSION['errors'][] = 'Please use a proper first name, without numbers';
		}
		if(empty($_POST['l_name']) || is_numeric($_POST['l_name']))
		{
			$_SESSION['errors'][] = 'Please use a proper last name, without numbers';
		}
		if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
			$_SESSION['errors'][] = 'Please use a valid email address';
		}
		if(empty($_POST['password']) || strlen($_POST['password']) < 6)
		{
			$_SESSION['errors'][] = 'Please use a password longer than 6 characters';
		}
		if($_POST['confirm_pass'] !== $_POST['password'])
		{
			$_SESSION['errors'][] = 'Passwords do not match';
		}
		else
		{
			$query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at)
					  VALUES('{$_POST['f_name']}', '{$_POST['l_name']}', '{$_POST['email']}', '{$_POST['password']}',
					  NOW(), NOW())";
			if(!run_mysql_query($query))
			{
				$_SESSION['errors'][] = 'Something went wrong, please try again soon!';
			}
			else
			{
				$_SESSION['success_message'] = 'Successfully registered! You may now login below!';
			}
		}
		header('location: index.php');
		die();
	}
	elseif(!empty($_POST['action']) && $_POST['action'] == 'login')
	{
		$query = "SELECT * FROM users WHERE users.email = '{$_POST['email']}'
				  AND users.password = '{$_POST['password']}'";
		$user_query = fetch($query);
		// var_dump($user_query);
		// die();

		if(count($user_query) > 0)
		{
			$_SESSION['user_id'] = $user_query[0]['id'];
			$_SESSION['user_name'] = $user_query[0]['first_name'];
			$_SESSION['logged_in'] = TRUE;
			// var_dump($user_query);
			header('location: success.php');
			die();
		}
		else
		{
			$_SESSION['errors'][] = 'User not found. Please try again!';
			header('location: index.php');
			die();
		}
	}
	elseif(!empty($_POST['action']) && $_POST['action'] == 'post_message')
	{
		if(empty($_POST['message']))
		{
			$_SESSION['errors'][] = 'You must type something within the message field to post a message!';
		}
		else
		{
			$query_mess = "INSERT INTO messages (user_id, message, created_at, updated_at)
					  	   VALUES('{$_SESSION['user_id']}', '{$_POST['message']}', NOW(), NOW())";
			if(!run_mysql_query($query_mess))
			{
				$_SESSION['errors'][] = 'We have encountered an error! Please submit your message again!';
			}
			else
			{
				$_SESSION['message_success'] = 'Congratulations! Your message has been posted!';
			}		  
		}
		header('location: success.php');
		die();
	}
	else //malicious navigation, or someone is logging off
	{
		session_destroy();
		header('location: index.php');
		die();
	}

?>