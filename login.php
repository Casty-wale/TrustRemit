<?php

	//User login checks.
	session_start();
	//require_once 'includes/connect.php';

	if(isset($_POST['login'])){
		$email = $_POST['email'];
		$password = $_POST['pass'];
		$personal = "kofi@gmail.com";
		$h_np = password_hash("@123", PASSWORD_DEFAULT);

		$neat = password_verify($password, $h_np);
		
		if($email != $personal || $neat != 1){
			$_SESSION['error'] = 'Wrong input';
		}
		else{
			if($email == $personal && $neat = 1){
				// $_SESSION['admin'] = $row['id'];
				$_SESSION['user'] = "Kofi Owusu";
				$_SESSION['access'] = "User";
				header('location: home.php');
				exit();
			}
		}
		
	}
	else{
		$_SESSION['error'] = 'Input User credentials first';
	}

	// header('location: index.php');

?>