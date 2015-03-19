<?php

session_start();
ob_start();	

$user = $_SESSION['username'];

include('processes/process.php');


$connect=connectDB();


	

 	$header = "Messages";
	$header2 =  "Inbox";
$view_msg=viewmsg($connect);


	function viewmsg($connect){
		$user = $_SESSION['username'];
		$sql="SELECT * FROM private_messages WHERE to_user='$user'";
		$return=mysqli_query($connect,$sql);
		return $return;
	}


?>




<head>

  <link href="asd/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="asd/css/pagination.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="asd/css/prism.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <script src="jquery-2.1.3.min.js"></script>
<link rel="shortcut icon" href="box.ico">
</head>



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





</div>  
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












<div style="position: relative;width: 80%;bottom: -2%; left: 16%;">


<?php		



	while($rows = mysqli_fetch_assoc($view_msg)) {
				$id = $rows['id'];
				$to_user = $rows['to_user']; 
				?>

<?php
			
				
				?>



<div class="card" style="padding: 1.5%;">


				<h6 class><b>From:&nbsp &nbsp</b><b class="blue-text text-lighten-2"><?=$from = $rows['from_user']?></b>

					<div style="float:right;">Date:
	<i style="font-size:12px;"><?=$date = $rows['date']?></i></h6>
<br>
<div class="divider"></div>


	<p><b>Message:</b></p>

<div style="float:left">

				<?php
				
				

				
				echo "".$message = $rows['message']."<br>";
			?>
		</div>
<br>



	<?php
	
	if($to_user==$user) {
		$up = mysql_query("
		
		UPDATE haha SET read='1' WHERE id='$id'
		
		");
	
	
} else {
	echo "";
}
?>
</div>
<?php
}
?>
</div>


    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="asd/js/materialize.js"></script>
  <script src="asd/js/init.js"></script>