<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bauteildatenbank";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password,  $dbname);
		
	// Check connection
	if ($conn->connect_error) {
		echo "Connection failed";
		mysqli_close($conn);
	} 
?>