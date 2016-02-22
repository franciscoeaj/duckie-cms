<?php

function get_connection() {
	$conn = "mysql:dbname=thinkabi_demo-cms;host=localhost";
	$user = "thinkabi_demousr";
	$pass = "banjo";

	try {
		$dbh = new PDO($conn, $user, $pass);
		return $dbh;
	} catch (PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
		return NULL;
	}
}