<?php
  $message = "";
  if(!isset($_SESSION['email'])) {
		die("<div class='alert alert-warning'>
			You need to be logged in to view this page
			<a href='../views/login-view.php'>Click here to go to login page</a>
		</div>");
	}
?>