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
	$header = "Student Accounts";
	$header2 =  "Current Balance of Students";
	include('header.php');
?>
<head>
	<title>Student Accounts</title>
</head>
<div style="position: relative;width: 80%;bottom: -2%; left: 16%;">
	<div id="table-scroll" style="height:60%;overflow:auto;width: 95%;">
		<table style="font-size:75%;" class="hoverable center" >
			<thead class="blue-text text lighten-2">
				<tr>
					<th class='clickableRow tooltipped'  <?php if($_GET['sortby']=='ASC') echo 'href="studentaccounts.php?by=last_name&sortby=DESC"'; else echo 'href="studentaccounts.php?by=last_name&sortby=ASC"';?>data-position="top" data-delay="50" data-tooltip="Click to sort from last name">Lastname</th>
					<th class='clickableRow tooltipped' <?php if($_GET['sortby']=='ASC') echo 'href="studentaccounts.php?by=first_name&sortby=DESC"'; else echo 'href="studentaccounts.php?by=first_name&sortby=ASC"';?>data-position="top" data-delay="50" data-tooltip="Click to sort from first name">Firstname</th>
					<th class='clickableRow tooltipped' <?php if($_GET['sortby']=='ASC') echo 'href="studentaccounts.php?by=age&sortby=DESC"'; else echo 'href="studentaccounts.php?by=age&sortby=ASC"';?>data-position="top" data-delay="50" data-tooltip="Click to sort from age">Age</th>
					<th class='clickableRow tooltipped' <?php if($_GET['sortby']=='ASC') echo 'href="studentaccounts.php?by=grade&sortby=DESC"'; else echo 'href="studentaccounts.php?by=grade&sortby=ASC"';?>data-position="top" data-delay="50" data-tooltip="Click to sort from grade">Grade</th>
					<th class='clickableRow tooltipped' <?php if($_GET['sortby']=='ASC') echo 'href="studentaccounts.php?by=academicstatus&sortby=DESC"'; else echo 'href="studentaccounts.php?by=academicstatus&sortby=ASC"';?>data-position="top" data-delay="50" data-tooltip="Click to sort from academic status">Academic Status</th>
					<th class='clickableRow tooltipped' <?php if($_GET['sortby']=='ASC') echo 'href="studentaccounts.php?by=last_accessed&sortby=DESC"'; else echo 'href="studentaccounts.php?by=last_accessed&sortby=ASC"';?>data-position="top" data-delay="50" data-tooltip="Click to sort from last updated">Last Updated</th>
					<th>Balance Since Last Updated</th>
				</tr>
			</thead>
<?php
			while($row=mysqli_fetch_assoc($table)){
?>
				<tr href="viewstudent.php?id=<?=$row['student_id']?>" class="clickableRow <?php if($row['total_balance']==0 && $row['state']==0) echo "hide-on-large-only"; 
																					 else if($row['state']==1){ echo"grey lighten-3 grey-text text-lighten-1"; } else echo "";?>" data-position="top" data-delay="50" data-tooltip="Click row to view to student information">
					<td class="tooltipped" data-position="top" data-delay="50" data-tooltip="Click row to view to student information"><?=$row['last_name']?></td>
					<td><?=$row['first_name']?></td>
					<td><?=$row['age']?></td>
					<td><?=$row['grade']?></td>
					<td><?=$row['academicstatus']?></td>
					<td><?=$row['last_accessed']?></td>
					<td><?php if($row['total_balance']==0 && $row['state']==0) echo "Clear"; else if($row['state']==1) echo "Deleted"; else echo $row['total_balance'];?></td>
				</tr>	
<?php	
			}
?>
		</table>
	</div>
</div>
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