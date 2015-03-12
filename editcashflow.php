<?php
	session_start();
	include('header.php');
	include('processes/process.php');
	$connect=connectDB();

	if($_SESSION['access_control']<2){
		header('Location:index.php');
	}

	$checkUserTable = editCashFlow($connect, $_GET['id']);
	$getUserRow = mysqli_fetch_assoc($checkUserTable);

	if(isset($_POST['321'])){
		deleteCashFlow($connect, $_GET['id']);
		header('Location:index.php');
	}

	if(isset($_POST['123'])){
		extract($_POST);
		updateCashFlow($connect, $_GET['id'], $arnumber, $cash, $dr, $cr, $tuitionfee, $remarks);
		header('Location:index.php');
	}

	if(isset($_POST['return'])){
		header('Location:index.php');
	}

	if(isset($_POST['restore'])){
		restoreCashFlow($connect, $_GET['id']);
		header('Location:index.php');
	}

?>
<!--================================ crap ^ ================================!-->
<head>
	<title>Edit Cash Flow</title>
</head>

<div class="section no-pad-bot blue lighten-1" id="index-banner">
        <div class="container nav-wrapper">
	
          <h1 class="header center-on-small-only white-text">Edit</h1>
          <div class='row '>
            <h4 class ="header light blue-text text-lighten-4">       Edit cash flow
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
<li class="active blue lighten-1" style="padding-top:15px;padding-bottom:15px;">	<b><a  class="white-text waves-effect waves-green" style="font-size:14px;" href="index.php">Cash Reports<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a  style="font-size:14px;" href="studentaccounts.php" class="waves-effect waves-green">Student Accounts<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="search.php" class="waves-effect waves-green">Student List<?echo"\t";?></a></li>



<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="addstudent.php" class="waves-effect waves-green">Add Student<?echo"\t";?></a></li>




   
   
   
   
   
   
   
   
   






  </ul>	
</b>
<div style="padding-left:290px;margin-right:1287px">
<form method="POST">
	<!--================================ eto ung name ng student na nagpay ================================!-->
	<label><?php echo $getUserRow['first_name'] ." ". $getUserRow['last_name']?></label></br>

	<!--================================ eto ung options na i-eedit ================================!-->
	<label>AR Number</label><input type="number" name="arnumber" value="<?=$getUserRow['ar']?>" pattern="[0-9]+" title="Numbers up to two decimal values" required/></br>
	<label>Cash</label><input type="number" name="cash" value="<?=$getUserRow['cash']?>" pattern="[0-9]+([.][0-9]+)?" step="0.01" required title="Numbers up to two decimal values"/></br>
	<!--<label>D.R.</label><input type="text" name="dr" value="<?php //$getUserRow['dr']?>" pattern="[A-Za-z0-9]+"/></br>!-->
	<!--<label>C.R.</label><input type="text" name="cr" value="<?php //$getUserRow['cr']?>"  pattern="[A-Za-z0-9]+"/></br>!-->
	<label>Tuition Fees</label><input type="number" name="tuitionfee" value="<?=$getUserRow['tuition']?>" pattern="[0-9]+([.][0-9]+)?" step="0.01" title="Numbers up to two decimal values" required/></br>
	<labe>Remarks</label><input type="text" name="remarks" value="<?=$getUserRow['remark']?>"  pattern="[A-Za-z ]+" title="Only letters and spaces are accepted" required/></br>
	
	<button class="btn waves-effect waves-light green"  name="123" value="Save">Save</button>
	<?php if($getUserRow['state']==0){ ?>
		<button class="btn waves-effect waves-light green"  name="321" value="Delete Payment">Delete</button>
		<?php }else{ ?>
		<button class="btn waves-effect waves-light green"  name="restore" value="Restore">Restore</button>
		<?php } ?>
	<button class="btn waves-effect waves-light green" onclick="location.href='index.php'" name="return" >Cancel</button>
</form>

<!--================================ crap V ================================!-->
<?php
	include('footer.php');
?>