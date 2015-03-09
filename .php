<?php
	session_start();
	include('header.php');
	include('processes/process.php');
	$connect=connectDB();

/*	if(!isset($_GET['page'])){
		$_GET['page']=1;
	}
*/
	

	$table=searchStudents($connect, "");
/*	$total=mysqli_num_rows($table);
	$rows=15;
	$pages=ceil($total/$rows);
	$table=viewStudentsPage($connect, $_GET['page'], $rows);
*/
	if(isset($_POST['submit'])){
		extract($_POST);
		$table=searchStudents($connect, $_POST['search']);
		/*$total=mysqli_num_rows($table);
		$rows=15;
		$pages=ceil($total/$rows);
		$table=searchStudentsPage($connect, $_GET['page'], $rows, $_POST['search']);*/
	}

?>
<div class="section no-pad-bot red lighten-2" id="index-banner">
        <div class="container nav-wrapper">
	
          <h3 class=" header center-on-small-only white-text">Search</h3>
          <div class='row '>
            <h4 class ="header light red-text text-lighten-4">  
			

			
						
	<form method="POST" enctype="multipart/form-data">
	
	<input class="col s6 white-text" type="text" placeholder="Search" pattern="[A-Za-z]+" name="search" /></br>
	
	
	<input class="waves-effect waves-light btn-large red lighten-3 mdi-action-search" type="submit" name="submit" value="Search"></a>
</form>

			
			
			
			
			
			
			
			
			
			

			
			
 </h4>

  
  
 <h4 class="right-align" style="margin-top:-50px;"><a class="dropdown-button" href="#!" data-activates="dropdown1"> <i class="mdi-communication-message white-text waves-effect waves-red"></i></a>
 
 
  <a class="dropdown-button" href="#!" data-activates="dropdown1"> <i class="mdi-action-account-box white-text waves-effect waves-red"></i></a></h4>
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
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a  style="font-size:14px;" href="studentaccounts.php" class="waves-effect waves-green">Student Accounts<?echo"\t";?></a></li>
<li class="active red lighten-2" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="search.php" class=" white-text waves-effect waves-green">Search<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="addstudent.php" class="waves-effect waves-green">Add Student<?echo"\t";?></a></li>
  </ul>	
</b>












</br>
</br>
<!--<?php
	/*if($total>1){
		for($count=1;$count<=$pages;$count++){
?>
<?php if($count==$_GET['page'])?><a href="search.php?page=<?=$count?>"><?=$count?></a>
<?php
		}
	}*/
?>!-->
<!--<div style="height:60%; overflow:auto;">!-->

<!--<?php
	/*if($total>1){
		for($count=1;$count<=$pages;$count++){
?>
<?php if($count==$_GET['page'])?><a href="search.php?page=<?=$count?>"><?=$count?></a>
<?php
		}
	}
*/?>!-->

<div id="table-scroll" style="height:60%;overflow:auto;">
<table>
	<thead class="red-text text lighten-2">
		<tr>
			<th>Lastname</th>
			<th>Firstname</th>
			<th>Age</th>
			<th>Grade</th>
			<th>Academic Status</th>
		</tr>
	</thead>

<?php
	while($row=mysqli_fetch_assoc($table)){
?>
		<tr class='clickableRow' href="viewstudent.php?id=<?=$row['student_id']?>">
			<td><?=$row['last_name']?></td>
			<td><?=$row['first_name']?></td>
			<td><?=$row['age']?></td>
			<td><?=$row['grade']?></td>
			<td><?=$row['academicstatus']?></td>
		</tr>	
<?php	
	}
?>
</table>

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
