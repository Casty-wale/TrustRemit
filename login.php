<?php

	//User login checks.
	session_start();
	require_once 'includes/connect.php';

	if(isset($_POST['login'])){
		$email = $_POST['email'];
		$password = $_POST['pass'];
				// $h_np = password_hash(123, PASSWORD_DEFAULT);
				// echo $h_np;
				// $sql_1 = "UPDATE admin SET password = '$h_np' WHERE id = 2";
				// $query1 = $con->query($sql_1);
		$sql = "SELECT * FROM admin WHERE email = '$email'";
		$query1 = $con->query($sql);
		if($query1->num_rows < 1){
			$_SESSION['error'] = 'User does not exist';
		}
		else{
			$row = $query1->fetch_assoc();
			if(password_verify($password, $row['password'])){
				$_SESSION['admin'] = $row['id'];
				// $_SESSION['user'] = $row['username'];
				// $_SESSION['access'] = $row['access'];
				// header('location: meme.php');
				// exit();
			}
			else{
				$_SESSION['error'] = 'Incorrect password';
			}
		}
		
	}
	else{
		$_SESSION['error'] = 'Input User credentials first';
	}

	header('location: index.php');

?>