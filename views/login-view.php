<?php
require_once("../scripts/functions.php");
require_once('../scripts/login.php');

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
   	<div class="container-fluid" style="padding: 0">
        <div class="bg-image">
             <div class="row h-100">

                <div class="col-md-4 offset-md-4">
                    
                    <div class="text-center">
                         <img src='../images/logo2.png'/>
                    	<h1>SIP 'N SPILL</h1>
                    		<h6>LET'S FIND OUT HOW MUCH YOU KNOW</h6>
                    		<h6> ABOUT YOUR WINES.</h6>
                    			
                    </div>
                   
                            <form action="login-view.php" method="POST">
                                <fieldset>
                                    <div class="row mt-3">
                                        <div class="col-12 col-lg-12">
                                           <input type="email" id="loginEmail" class="form-control" placeholder="Email" name="email">
                                        </div>
                                        <div class="col-12 col-lg-12 mt-3">
                                            <input type="password" id="loginPass" class="form-control" placeholder="Password" name="password">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6 offset-md-2">
                                            <button type="submit" class="btn btn-dark">SIGN IN</button>
                                        </div>
                                    </div>
                                    
                                </fieldset>
                            </form>
                    </div>
            <div class="row mt-4">
                <div class="col-md-6 offset-md-3 mt-3">
                    
                        
                        <div class="card-body">
                            <h5 class="card-title text-center">Sign Up</h5>
                            <form action="login-view.php#register-section" method="POST">
                                <fieldset>
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <label for="regName">First Name:</label>
                                            <input type="text" id="regName" class="form-control" name="fname">
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="regSurname">Last Name:</label>
                                            <input type="text" id="regSurname" class="form-control"  name="lname">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="regEmail">Email Address:</label>
                                            <input type="email" id="regEmail" class="form-control"  name="remail">
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="regFavWine">Favourite Type Of Wine:</label>
                                            <input type="text" id="regFavWine" class="form-control" name="favwine">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="regPass1">Create Password:</label>
                                            <input type="password" id="pass1" class="form-control" placeholder="******" name="password">
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="regPass2">Confirm Password:</label>
                                            <input type="password" id="pass2" class="form-control" placeholder="******">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-dark">Register</button>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="row mt-3">
                                <div class="col-12">
                                  <?php
                                    echo $message;
                                  ?>
                                </div>
                              </div>
                            </form>
                        </div>
                    
                </div>

        </div>
                       
                 </div>
            </div>
        </div>
	</div>
   </body>
 </html>