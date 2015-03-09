<?php
	session_start();
	include('header.php');
	include('processes/process.php');
	$connect=connectDB();

	$getBalance = mysqli_fetch_assoc(getBalance($connect, $_GET['id']));

	if(isset($_POST['delete'])){
		deleteStudentBalance($connect, $_GET['id'], 1);
		header('Location:viewstudent.php?id='.$_SESSION['studentfee']);
	}

	if(isset($_POST['undelete'])){
		deleteStudentBalance($connect, $_GET['id'], 0);
		header('Location: viewstudent.php?id='.$_SESSION['studentfee']);
	}

	if(isset($_POST['submit'])){
		extract($_POST);
		updateStudentBalance($connect, $_GET['id'], $getBalance['item'], $balance, $due_date, $penalty_balance, $penalty_count);
		header('Location:viewstudent.php?id='.$_SESSION['studentfee']);
	}

	if(isset($_POST['return'])){
		header('Location:viewstudent.php?id='.$_SESSION['studentfee']);
	}

?>
<div class="section no-pad-bot blue lighten-1" id="index-banner">
        <div class="container nav-wrapper">
	
          <h1 class="header center-on-small-only white-text">Edit Balance</h1>
          <div class='row '>
            <h4 class ="header light blue-text text-lighten-4">      
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

      
<!--================================eto ung cashflow table. merun div para sa scroll bar================================!-->

<div class="container"><a href="#" data-activates="nav-mobile" class="button-collapse top-nav full"></a></div>
      <ul id="nav-mobile" class="side-nav fixed">

	   <li class="logo" style="padding-left:45px;padding-top:15px;"><image src="asdg.png"></li>
	   <div class="section"></div>
	  <div class="divider"></div><div class="section"></div>
<li class="" style="padding-top:15px;padding-bottom:15px;">	<b><a  class="waves-effect waves-green" style="font-size:14px;" href="index.php">Cash Reports<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a  style="font-size:14px;" href="studentaccounts.php" class="waves-effect waves-green">Student Accounts<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="search.php" class="waves-effect waves-green">Student List<?echo"\t";?></a></li>



<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="addstudent.php" class="waves-effect waves-green">Add Student<?echo"\t";?></a></li>




   
   
   
   
   
   
   
   
   






  </ul>	
</b>


<div style="padding-left:290px;margin-right:1287px;">
<form method="POST">
	<input name="item" value="<?=$getBalance['item']?>" disabled/></br>
	Balance<input type="number" name="balance" value="<?=$getBalance['balance']?>" pattern="[0-9]+([.][0-9]+)?" step="0.01" required/></br>
	Due Date<input type="date" name="due_date" value="<?=$getBalance['due_date']?>"/></br>
	Balance<input type="number" name="penalty_balance" value="<?=$getBalance['penalty_balance']?>" pattern="[0-9]+([.][0-9]+)?" step="0.01"/></br>
	Penalty Count<input type="number" name="penalty_count" value="<?=$getBalance['penalty_count']?>" pattern="[0-9]+"/></br>

	<button class="btn waves-effect waves-light green" type="submit" name="submit" value="Save">Save</button>
	<button class="btn waves-effect waves-light green" type="submit" name="delete" value="Waive">Waive</button>
	<button class="btn waves-effect waves-light green" type="submit" name="undelete" value="Unwaive">Unwaive</button>
	<button class="btn waves-effect waves-light green" type="submit" name="return" value="Cancel">Cancel</button>
</form>

<?php
	include('footer.php');
?>