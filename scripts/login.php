<?php
  $message = "";
  if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // fetch user with matching credentials
    $results = queryMysql("SELECT * FROM tbusers WHERE email='$email' AND password='$password'");

    if($results->num_rows > 0) {
      $user = $results->fetch_assoc();
      // sign in successful
      $_SESSION['email'] = $user['email'];
      header("location: quiz-view.php");
    } else {
      // incorrect credentials
      $message = "<div class='alert alert-danger'>Incorrect email or password provided<div>";
    }
  }

  if(isset($_POST['remail'])) {
    $email = $_POST['remail'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $favWine = $_POST['favwine'];
    $password = $_POST['password'];

    $reg = queryMysql("INSERT INTO tbusers VALUES('', '$fname', '$lname', '$email', '$password', '$favWine', '')");
    if($reg) {
      $message = buildMessageDiv("Sign up successful, you can proceed to login", "success");
    } else {
      $message = buildMessageDiv("Sign up unsuccessful, please try again later", "error");
      echo $mysqli->error;
    }
  }
?> 