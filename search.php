<?php
	session_start();
	include('processes/process.php');
	$connect=connectDB();
	if(!isset($_GET['page'])){
		$_GET['page']=1;
	}
	if(!isset($_SESSION['sgrade'])){
		$_SESSION['sgrade']="";
	}
	if(!isset($_SESSION['sname'])){
		$_SESSION['sname']="";
	}
	$table=searchStudents($connect, $_SESSION['sname'], $_SESSION['sgrade']);
	$total=mysqli_num_rows($table);
	$rows=15;
	$pages=ceil($total/$rows);
	$table=searchStudentsPage($connect, $_GET['page'], $rows, $_SESSION['sname'], $_SESSION['sgrade']);
/*	$total=mysqli_num_rows($table);
	$rows=15;
	$pages=ceil($total/$rows);
	$table=viewStudentsPage($connect, $_GET['page'], $rows);
*/	
	if(isset($_POST['submit'])){
		extract($_POST);
		$_SESSION['sgrade']=$sgrade;
		$_SESSION['sname']=$sname;
		$_GET['page']=1;
		$table=searchStudents($connect, $sname, $sgrade);
		$total=mysqli_num_rows($table);
		$rows=15;
		$pages=ceil($total/$rows);
		$table=searchStudentsPage($connect, $_GET['page'], $rows,  $sname, $sgrade);
	}
 	$header = "Student List";
	$header2 =  "Currently Enrolled Students";
	include('header.php');
?>

<head>
	<title>Search Students</title>
</head>


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

<div style="position: relative;width: 80%;bottom: 4%; left: 16%;">
	
	

<div class="row">
  <form class="col s12 m7"  method="POST">
    <div class="row">
      <div class="input-field col s6">
        <input id="search" type="text" pattern="[A-Za-z0-9 ]+" name="sname" class="validate tooltipped" data-position="top" data-delay="50" data-tooltip="Search for a Student">
        <label for="search"><i class="mdi-action-search "></i>Search</label>
     
     </div>
     <button data-position="right" data-delay="50" data-tooltip="Search!" class="btn-floating btn-large tooltipped waves-effect waves-light white blue-text text-lighten 2 mdi-action-search" style="font-size:200%;;" type="submit" name="submit"/>
  </form>
</div>
        



</form>
</div>
<div style="padding-left:290px;padding-right:100px;margin-top:-80px;">

						
	


<div id="table-scroll" style="position:relative;height:50%; width: 150%;bottom:40%;overflow:auto;right: 42%;";>
<table  style="font-size:75%;" class="hoverable">
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
			<td class="tooltipped" data-position="top" data-delay="50" data-tooltip="Click row to view student information"><?=$row['last_name']?></td>
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
