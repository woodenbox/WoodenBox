<?php
  ob_start();
  if(!isset($_SESSION['username'])){
    header('Location: login.php');
  }


if(!isset($_SESSION['username'])){
	header('Location: login.php');


}
if(!isset($header)){
  $header="Test";
  $header2="Test2";
}


?>

<html>
<head>

  <link href="asd/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="asd/css/pagination.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="asd/css/prism.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <script src="jquery-2.1.3.min.js"></script>
<link rel="shortcut icon" href="box.ico">
</head>

<body>


  <div class="section no-pad-bot blue lighten-1 hide-on-small-only" id="index-banner" style="position: relative;width: 100%;height: 186px; left: 0%;">
        <div class="container nav-wrapper">
		
	<!-- Welcome <?php echo $getUserRow['first_name'] ." ". $getUserRow['last_name']?> !-->


          <h2 style="padding-left:2%;" class="header center-on-small-only white-text hide-on-small-only">	<?=$header?></h1>
          <div class='row '>
            <h5 style="padding-left:2%;" class ="header light blue-text text-lighten-4 hide-on-small-only">  <?=$header2?>




            	   <div style="float:right;">
  
 <h4 style="position: relative;width: 100%;top: 0; left: 0%;">

 <a class="dropdown-button" href="#!" data-activates="dropdown2" style="position: relative;width: 100%;top: 0; left: 0%;"> <i class="mdi-communication-message white-text waves-effect waves-blue"></i></a>
 
  <a class="dropdown-button" href="#!" data-activates="dropdown1" style="position: relative;width: 100%;top: 0; left: 0%;"> <i class="mdi-action-account-box white-text waves-effect waves-blue"></i></a></h4>
 <ul id='dropdown1' class='dropdown-content'>
			<li>  <a href="logout.php">Log Out</a></li>
			<?php if($_SESSION['access_control']>1){ ?><li>  <a href="option.php">Options</a></li><?php } ?>
  </ul>
  
   <ul id='dropdown2' class='dropdown-content'>

<li>
<a href="compose.inc.php">Compose</a>
</li>

<div style="padding:5px;font-size:75%;">
<?php include('read.inc.php'); ?>
</div>  
<li>
<a href="inbox.inc.php">Read all messages</a>
</li>
<div class="divider"></div>







  </ul>
	  
	 
	 
	 
	</div>
 </h4>


 </div>
          </div>
		  </div>	


<div class="container"><a href="#" data-activates="nav-mobile" class="button-collapse top-nav full" style="position: fixed;"></a></div>
      <ul id="nav-mobile" class="side-nav fixed">

     <li class="logo" style="padding-left:25px;padding-top:40px;"><image src="asdg.png" style="position:relative;width:85%;" onclick="toast('Huehue', 400)" style="background-size:100%;"></li>
     <div class="section"></div>  
     <div class="divider valign" style="width: 90%;position:relative;left:5%;"></div>
  
<b>

<li <?php if(curPageName()=='index.php') echo "class=\"blue lighten-1 waves-effect waves-white\""; else echo "class=\"waves-effect waves-white\""; ?> style="padding-top:15px;padding-bottom:15px; width:100%;">  <a  <?php if(curPageName()=='index.php') echo "class=\"white-text waves-effect waves-green\"";?> style="font-size:80%;" href="index.php"><i class="mdi-communication-business"></i>&nbspCash Reports<?echo"\t";?></a></li>
<li <?php if(curPageName()=='studentaccounts.php') echo "class=\"blue lighten-1 waves-effect waves-white\""; else echo "class=\"waves-effect waves-white\""; ?> style="padding-top:15px;padding-bottom:15px; width:100%;"> <a  style="font-size:80%;" href="studentaccounts.php"<?php if(curPageName()=='studentaccounts.php') echo "class=\"white-text waves-effect waves-green\"";?> ><i class="mdi-action-account-child"></i>&nbspStudent Accounts<?echo"\t";?></a></li>
 



<li <?php if(curPageName()=='search.php') echo "class=\"blue lighten-1 waves-effect waves-white\""; else echo "class=\"waves-effect waves-white\""; ?> style="padding-top:15px;padding-bottom:15px;width:100%;"> <a style="font-size:80%;" href="search.php"<?php if(curPageName()=='search.php') echo "class=\"white-text waves-effect waves-green\"";?> ><i class="mdi-action-view-list"></i>&nbspStudent List<?echo"\t";?></a></li>

<li <?php if(curPageName()=='addstudent.php') echo "class=\"blue lighten-1 waves-effect waves-white\""; else echo "class=\"waves-effect waves-white\";" ?> style="padding-top:15px;padding-bottom:15px; width:100%;"> <a style="font-size:80%;" href="addstudent.php"<?php if(curPageName()=='addstudent.php') echo "class=\"white-text waves-effect waves-green\"";?> ><i class="mdi-social-person-add"></i>&nbspAdd Student<?echo"\t";?></a></li>


  </ul> 
</b>



    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="asd/js/materialize.js"></script>
  <script src="asd/js/init.js"></script>