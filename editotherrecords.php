<?php
	session_start();
	include('header.php');
	include('processes/process.php');
	$connect = connectDB();

	$getOtherRecord = mysqli_fetch_assoc(getOtherRecord($connect, $_GET['id']));

	if(isset($_POST['submit'])){
		extract($_POST);
		updateOtherRecords($connect, $_GET['id'], $grade_level, $quarter, $average);
		header('Location: viewstudent.php?id='.$_SESSION['studentfee']);
	}

	if(isset($_POST['delete'])){
		deleteOtherRecords($connect, $_GET['id']);
		header('Location: viewstudent.php?id='.$_SESSION['studentfee']);
	}

	if(isset($_POST['return'])){
		header('Location: viewstudent.php?id='.$_SESSION['studentfee']);
	}
?>
<div class="section no-pad-bot blue lighten-1" id="index-banner" style="margin-bottom:200px;">
        <div class="container nav-wrapper">
	
          <h1 class="header center-on-small-only white-text">Edit</h1>
          <div class='row '>
            <h4 class ="header light blue-text text-lighten-4">  Edit other records
 </h4>

  
  
 <h4 class="right-align" style="margin-top:-50px;"><a class="dropdown-button" href="#!" data-activates="dropdown1"> <i class="mdi-communication-message white-text waves-effect waves-blue"></i></a>
 
 
  <a class="dropdown-button" href="#!" data-activates="dropdown1"> <i class="mdi-action-account-box white-text waves-effect waves-blue"></i></a></h4>
 <ul id='dropdown1' class='dropdown-content'>
			<li>  <a href="logout.php">Log Out</a></li>
			<li>  <a href="option.php">Options</a></li>
  </ul>
	  
	 
	 
	 
	 </ul>
 </div>
          </div>
		  </div>
<!--================================ crap ^ ================================!-->







<!--================================ crap ^ ================================!-->
		   <div class="container"><a href="#" data-activates="nav-mobile" class="button-collapse top-nav full"></a></div>
      <ul id="nav-mobile" class="side-nav fixed">

	   <li class="logo" style="padding-left:45px;padding-top:15px;"><image src="asdg.png"></li>
	   <div class="section"></div>

<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<b><a  class="waves-effect waves-green" style="font-size:14px;" href="index.php">Cash Reports<?echo"\t";?></a></li>
<li class="" style="padding-top:15px;padding-bottom:15px;">	<a  style="font-size:14px;" href="studentaccounts.php" class=" waves-effect waves-green">Student Accounts<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="search.php" class="waves-effect waves-green">Student List<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="addstudent.php" class="waves-effect waves-green">Add Student<?echo"\t";?></a></li>
  </ul>	
</b>








<div style="margin-left:290px;px;margin-right:1287px;margin-top:-180px;">

<form method="POST">
	<label>Date</label><input type="date" name="grade_level" value="<?=$getOtherRecord['date']?>"/></br>
	<label>Sent To</label><input type="text" name="quarter" value="<?=$getOtherRecord['sent_to']?>" pattern="[A-Za-z0-9 ]+"/></br>
	<label>Reason</label><input type="text" name="average" value="<?=$getOtherRecord['reason']?>" pattern="[A-Za-z0-9 ]+"/></br>

	<button class="btn waves-effect waves-light green" type="submit" name="submit" value="Save">Save</button>
	<button class="btn waves-effect waves-light green" type="submit" name="delete" value="Delete">Delete</button>
	<button class="btn waves-effect waves-light green" type="submit" name="return" value="Cancel">Cancel</button>
</form>



<?php
	include('footer.php');
?>