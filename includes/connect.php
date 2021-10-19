<?php
	$hostName = "localhost";
	$Username = "root";
	$passWD = "";
	$db_name = "trustremit";
	$con = mysqli_connect($hostName, $Username, $passWD, $db_name);

	if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>