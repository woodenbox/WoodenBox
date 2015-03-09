<?php
	session_start();
	include('header.php');
	include('processes/process.php');
	$connect=connectDB();

	if(!isset($_GET['by'])){
		$_GET['by']='student_id';
	}

	if(!isset($_GET['sortby'])){
		$_GET['sortby'] = 'DESC';
	}

	$table=viewStudents($connect, $_GET['by'], $_GET['sortby']);
?>
<!--================================ crap ^ ================================!-->
<head>
	<title>Student Accounts</title>
</head>



<div class="section no-pad-bot blue lighten-1" id="index-banner">
        <div class="container nav-wrapper">
	
          <h1 class="header center-on-small-only white-text">Student Accounts</h1>
          <div class='row '>
            <h4 class ="header light blue-text text-lighten-4">  Current balance of students
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
<li class="active blue lighten-1" style="padding-top:15px;padding-bottom:15px;">	<a  style="font-size:14px;" href="studentaccounts.php" class="white-text wwaves-effect waves-green">Student Accounts<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="search.php" class="waves-effect waves-green">Student List<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="addstudent.php" class="waves-effect waves-green">Add Student<?echo"\t";?></a></li>
  </ul>	
</b>



</br>
</br>

<!--================================ div ulit para sa scrollbar. students table ================================!-->

<div style="padding-left:290px;padding-right:270px;">
<div id="table-scroll" style="height:50%;overflow:auto;">
<table >
	<thead class="blue-text text lighten-2">
		<tr>
			<th class='clickableRow' <?php if($_GET['sortby']=='ASC') echo 'href="studentaccounts.php?by=last_name&sortby=DESC"'; else echo 'href="studentaccounts.php?by=last_name&sortby=ASC"';?>>Lastname</th>
			<th class='clickableRow' <?php if($_GET['sortby']=='ASC') echo 'href="studentaccounts.php?by=first_name&sortby=DESC"'; else echo 'href="studentaccounts.php?by=first_name&sortby=ASC"';?>>Firstname</th>
			<th class='clickableRow' <?php if($_GET['sortby']=='ASC') echo 'href="studentaccounts.php?by=age&sortby=DESC"'; else echo 'href="studentaccounts.php?by=age&sortby=ASC"';?>>Age</th>
			<th class='clickableRow' <?php if($_GET['sortby']=='ASC') echo 'href="studentaccounts.php?by=grade&sortby=DESC"'; else echo 'href="studentaccounts.php?by=grade&sortby=ASC"';?>>Grade</th>
			<th class='clickableRow' <?php if($_GET['sortby']=='ASC') echo 'href="studentaccounts.php?by=academicstatus&sortby=DESC"'; else echo 'href="studentaccounts.php?by=academicstatus&sortby=ASC"';?>>Academic Status</th>
			<th class='clickableRow' <?php if($_GET['sortby']=='ASC') echo 'href="studentaccounts.php?by=last_accessed&sortby=DESC"'; else echo 'href="studentaccounts.php?by=last_accessed&sortby=ASC"';?>>Last Updated</th>
			<th>Balance Since Last Updated</th>
		</tr>
	</thead>

<?php
	while($row=mysqli_fetch_assoc($table)){
?>
		<tr href="viewstudent.php?id=<?=$row['student_id']?>" class="clickableRow <?php if($row['total_balance']==0) echo "green lighten-3"; 
																					 else echo ""; ?>">
			<td><?=$row['last_name']?></td>
			<td><?=$row['first_name']?></td>
			<td><?=$row['age']?></td>
			<td><?=$row['grade']?></td>
			<td><?=$row['academicstatus']?></td>
			<td><?=$row['last_accessed']?></td>
			<td><?php if($row['total_balance']==0) echo "Clear"; else echo $row['total_balance'];?></td>
		</tr>	
<?php	
	}
?>
</table>
</div></div>
<!--================================ students table ================================!-->

<!--================================ crap V ================================!-->
<script src="jquery-2.1.3.min.js"></script>
<script>

	$(function(){
		$(".clickableRow").click(function() {
            window.document.location = $(this).attr("href");
      });
	});

</script>

<?php
	include('footer.php');
?>