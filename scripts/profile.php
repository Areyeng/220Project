<?php
  if(!isset($_SESSION['email'])) {
		die("<div class='alert alert-warning'>
			You need to be logged in to view this page
			<a href='../views/login-view.php'>Click here to go to login page</a>
		</div>");
	}

  $message = "";

  if(isset($_POST['name'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $favoriteWines = $_POST['favourite_wines'];
    $contactDetails = $_POST['contact_details'];

    $updateName = queryMysql("UPDATE tbusers SET name='$name', surname='$surname', wine='$favoriteWines', email='$contactDetails'  WHERE email='" . $_SESSION['email'] . "'");
    $_SESSION['email'] = $contactDetails;
    if($updateName) {
      $message = buildMessageDiv("User updated successfully", "success");
    }else {
      $message = buildMessageDiv($mysqli->error, "error");
    }
  }

  if(isset($_POST['changeDp'])){
    $folder = "../gallery/";
    $uploadFile = $_FILES["profile"];
    $numFiles = count($uploadFile["name"]);

    $uploadSuccess = false;
    
    for($i = 0; $i < $numFiles; $i++){
      if( ($uploadFile["type"][$i] == "image/jpeg" 
      || $uploadFile["type"][$i] == "image/pjpeg"
      || $uploadFile["type"][$i] == "image/png") && $uploadFile["size"][$i] < 1000000){
        if($uploadFile["error"][$i] > 0){
          $message = buildMessageDiv("Error: " . $uploadFile["error"][$i] . "<br/>", "error");
        }
        else{ 
          $target_file=$folder . basename($uploadFile["name"][$i]);
          if(move_uploaded_file($uploadFile["tmp_name"][$i], $target_file))
          {
            $saveDp = queryMysql("UPDATE tbusers SET profile_pic='" . $uploadFile["name"][$i] . "' WHERE email = '" . $_SESSION['email'] . "'");
            if($saveDp) {
              $message = buildMessageDiv("Picture changed successfully", "success");
            }else {
              $message = buildMessageDiv("Failed to change picture, please try again later", "error");
            }
          }else{
            $message = buildMessageDiv("Sorry, there was an error uploading your file", "error");
          }
        }
      }
    }
  }
?>