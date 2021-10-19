<?php
	include 'includes/session.php';
	
    if(isset($_GET['return'])){

		$return = $_GET['return'];
		
	}

	if(isset($_POST['add'])){
		$username = $_POST['username'];
		$email = $_POST['email'];
		$passwd = $_POST['password'];
		$position = $_POST['position'];

		$password = password_hash($passwd, PASSWORD_DEFAULT);

		$sql = "INSERT INTO admin (username, password, email, access) 
		VALUES ('$username', '$password', '$email', '$position')";
		if($con->query($sql)){
			$return = 'User added successfully';
		}
		else{
			$return = $con->error;
		}

	}
	else{
		$return = 'Fill up add form first';
	}

	header('location:home.php?'.$return);
?>