<?php
	session_start();
	
	include('processes/process.php');
	$connect=connectDB();

	if(!isset($_GET['by'])){
		$_GET['by']='student_id';
	}

	if(!isset($_GET['sortby'])){
		$_GET['sortby'] = 'DESC';
	}

	$table=viewStudents($connect, $_GET['by'], $_GET['sortby']);
	$active = 2;

?>



    <?php $header = "Student Accounts";?>
	<?php $header2 =  "Current Balance of Students";

	include('header.php');?>











<!--=============================== crap ^ ================================!-->
<head>
	<title>Student Accounts</title>
</head>




<!--================================ div ulit para sa scrollbar. students table ================================!-->

<div style="position: relative;width: 80%;bottom: -2%; left: 16%;">
<div id="table-scroll" style="height:60%;overflow:auto;width: 95%;">
<table style="font-size:75%;" class="hoverable center" >
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
<?php
	while($row=mysqli_fetch_assoc($table)){
?>
		<tr href="viewstudent.php?id=<?=$row['student_id']?>" class="clickableRow <?php if($row['total_balance']==0 && $row['state']==0) echo "green lighten-3"; 
																					 else if($row['state']==1){ echo"grey lighten-3 grey-text text-lighten-1"; } else echo ""; ?>">
			<td><?=$row['last_name']?></td>
			<td><?=$row['first_name']?></td>
			<td><?=$row['age']?></td>
			<td><?=$row['grade']?></td>
			<td><?=$row['academicstatus']?></td>
			<td><?=$row['last_accessed']?></td>
			<td><?php 

			if($row['total_balance']==0 && $row['state']==0)

			 echo "Clear";
			 else if($row['state']==1) echo "Deleted"; 
			 else echo $row['total_balance'];?></td>
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