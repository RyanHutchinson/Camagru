<?php
	define("SERVERNAME", "localhost");
	define("DB_USERNAME", "admin");
	define("DB_PASS", "1234");
	$conn = new mysqli(SERVERNAME, DB_USERNAME, DB_PASS);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
?>