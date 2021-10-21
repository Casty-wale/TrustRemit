<?php
	// require_once 'connect.php';
	// session_start();

	// if(isset($_SESSION['admin'])){
	// 	$sql = "SELECT * FROM admin WHERE id = '".$_SESSION['admin']."'";
	// 	$query = $con->query($sql);
	// 	$user = $query->fetch_assoc();
	// }
	// else{
	// 	header('location: index.php');
	// 	exit();
	// }

	$_SESSION['user'] = "Kofi Owusu";
	$_SESSION['access'] = "User"
?>