<?php
	session_start();

	include('processes/process.php');
	$connect = connectDB();

$result=viewTime($connect);
$result1=viewMode($connect);
$result2=viewGrade($connect);
$result3=viewStatus($connect);

if(isset($_GET['id4'])){
	$delTime=delTime($connect, $_GET['id4']);
		$getGrade=mysqli_fetch_assoc(getGrade($connect, $_GET['id']));
		$getMode=mysqli_fetch_assoc(getMode($connect, $_GET['id']));
$getTime=mysqli_fetch_assoc(getTime($connect, $_GET['id']));
$getStatus=mysqli_fetch_assoc(getStatus($connect, $_GET['id']));

	if($delTime){
		echo "Deleted!";
	}
	else{

		echo "Not working!";
	}
}



			?>
			<!--===============================EDIT ISSETS ================================!-->

<?



	if(isset($_POST['id']{
		extract($_POST);
			updateStatus($connect,$_GET['id'], $status);
			}
			
			

	if(isset($_POST['id'])){
		extract($_POST);
			updateMode($connect,$_GET['id'], $mode);
			}
	
	if(isset($_POST['id'])){
		extract($_POST);
			updateMode($connect,$_GET['id'], $mode);
			}


	if(isset($_POST['id'])){
		extract($_POST);
			updateTime($connect,$_GET['id'], $time);
			}
			
			
			?>
			<!--================================ADD ISSETS ================================!-->

<?

	
		if(isset($_POST['add'])){
		$status=$_POST['status'];
			$add=addStatus($connect,$status);
			if($add){
				echo "Added successfully";
			}
			else{
				echo "Failed to add";
			}

			if(isset($_POST['add'])){
		$grade=$_POST['grade'];
			$add=addGrade($connect,$grade);
			if($add){
				echo "Added successfully";
			}
			else{
				echo "Failed to add";
			}
		
	}

		if(isset($_POST['add'])){
		$t1=$_POST['time'];
		$time=$t1." ".$_POST['tod'];
			$add=addTime($connect,$time);
			if($add){
				echo "Added successfully";
			}
			else{
				echo "Failed to add";
			}
	 
	}
	
	
	
		if(isset($_POST['add'])){
		$mode=$_POST['mode'];
			$add=addMode($connect,$mode);
			if($add){
				echo "Added successfully";
			}
			else{
				echo "Failed to add";
			}
		
	}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>
<head>
	  <link href="asd/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/init.css" type="text/css" rel="stylesheet" media="screen,projection"/>


  </head>
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
		  
		  
		  
		  <div class="container"><a href="#" data-activates="nav-mobile" class="button-collapse top-nav full"></a></div>
      <ul id="nav-mobile" class="side-nav fixed">

	   <li class="logo" style="padding-left:45px;padding-top:15px;"><image src="asdg.png"></li>
	   <div class="section"></div>
	  <div class="divider"></div><div class="section"></div>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<b><a  class="waves-effect waves-green" style="font-size:14px;" href="index.php">Cash Reports<?echo"\t";?></a></li>
<li class="" style="padding-top:15px;padding-bottom:15px;">	<a  style="font-size:14px;" href="studentaccounts.php" class="waves-effect waves-green">Student Accounts<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="search.php" class="waves-effect waves-green">Student List<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="addstudent.php" class="waves-effect waves-green">Add Student<?echo"\t";?></a></li>
  </ul>	
</b>
<div style="padding-left:290px;padding-right:270px;">
<table>


<!--================================TIME================================!-->
	<tr>
		<th>Time</th>
		
	</tr>
	<?php
	while($row=mysqli_fetch_assoc($result)){
		?>
		<tr> 
			<td class="modal-trigger" href="#modal1"><?=$row['time']?></td>
			  <div id="modal1" class="modal">
			<div class="modal-content">
			<form method="POST">
			Time:
			<input class="input_field" name="time" value="<?=$getTime['time']?>"/>
			<input type="submit" name="d" value="Edit Record"/>		
</form>
    </div>
  
  </div>
			<td><a href="option.php?id=<?=$row['id']?>" onclick="return confirm('Are you sure you wnt to delete this?');">Delete</a></td>
		</tr>
		<?php
	}
	?>
	
	<tr class="modal-trigger" href="#modal5"> 
	  <div id="modal5" class="modal">
    <div class="modal-content">

<form method="POST">

			Time
			<input type="text" name="time" value="hh:mm"/>
			<select name="tod">
				<option value="am">am</option>
				<option value="pm">pm</option>
			</select>
		
			<select>
				<option value="am">am</option>
				<option value="pm">pm</option>
			</select>
			<input type="submit" name="add" value="Add Record"/>
			<input type="reset" name="clear" value="Clear"/></td>
	
	</form>
    </div>
  
  </div>
		<td>Add Time</td>
		<td></td>
		<td></td>
	</tr>
	
</table>

<?php

if(isset($_GET['id'])){
	$delMode=delMode($connect, $_GET['id']);
	
	if($delMode){
		echo "Deleted!";
	}
	else{
		echo "Not working!";
	}
}
?>







	<!--================================================================!-->
	<!--================================PAYMENT MODE ================================!-->
<table>
	<tr>

		<th>Mode</th>
		
	</tr>
	<?php
	while($row=mysqli_fetch_assoc($result1)){
		?>
		<tr>
			<td class="modal-trigger" href="#modal2"><?=$row['mode']?></td>
	<div id="modal2" class="modal">
    <div class="modal-content">
      <form method="POST">
			Paymend Mode:
			<input class="input_field" name="mode">asdasd</input>
			<input type="submit" name="edit" value="Edit Record"/>		
</form>
    </div>
  
  </div>
			<td><a href="option.php?id=<?=$row['id']?>" onclick="return confirm('Are you sure you want to delete this?')";>Delete</a></td>
		</tr>
		<?php
	}
	?>
	<tr class="modal-trigger" href="modal6"> 
	  <div id="modal6" class="modal">
    <div class="modal-content">

<form method="POST">
			Mode
			<input type="text" name="mode" value=""/>
			<input type="submit" name="add" value="Add Record"/>
			<input type="reset" name="clear" value="Clear"/></td>
			</form>
    </div>
  
  </div>
		<td>Add Payment Mode</td>
		<td></td>
		<td></td>
	</tr>
</table>

<?php

if(isset($_GET['id1'])){
	$delStatus=delStatus($connect, $_GET['id1']);
	
	if($delStatus){
		echo "Deleted!";
	}
	else{
		echo "Not working!";
	}
}
?>
<!--================================ACADEMIC STATUS================================!-->
<table>
	<tr>
		<th> Academic Status</th>
	</tr>
	<?php
	while($row=mysqli_fetch_assoc($result3)){
		?>
		<tr class="modal-trigger" href="#modal3">
			<td><?=$row['status']?></td>
			  <div id="modal3" class="modal">
				<div class="modal-content">
				<form method="POST">
			Academic Status:
			<input class="input_field" name="mode" value="<?=$getStatus['status']?>"/>
			<input type="submit" name="edit" value="Edit Record"/>		
</form>
    </div>
  
  </div>
			<td><a href="option.php?id=<?=$row['id']?>" onclick="return confirm('Are you sure you want to delete this?')";>Delete</a></td>
		</tr>
		<?php
	}
	?>
	<tr class="modal-trigger" href="#modal7"> 
	  <div id="modal7" class="modal">
    <div class="modal-content">

<form method="POST">
			Academic Status
			<input type="text" name="status" value=""/>
			<input type="submit" name="add" value="Add Record"/>
			<input type="reset" name="clear" value="Clear"/></td>
			</form>
    </div>
  
  </div>
		<td>Add Academic Status</td>
		<td></td>
		<td></td>
	</tr>
</table>

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
	<!--================================GRADE LEVEL================================!-->
<table>
	<tr>
		<th>Grade Level</th>
	</tr>
	<?php
	while($row=mysqli_fetch_assoc($result2)){
		?>
		<tr class="modal-trigger" href="#modal4">
			<td><?=$row['grade_levels']?></td>
			  <div id="modal4" class="modal">
    <div class="modal-content">
<form method="POST">
			Grade Level:
			<input class="input_field" name="mode" value="<?=$getGrades['grade']?>"/>
			<input type="submit" name="b" value="Edit Record"/>		
</form>
    </div>
  
  </div>
			<td><a href="option.php?id=<?=$row['id']?>" onclick="return confirm('Are you sure you want to delete this?')";>Delete</a></td>
		</tr>
		<?php
	}
	?>
	<tr class="modal-trigger" href="#modal8"> 
	 
  <div id="modal8" class="modal">
    <div class="modal-content">

<form method="POST">
			Grade Level
			<input type="text" name="grade" value=""/>
			<input type="submit" name="add" value="Add Record"/>
			<input type="reset" name="clear" value="Clear"/></td>
			</form>
    </div>
  
  </div>
		<td>Add Grade</td>
		<td></td>
		<td></td>
	</tr>
</table>


<script src="jquery-2.1.3.min.js">


</script>

<script>

$(function(){
	$(".clickablerow").click(function(){
		window.document.location=$(this).attr("href");
	});
});


</script>

    <script src="http://www.gstatic.com/external_hosted/picturefill/picturefill.min.js"></script>
  <script src="asd/js/materialize.js"></script>
  <script src="asd/js/init.js"></script>
  
  