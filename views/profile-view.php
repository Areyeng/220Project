<?php
  require_once('../scripts/functions.php');
  require_once('../scripts/profile.php');
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
  <script type="text/javascript" src="../script.js" defer></script>
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

        echo "<form id='update-profile-form' method='POST' action='profile-view.php'>
                <input type='hidden' value='" . $row['name'] . "' name='name'> 
                <input type='hidden' value='" . $row['surname'] . "' name='surname'> 
                <input type='hidden' value='" . $row['wine'] . "' name='favourite_wines'> 
                <input type='hidden' value='" . $row['email'] . "' name='contact_details'> 
              </form>
          <div class='flex-container mt-4 p-1 bg-white'>
            <h1 class='mt-3 mb-3'>Profile Page</h1>
            <div class='row'>
              <div class='col-4'>
              <div class='row'>
              <div class='col-12'>";
               
          if(strlen(trim($row['profile_pic'])) == 0) {
            echo "<img src='../gallery/no-profile-image.png' class='img-fluid' alt='Responsive image'>";
          } else {
            echo "<img src='../gallery/" . $row['profile_pic'] . "' class='img-fluid' alt='Responsive image'>";
          }

          echo "</div>
              <div class='col-12 p-2' style='overflow: hidden'>
                <form action='profile-view.php' method='POST' enctype='multipart/form-data'>
                  <input type='hidden'>
                  <input type='file' class='form-control' name='profile[]' id='profile' multiple='multiple' />
                  <input type='submit' name='changeDp' class='btn btn-dark mt-2' value='Change Picture'>
                </form>
              </div>
            </div>
                
                
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
                  $message
                <a href='quiz-view.php' class='btn btn-dark' role='button'>View Profile</a>		
              </div>
              </div>
        </div>";
      }
    ?>
  </div>
</div>
</body>
</html>