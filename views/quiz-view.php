<?php
  require_once('../scripts/functions.php');
  require_once('../scripts/quiz.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>IMY 220 - Deliverable</title>
	<meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative&family=Urbanist:wght@100&display=swap" rel="stylesheet">
	<meta charset="utf-8" />
	<meta name="author" content="Areyeng Mphahlele">
	<!-- Replace Name Surname with your name and surname -->
</head>
<body>
<div class="container-fluid p-0">
  <div class="bg-image">
    <?php
      $res = $mysqli->query("SELECT * FROM tbusers WHERE email='" . $_SESSION['email'] . "'");
      
			if($res->num_rows > 0)
			{
        $row = $res->fetch_assoc();
				echo "
					<div class='row'>
					  <div class='col offset-md-1'>
						<div class='card'>
						  <div class='card-body'>
						 
						    <h1 class='text-center'>SIP' N SPILL</h1>
						   
						    <p>
						    <h6><b>Wine Connoiseur</b></h6>
													<h6>". $row['name'] ." ". $row['surname'] ."</h6>
													<h6><b>Favourite Wines</b></h6>
													<h6>" . $row['wine'] . "</h6>
													<h6><b>Contact Details</b></h6>
													<h6>" . $row['email'] . "</h6></p>
							<a href='profile-view.php' class='btn btn-dark' role='button'>Edit Profile</a>						
							
						  <form action='quiz-view.php' method='POST' enctype='multipart/form-data'>
								<label for='quizName'>Quiz Name</label><br>
								<input type='text' class='form-control' name='qName'
									id='picToUpload'  /><br/>
								<label for='quizDescription'>Quiz Description</label><br>
								<input type='text' class='form-control' name='quizDescription'
									id='picToUpload'  /><br/>
								<label for='quizHashtag'>Hashtags</label><br>
								<input type='text' class='form-control' name='qHashtag'
									id='picToUpload'/><br/>
								<input type='file' class='form-control' name='picToUpload[]' id='picToUpload' multiple='multiple' /><br/>
								<input type='submit' class='btn btn-dark' value='Upload Quiz' name='uploadQuiz' />
					  	</form>
						  </div>
              <div class='col-12 m-3'>$message</div>
						</div>
						</div>
					</div>						
				 ";
          if(isset($_POST['uploadQuiz'])){
            $folder = "../images/uploads/";
            $uploadFile = $_FILES["picToUpload"];
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
                    $qname = $_POST['qName'];
                    $description = $_POST['quizDescription'];
                    $qhash = $_POST['qHashtag'];

                    /// TODO: fix message display
                    $saveQuiz = queryMysql("INSERT INTO tbquizzes (user_id, qname, description, qhashtag) VALUES ('" . $row['user_id'] . "','$qname','$description','$qhash')");
                    if($saveQuiz) {
                      $uploadFileName = $uploadFile["name"];

                      queryMysql("INSERT INTO tbgallery (quiz_id, image_name) VALUES (" . $mysqli->insert_id . ", '" . $uploadFileName[$i] . "')") or die($mysqli->error);
                      $message = "<div class='alert alert-success'>Quiz uploaded successfully.<div>";
                    } else {
                      $message = "<div class='alert alert-danger'>Failed to upload quiz. Please try again later.<div>";
                    }
                  }else{
                    $message = buildMessageDiv("Sorry, there was an error uploading your file", "error");
                  }
                }
              }
            }
          }
          /*<div class='col-3' style='background-image: url(" . $folder .  $row["image_name"] . ")'></div>*/
          $res=queryMysql("SELECT * FROM tbquizzes WHERE user_id='" . $row['user_id'] . "'");
          if($res->num_rows != 0){
            echo buildMessageDiv("Found " . $res->num_rows . " Quizes", "info");
            
            while($row = $res->fetch_assoc()){ 
              $imgs = queryMysql("SELECT image_name FROM tbgallery WHERE quiz_id='" . $row['quiz_id'] . "'");

              echo "<div class='flex-container mt-4'>
                  <div class='col col--img'>";
              if($imgs->num_rows != 0) {
                $img_row = $imgs->fetch_assoc();
                echo "<img src='../images/uploads/" . $img_row['image_name'] . "' alt=''>";
              }

              echo "</div>
                  <div class='col col--text'>
                      <h3>".$row['qname']."</h3>
                      <p>".$row['description']."</p>
                      <p>".$row['qhashtag']."</p>
                        <button type='submit' class='btn btn-dark'>Play Quiz</button>
                    </div>
              </div>";  

            }
          } else {
            echo buildMessageDiv("No Quizes available yet", "info");
          } 	
			}
		  echo "</div>";
    ?>
  </div>
</div>
</body>
</html>