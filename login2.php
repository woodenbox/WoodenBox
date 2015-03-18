
<!DOCTYPE html>



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













<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a modern responsive CSS framework based on Material Design by Google. ">
    <title>Parallax - Materialize</title>
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
    <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
    <!--  Android 5 Chrome Color-->
    <meta name="theme-color" content="#EE6E73">
    <!-- CSS-->
    <link href="css/prism.css" rel="stylesheet">
    <link href="css/ghpages-materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="http://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet" type="text/css">
    <script>
      window.liveSettings = {
        api_key: "a0b49b34b93844c38eaee15690d86413",
        picker: "bottom-right",
        detectlang: true,
        dynamic: true,
        autocollect: true
      };




    </script>
<link href="asd/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/init.css" type="text/css" rel="stylesheet" media="screen,projection"/>

<header>

  <nav>
    <div class="nav-wrapper z-depth-4 white">
      <a href="#" class="brand-logo grey-text text-darken-2" style="font-weight:400;font-size:16px">Noah's Ark Institute of Learning</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="sass.html">Sass</a></li>
        <li><a href="components.html">Components</a></li>
        <li><a href="javascript.html">JavaScript</a></li>
      </ul>
    </div>
  </nav>

    <script src="//cdn.transifex.com/live.js"></script>
  </head>
  <body class="parallax-demo" background="images/bg.png"><header>

</header>

<main>
<!--  Parallax Section  -->
  <div class="parallax-container">
    <div class="parallax"><img src="images/Picture1.png" style="position:relative; width:100%;"></div>
  </div>
  <div class="section white">
    <div class="row container">
      <h2 class="header">Please Log-in</h2>
      <p class="grey-text text-darken-3 lighten-3">Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.</p>
    </div>
    <div class="row container ">
      <h4 class="light">Parallax Demo HTML</h4>
        <form method="POST" accept-charset="UTF-8">
          <div class="row  ">
              <form class="col s12 ">
                <div class="row "><br>
              
              </div>
              
              <div class="divider "></div>
                  <div class="input-field col s3 center">
                    <input id="username" type="text" pattern="[A-Za-z0-9]+" class="validate " name="username" required>
                    <label for="username">Username</label>
                  </div>
                  <div class="input-field col s3">
                    <input id="password" type="password" pattern="[A-Za-z0-9]+" class="validate" name="password" required>
                    <label for="password">Password</label>
                  </div>
<br><br><br>
<div class="col s7 CENTER"><br>
<button  class="btn waves-effect waves-light green col s3" style="position: relative;width: 35%;top: 0; left: 40%;" type="submit" name="loginBTN" value="Login">Log In
                  <i class="mdi-content-send right"></i>
                </button></div>

            </div>
                <p>

                </p>
              
            </form>
    </div>
  </div>
  <div class="parallax-container">
    <div class="parallax"><img src="images/Picture1.jpg"></div>
  </div>  


   <footer class="page-footer white" style="position:relative; width:100%;">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Footer Content</h5>
                <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2014 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
          </div>
        </footer>
    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script>if (!window.jQuery) { document.write('<script src="bin/jquery-2.1.1.min.js"><\/script>'); }
    </script>
    <script src="js/jquery.timeago.min.js"></script>  
    <script src="js/prism.js"></script>
    <script src="bin/materialize.js"></script>
    <script src="js/init.js"></script>
    <!-- Twitter Button -->
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

    <!-- Google Plus Button-->
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <!--  Google Analytics  -->
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-56218128-1', 'auto');
    ga('require', 'displayfeatures');
    ga('send', 'pageview');
    </script>




  </body>
</html>