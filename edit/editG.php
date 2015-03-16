<?php
	include('../processes/process.php');
	$connect=connectDB();
	$editTuitionFee=mysqli_fetch_assoc(editTuitionFee($connect, $_GET['id']));

	if(isset($_POST['submit'])){
		extract($_POST);
			updateTuitioFee($connect,$_GET['id'], $tuition_fee, $due_date);
			header('Location: ../option.php');
			}
	?>
<head>
    <title>Edit Student</title>
	 <link href="../asd/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../asd/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../asd/css/init.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<div class="section no-pad-bot blue lighten-1" id="index-banner">
        <div class="container nav-wrapper">
	
          <h1 class="header center-on-small-only white-text">Edit Student</h1>
          <div class='row '>
            <h4 class ="header light blue-text text-lighten-4">Change a student's information
 </h4>

  
  
 <h4 class="right-align" style="margin-top:-50px;"><a class="dropdown-button" href="#!" data-activates="dropdown1"> <i class="mdi-communication-message white-text waves-effect waves-blue"></i></a>
 
 
  <a class="dropdown-button" href="#!" data-activates="dropdown1"> <i class="mdi-action-account-box white-text waves-effect waves-blue"></i></a></h4>
 <ul id='dropdown1' class='dropdown-content'>
			<li>  <a href="../logout.php">Log Out</a></li>
			<li>  <a href="../option.php">Options</a></li>
  </ul>
	  
	 
	 
	 
	 </ul>
 </div>
          </div>
		  </div>
		   <div class="container"><a href="#" data-activates="nav-mobile" class="button-collapse top-nav full"></a></div>
      <ul id="nav-mobile" class="side-nav fixed">

	   <li class="logo" style="padding-left:45px;padding-top:15px;"><image src="../asdg.png"></li>
	   <div class="section"></div>

<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<b><a  class="waves-effect waves-green" style="font-size:14px;" href="../index.php">Cash Reports<?echo"\t";?></a></li>
<li class="" style="padding-top:15px;padding-bottom:15px;">	<a  style="font-size:14px;" href="../studentaccounts.php" class=" waves-effect waves-green">Student Accounts<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="../search.php" class="waves-effect waves-green">Student List<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="../addstudent.php" class="waves-effect waves-green">Add Student<?echo"\t";?></a></li>
  </ul>	
</b>





<div style="margin-left:290px;margin-right:1300px;margin-top:40px;">
<form method="POST">
			<?=$editTuitionFee['grade']?>
			<br/>
			<?=$editTuitionFee['fee_type']?>
			<br/>
			<?=$editTuitionFee['item']?>
			<br/>
			<input type="number" name="tuition_fee"  pattern="[0-9]+([.][0-9]+)?" step="0.01" required value="<?=$editTuitionFee['fee']?>"/>
			<br/>
			<input type="date" name="due_date" value="<?=$editTuitionFee['due_date']?>"/>
			<input type="submit" name="submit" value="Save"/>

</form>
<a href ="../option.php">Back</a>
  <script src="http://www.gstatic.com/external_hosted/picturefill/picturefill.min.js"></script>
  <script src="../asd/js/materialize.js"></script>
  <script src="../asd/js/init.js"></script>
