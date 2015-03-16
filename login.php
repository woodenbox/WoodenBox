
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
  	<link rel="shortcut icon" href="box.ico">
	<title>WoodenBox Login</title>
	</head>

	<body style="position: absolute;width: 100%;top: 0%; left: 0%; background: url(qwe.jpg) no-repeat;background-size: cover;">
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
    						<div class="row"><br>
  								<h5 class=" teal-text text-lighten-2 CENTER">Please log-in</h5>
							</div>
							
 							<div class="divider"></div>
      						<div class="input-field col s6">
        						<input id="username" type="text" pattern="[A-Za-z0-9]+" class="validate" name="username" required>
        						<label for="username">Username</label>
      						</div>
      						<div class="input-field col s6">
        						<input id="password" type="password" pattern="[A-Za-z0-9]+" class="validate" name="password" required>
        						<label for="password">Password</label>
      						</div>
<br><br><br>
<div class="col s7 CENTER"><br>
<button  class="btn waves-effect waves-light green" style="position: relative;width: 100%;top: 0; left: 40%;" type="submit" name="loginBTN" value="Login">Log In
    							<i class="mdi-content-send right"></i>
  							</button></div>

    				</div>
	  						<p>

	  						</p>
		 					
						</form>



			</div>



			</div>


<!-- 
<p class="modal-trigger" href="#kambeng"><img src="kambeng.png" style="position: relative;bottom:-691px;left:666px;"></img></p>
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
  </div> !-->          
		
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="asd/js/materialize.js"></script>
  <script src="asd/js/init.js"></script>
		
</body>
</html>