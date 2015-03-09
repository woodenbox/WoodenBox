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
	

	if($delTime){
		echo "Deleted!";
	}
	else{

		echo "Not working!";
	}
}



$getTime=mysqli_fetch_assoc(getTime($connect, $_GET['id']));
		$getMode=mysqli_fetch_assoc(getMode($connect, $_GET['id']));
$getGrade=mysqli_fetch_assoc(getGrade($connect, $_GET['id']));
$getStatus=mysqli_fetch_assoc(getStatus($connect, $_GET['id']));

	if(isset($_POST['a'])){
		extract($_POST);
			updateStatus($connect,$_GET['id'], $status);
			}
			
				

	if(isset($_POST['b'])){
		extract($_POST);
			updateMode($connect,$_GET['id'], $mode);
			}
	

	if(isset($_POST['c'])){
		extract($_POST);
			updateMode($connect,$_GET['id'], $mode);
			}
				

	if(isset($_POST['d'])){
		extract($_POST);
			updateTime($connect,$_GET['id'], $time);
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
			Time
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
	
	<tr class="clickablerow" href="add/addT.php"> 
		<td>Add Time</td>
		<td></td>
		<td></td>
	</tr>
	
</table>

<?php

if(isset($_GET['id3'])){
	$delMode=delMode($connect, $_GET['id3']);
	
	if($delMode){
		echo "Deleted!";
	}
	else{
		echo "Not working!";
	}
}
?>

<table>

	<tr>
		<th>Mode</th>
		
	</tr>
	<?php
	while($row=mysqli_fetch_assoc($result1)){
		?>
		<tr class="clickablerow" href="edit/editM.php?id=<?=$row['id']?>">
			<td><?=$row['mode']?></td>
			<td><a href="option.php?id=<?=$row['id']?>" onclick="return confirm('Are you sure you want to delete this?')";>Delete</a></td>
		</tr>
		<?php
	}
	?>
	<tr class="clickablerow" href="add/addM.php"> 
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

<table>

	<tr>
		
		<th> Academic Status</th>
		
	</tr>
	<?php
	while($row=mysqli_fetch_assoc($result3)){
		?>
		<tr class="clickablerow" href="edit/editA.php?id=<?=$row['id']?>">
			<td><?=$row['status']?></td>
			<td><a href="option.php?id=<?=$row['id']?>" onclick="return confirm('Are you sure you want to delete this?')";>Delete</a></td>
		</tr>
		<?php
	}
	?>
	<tr class="clickablerow" href="add/addA.php"> 
		<td>Add Academic Status</td>
		<td></td>
		<td></td>
	</tr>
</table>

<?php

if(isset($_GET['id2'])){
	$delGrade=delGrade($connect, $_GET['id2']);
	if($delGrade){
		echo "Deleted!";
	}
	else{
		echo "Not working!";
	}
}


















?>

<table>
	<tr>
		<th>Grade Level</th>
	</tr>
	<?php
	while($row=mysqli_fetch_assoc($result2)){
		?>
		<tr class="clickablerow" href="edit/editG.php?id=<?=$row['id']?>">
			<td><?=$row['grade_levels']?></td>
			<td><a href="option.php?id=<?=$row['id']?>" onclick="return confirm('Are you sure you want to delete this?')";>Delete</a></td>
		</tr>
		<?php
	}
	?>
	<tr class="clickablerow" href="add/addG.php"> 
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
<div id="footer" style="margin-bottom:-824px;">
<footer class="page-footer blue lighten-1">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">WoodenBox</h5>
                <p class="grey-text text-lighten-4">With the combined efforts of four students from Don Bosco Technical College, here is WoodenBox, a student accounts penalty System with printable statement of accounts and cash flow.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text"></h5>
                <ul>
            
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2015 Noah's Ark Institute of Learning, All rights reserved.
            <a class="grey-text text-lighten-4 right" href="#!"></a>
            </div>
          </div>
        </footer>
    <script src="http://www.gstatic.com/external_hosted/picturefill/picturefill.min.js"></script>
  <script src="asd/js/materialize.js"></script>
  <script src="asd/js/init.js"></script>
  
  