<?php
	// start session
	session_start();
	// See all errors and warnings
	error_reporting(E_ALL);
	ini_set('error_reporting', E_ALL);

	//$mysqli = mysqli_connect("localhost", "u18386840", //"homstpyw@U18386840", "u18386840");
	$mysqli = new mysqli("localhost", "root", "", "deliverable");
	if (!$mysqli) {
		die("Database connection failed: " . mysqli_connect_error());
	}

	/* if(!isset($_SESSION['email'])) {
		die("<div class='alert alert-warning'>
			You need to be logged in to view this page
			<a href='../views/login-view.php'>Click here to go to login page</a>
		</div>");
	} */

	function queryMysql($query) {
		global $mysqli;
		return $mysqli->query($query);
	}

	/**
	 * valid types: error, success, info, warning
	 */
	function buildMessageDiv($msg, $type) {
		return "<div class='alert alert-$type'>$msg</div>'";		
	}

	function logout() {
		session_destroy();
	}
?>