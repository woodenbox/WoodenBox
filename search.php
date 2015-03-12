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
<div class="section no-pad-bot blue lighten-1" id="index-banner">
        <div class="container nav-wrapper">
	
          <h1 class=" header center-on-small-only white-text">Student List</h1>
          <div class='row '>
            <h4 class ="header light blue-text text-lighten-4">  List of currently enrolled students
			

			

			
			
			
			
			
			
			
			
			
			

			
			
 </h4>

  
  
 <h4 class="right-align" style="margin-top:-50px;"><a class="dropdown-button" href="#!" data-activates="dropdown1"> <i class="mdi-communication-message white-text waves-effect waves-blue"></i></a>
 
 
  <a class="dropdown-button" href="#!" data-activates="dropdown1"> <i class="mdi-action-account-box white-text waves-effect waves-blue"></i></a></h4>
 <ul id='dropdown1' class='dropdown-content'>
			<li>  <a href="logout.php">Log Out</a></li>
			<?php if($_SESSION['access_control']>1){ ?><li>  <a href="option.php">Options</a></li><?php } ?>
  </ul>
	  
	 
	 
	
	 
	 </ul>
 </div>
          </div>
		  </div>
		  <div class="container"><a href="#" data-activates="nav-mobile" class="button-collapse top-nav full"></a></div>
      <ul id="nav-mobile" class="side-nav fixed">

	   <li class="logo" style="padding-left:45px;padding-top:15px;"><image src="asdg.png" onclick="toast('Huehue', 400)"></li>
	   <div class="section"></div>
	  <div class="divider"></div><div class="section"></div>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<b><a  class="waves-effect waves-green" style="font-size:14px;" href="index.php">Cash Reports<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a  style="font-size:14px;" href="studentaccounts.php" class="waves-effect waves-green">Student Accounts<?echo"\t";?></a></li>
<li class="active blue lighten-1" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="search.php" class=" white-text waves-effect waves-green">Student List<?echo"\t";?></a></li>
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

<div style="padding-left:290px;padding-right:770px;margin-top:-45px;">
<form method="POST">
	
	<input class="col s2" type="text" placeholder="Search" pattern="[A-Za-z0-9 ]+" name="search">
	<button class="waves-effect waves-light btn-large blue lighten-2 mdi-action-search" style="position:relative; bottom:70px;left:860px;font-size:30px;" type="submit" name="submit">
</form>
</div>
<div style="padding-left:290px;padding-right:100px;margin-top:-80px;">

						
	


<div id="table-scroll" style="height:68%;overflow:auto;">
<table>
	<thead class="blue-text text lighten-2">
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
