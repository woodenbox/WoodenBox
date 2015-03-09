<?php

	session_start();
	
	if(isset($_SESSION['username'])){
		header('Location: index.php');
	}

	if(isset($_POST['loginBTN'])){
		extract($_POST);
		include('processes/process.php');
		$connect = connectDB();
		$getUserRow = mysqli_fetch_assoc(checkUserDB($connect, stripslashes($username), stripslashes($password)));
		
		if(isset($getUserRow)){
			session_start();
			$_SESSION['username'] = $getUserRow['username'];
			$_SESSION['access_control'] = $getUserRow['access_control'];
			$_SESSION['user_id'] = $getUserRow['user_id'];
			header('Location: index.php');
		} else {
				echo '<script type="text/javascript"> alert("Username or Password is Incorrect");</script>';
				}
	}	
?>

<html>
	<head>
  	<link href="asd/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  	<link href="asd/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  	<link href="asd/css/init.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<title>WoodenBox Login</title>
	</head>

	<body background="qwe.jpg">
 		<nav>
    		<div class="nav-wrapper white  z-depth-4">
   				<div class="valign-wrapper">
			  		<h5 class="valign grey-text">Noah's Ark Institute of Learning</h5>
				</div>
    		</div>
  		</nav>

		<div class="row">
			<div class="z-depth-4 col s3 grid-example white lighten-2"  style="position: fixed;top: 50%;left: 50%;transform: translate(-50%, -50%);">
				<form method="POST" accept-charset="UTF-8">
		 			<div class="row">
  						<form class="col s12">
    						<div class="row">
  								<h5 class=" teal-text text-lighten-2">Please log-in</h5>
							</div>
							
 							<div class="divider"></div>
      						<div class="input-field col s6">
        						<input id="username" type="text" class="validate" name="username">
        						<label for="username">Username</label>
      						</div>
      						<div class="input-field col s6">
        						<input id="password" type="password" class="validate" name="password">
        						<label for="password">Password</label>
      						</div>
    				</div>
	  						<p>
	    						<input type="checkbox" id="test5" />
	    						<label for="test5" style="margin-left:135px;">Remember me</label>
	  						</p>
		 					<button class="btn waves-effect waves-light green" style="margin-left:135px;" type="submit" name="loginBTN" value="Login">Log In
    							<i class="mdi-content-send right"></i>
  							</button>
						</form>
			</div>
			</div>

<a class="modal-trigger" href="#kambeng"><img src="kambeng.png" style="position: relative;bottom:-660px;left:600px;"></img></a>
 <div id="kambeng" class="modal" >
    <div class="modal-content">
      <img src="h4h4.jpg" style="float:left;"/>
<p style="font-size:100px;">E</p>
<p style="font-size:100px;">Z</p>
<p style="font-size:100px;">H</p>
<p style="font-size:100px;">A</p>
<p style="font-size:100px;">T</p>
<p style="font-size:100px;">E</p>
<p style="font-size:100px;">R</p>
<p style="font-size:100px;">Z</p>
  </div>
          
		
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="asd/js/materialize.js"></script>
  <script src="asd/js/init.js"></script>
		
</body>
</html>