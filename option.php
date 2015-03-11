<?php
	session_start();
	include('header.php');
	include('processes/process.php');
	$connect = connectDB();

$result=viewTime($connect);
$result1=viewMode($connect);
$result2=viewGrade($connect);
$result3=viewStatus($connect);

if($_SESSION['access_control']<2){
	header('Location: index.php');
}

if(isset($_POST['changeyear'])){
	changeyear($connect);
}

if(isset($_GET['id'])){
	$delTime=delTime($connect, $_GET['id']);
	

	if($delTime){
		echo "Deleted!";
	}
	else{

		echo "Not working!";
	}
}
?>
<div class="section no-pad-bot blue lighten-1" id="index-banner">
        <div class="container nav-wrapper">
	
          <h1 class="header center-on-small-only white-text">Options</h1>
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
<li class="active blue lighten-1" style="padding-top:15px;padding-bottom:15px;">	<b><a  class="white-text waves-effect waves-green" style="font-size:14px;" href="index.php">Cash Reports<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a  style="font-size:14px;" href="studentaccounts.php" class="waves-effect waves-green">Student Accounts<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="search.php" class="waves-effect waves-green">Student List<?echo"\t";?></a></li>



<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="addstudent.php" class="waves-effect waves-green">Add Student<?echo"\t";?></a></li>




   
   
   
   
   
   
   
   
   






  </ul>	
</b>




<div style="padding-left:290px;padding-right:270px;">

<h5>Click on a user edit it. Or click "Add User" to add new account</h5>
	<?php
$getUsers=getUsers($connect);
?>

<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Username</th>
			<th>Access Control</th>
		</tr>
	<thead>
	<?php while($row=mysqli_fetch_assoc($getUsers)){ ?>
	<tr class="clickablerow" href="edituser.php?id=<?=$row['user_id']?>">
		<td><?=$row['first_name']." ".$row['last_name']?></td>
		<td><?=$row['username']?></td>
		<td><?php if($row['access_control']==1) echo "Regular User"; else echo "Administrator"; ?></td>
	</tr>
	<?php } ?> 
	<tr class="clickablerow" href="adduser.php"/>
		<td>Add User</td>
		<td></td>
		<td></td>
</table>

<h5>Click on a time edit it. Or click the delete button to remove the time schedule.</h5>
<h5 style="font-weight:bold;">Time</h5>
<div style="width:20%;">
<table >

	<?php
	while($row=mysqli_fetch_assoc($result)){
		?>
		<tr class="clickablerow" href="edit/editT.php?id=<?=$row['id']?>"> 
			<td><?=$row['time']?></td>
			<td><a href="option.php?id=<?=$row['id']?>" onclick="return confirm('Are you sure you wnt to delete this?');">Delete</a></td>
		</tr>
		<?php
	}
	?>
	
	<tr class="clickablerow" href="add/addT.php"> 
		<td>Add Time</td>
		<td></td>
		<td></td>
	</tr>
	
</table>
</div>


<?php

if(isset($_GET['id'])){
	$delGrade=delGrade($connect, $_GET['id']);
	if($delGrade){
		echo "Deleted!";
	}
	else{
		echo "Not working!";
	}
}
?>
<head>  <link href="asd/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/init.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
</br>
<script src="jquery-2.1.3.min.js"></script>

<h5>Click on a grade level to add, edit, or delete tuition fees. </h5>
</br>
<!--<div style="width:20%;">!-->
<?php while($row=mysqli_fetch_assoc($result2)){?>

<div class="showme" data-panelid="<?php echo str_replace(' ', '', $row['grade_levels']);?>"> <?php echo "<h5 style=\"font-weight:bold;\">".$row['grade_levels']. " Tuition Fees </h5>";?></div>
		<div style="width:50%;display:none;" id="<?php echo str_replace(' ', '', $row['grade_levels']);?>">
		<table>
			<tr>
				<th>Payment Mode</th>
				<th>Item</th>
				<th>Tution Fee</th>
				<th>Due Date</th>
			</tr>
			<?php 
			$getTuitionFees=getFeeScheduleOptions($connect, $row['grade_levels']);
			while($row2=mysqli_fetch_assoc($getTuitionFees)){ ?>
			<tr class="clickablerow" href="edit/editG.php?id=<?=$row2['fee_id']?>">
				<td><?=$row2['fee_type']?></td>
				<td><?=$row2['item']?></td>
				<td><?=$row2['fee']?></td>
				<td><?=$row2['due_date']?></td>	
			</tr>
			<?php } ?>
		</table>
	</div>
</br>
<?php } ?>

<!--</div>!-->
<script src="jquery-2.1.3.min.js"></script>
<script src="http://www.gstatic.com/external_hosted/picturefill/picturefill.min.js"></script>
  <script src="asd/js/materialize.js"></script>
  <script src="asd/js/init.js"></script>

<script>

$(function(){
	$(".clickablerow").click(function(){
		window.document.location=$(this).attr("href");
	});

	$(".showme").on('click', function(){
       var panelId = $(this).attr('data-panelid');
       $('#'+panelId).slideToggle();
    });
});


</script>
  