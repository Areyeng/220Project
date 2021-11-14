<?php
	// See all errors and warnings
	error_reporting(E_ALL);
	ini_set('error_reporting', E_ALL);

	//$mysqli = mysqli_connect("localhost", "u18386840", //"homstpyw@U18386840", "u18386840");
	$mysqli = mysqli_connect("localhost", "root", "", "deliverable");

	$email = isset($_POST["email"]) ? $_POST["email"] : null;
	$pass = isset($_POST["pass"]) ? $_POST["pass"] : null;
	$description =isset($_POST["quizDescription"]) ? $_POST["quizDescription"] : null;
	$qhash =isset($_POST["qHashtag"]) ? $_POST["qHashtag"] : null;
	$qname =isset($_POST["qName"]) ? $_POST["qName"] : null;
	$wine =isset($_POST["favwine"]) ? $_POST["favwine"] : null;

	// If email and/or pass POST values are set, set the variables to those values, otherwise make them false
	$query ="SELECT * FROM tbusers WHERE email = '$email' AND password ='$pass'";
	$res = mysqli_query($mysqli,$query);
	$row =mysqli_fetch_array($res);
	$userid = $row["user_id"];
	$folder = "gallery/";

	$query ="SELECT * FROM tbquizzes";
	$result = mysqli_query($mysqli,$query);
	$qrow =mysqli_fetch_array($result);
	if(isset($_FILES["picToUpload"])){
		$uploadFile = $_FILES["picToUpload"];
		// Profile pic is being updated
		$numFiles = count($uploadFile["name"]);

		$uploadSuccess = false;

		for($i = 0; $i < $numFiles; $i++){
			if( ($uploadFile["type"][$i] == "image/jpeg" 
			|| $uploadFile["type"][$i] == "image/pjpeg"
			|| $uploadFile["type"][$i] == "image/png") && $uploadFile["size"][$i] < 1000000){
				if($uploadFile["error"][$i] > 0){
					echo "Error: " . $uploadFile["error"][$i] . "<br/>";
				}
				else{
					// Add new entry to table
					$uploadFileName = $uploadFile["name"];

					$sql = "INSERT INTO tbgallery (quiz_id, image_name) VALUES ($userid, '$uploadFileName')";
					mysqli_query($mysqli,$sql) or die("Error,saving path to database.<a href='login.php'>Go back</a>");
					
					$target_file=$folder . basename($uploadFile["name"]);
					if(move_uploaded_file($uploadFile["tmp_name"], $target_file))
					{
						echo "Success";
					}else{
						echo "Sorry, there was an error uploading your file";
					}
				}
			}
		}
	}
	

?>

<!DOCTYPE html>
<html>
<head>
	<title>IMY 220 - Deliverable</title>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="180x180" href="favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicons/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative&family=Urbanist:wght@100&display=swap" rel="stylesheet">
	<meta charset="utf-8" />
	<!--<script type="text/javascript" src="script.js"></script>-->
	<meta name="author" content="Areyeng Mphahlele">
	<!-- Replace Name Surname with your name and surname -->
</head>
<body class="loginPage">
	<div class="container" style="padding: 0">
		<?php 
			$query = "SELECT * FROM tbusers WHERE email = '$email' AND password = '$pass'";
			$res = $mysqli->query($query);
			if($row = mysqli_fetch_array($res))
			{

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
							<a href='profile.php' class='btn btn-dark' role='button'>View Profile</a>						
							
						  <form action='login.php' method='POST' enctype='multipart/form-data'>
							
								
								
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
								<input type='hidden' class='form-control' name='email' value='" . $_POST["email"] . "' />
								<input type='hidden' class='form-control' name='pass' value='" . $_POST["pass"] . "' />
								<input type='submit' class='btn btn-dark' value='Upload Quiz' name='uploadQuiz' />

							

					  	</form>
					  	
						  </div>

						</div>
						</div>
					</div>






				
						
				 ";
						

				
					  	if(isset($_POST['uploadQuiz'])){
					  			$sql1="INSERT INTO tbquizzes (user_id,qname, qdescription,qhashtag) VALUES ('$userid','$qname','$description','$qhash')";
						mysqli_query($mysqli,$sql1) or die("Error,saving path to database.<a href='login.php'>Go back</a>");
					  	}
					  /*<div class='col-3' style='background-image: url(" . $folder .  $row["image_name"] . ")'></div>*/
					  	$query = "SELECT * FROM tbquizzes WHERE user_id='$userid'";
					  	$res=mysqli_query($mysqli,$query);
					  	if($res->num_rows != 0){
					  		
					  		while($row = mysqli_fetch_array($res)){ 
					 
					 			  echo "
					 			   <div class='flex-container mt-4'>
									<div class='col col--img'>
										<img src='images/p1_serve.jpg' alt=''>
									</div>
									<div class='col col--text'>

										<h3>".$row['qname']."</h3>
										<p>".$row['qdescription']."</p>
										  <button type='submit' class='btn btn-dark'>Play Quiz</button>
									</div>
								</div>";
								

					  			 
					  			}
							}
					  	
			}//end if

			else
			{
				echo 	'<div class="alert alert-danger mt-3" role="alert">
  							You are not registered on this site!
  						</div>';
			}//end else
		  echo "</div>";?>
		  <?php 
			$query = "SELECT * FROM tbusers WHERE email = '$email' AND password = '$pass'";
			$res = $mysqli->query($query);
			if($row = mysqli_fetch_array($res))
			{
				 echo "<div class='flex-container mt-4'>
			    <h1 class='mt-3 mb-3'>Profile Page</h1>
				<div class='row'>
					<div class='col-4'>
						<img src='gallery/no-profile-image.png' class='img-fluid' alt='Responsive image'>
					</div>
				    <div class='col'>
				    	<div data-type='text' class='details'>
							<b>Name:</b> <span>". $row['name'] ."</span> <button class='btn btn-dark pull-right'>Edit</button>
						</div>
						<div data-type='text' class='details'>
							<b>Surname:</b> <span>". $row['surname'] ."</span> <button class='btn btn-dark pull-right'>Edit</button>
						</div>
						<div data-type='text' class='details'>
							<b>Favourite Wines:</b> <span>". $row['wine'] ."</span> <button class='btn btn-dark pull-right'>Edit</button>
						</div>
						<div data-type='text' class='details'>
							<b>Contact Details:</b> <span>". $row['email'] ."</span> <button class='btn btn-dark pull-right'>Edit</button>
						</div>
							
						<a href='login.php' class='btn btn-dark' role='button'>View Profile</a>		
					</div>
			    </div>
			</div>";
	
}?>
	</div>
</body>
</html>