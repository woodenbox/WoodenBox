<?php
	session_start();
	include('processes/process.php');
	$connect=connectDB();
	$selectDistinctGrade=selectDistinctGrade($connect);
	if(!isset($_GET['by'])){
		$_GET['by']='student_id';
	}
	if(!isset($_GET['sortby'])){
		$_GET['sortby'] = 'DESC';
	}
	if(isset($_POST['test'])){
		if(!isset($_POST['check_list'])){
			echo "<script>alert('Please select a student');</script>";
		} else {
		$datengayon = date('Y-m-d');
		$selectPenaltyValue=mysqli_fetch_assoc(selectPenaltyValue($connect));
		$percentage = $selectPenaltyValue['penalty']*(0.01);
		$_SESSION['check_list'] = $_POST['check_list'];
		foreach($_POST['check_list'] as $check) {	
			$getPenalty = getPenalty($connect, $check);
			updateLastAccessed($connect, $datengayon, $check);
			while($updatePenaltyRow = mysqli_fetch_assoc($getPenalty)){
				$x = 0;
				$due_date = $updatePenaltyRow['due_date'];
				if(strtotime($due_date) < strtotime($datengayon) && $due_date!=null && $updatePenaltyRow['waive'] == 0){
					echo $datengayon;
					while(strtotime($due_date) < strtotime($datengayon)){
						$x = $x+1;
						$due_date1 = add($due_date, 1);
						$due_date = $due_date1->format('Y-m-d');
					}
					$str = $due_date;
					$year = date('Y', strtotime($str));
					$month = date('m', strtotime($str));
					if(date('m', strtotime($str)) != 02){
						$due_date= date('Y-m-d', strtotime("$year-$month-30"));
					}
					$y = $updatePenaltyRow['penalty_count'] + $x;
					$penaltybalanceSum = (($updatePenaltyRow['balance'] * $percentage) * $x) + $updatePenaltyRow['penalty_balance'];
					updatePenalty($connect, $updatePenaltyRow['id'], $y, $penaltybalanceSum, $due_date);
				}
			}
			$sumBalance=mysqli_fetch_assoc(sumBalance($connect, $check));
			updateTotalBalance($connect, $check, $sumBalance['balance']);
    	}
    	echo "	<script src='jquery-2.1.3.min.js'></script>
    			<script> $(function(){
    						$(document).ready(function () {
    							window.frames['frame'].print()
							});
						});
				</script>";
			}
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
	<div style="width: 95%;">
		<form method="POST">
			<div class="input-field col s2 m2 tooltipped" data-position="top" data-delay="50" data-tooltip="Filter transactions by grade level">
	<select name="cfgl" >
		<option value="">All Grade Level</option>
<?php 	
		while($row=mysqli_fetch_array($selectDistinctGrade, MYSQLI_ASSOC)){
			if($_SESSION['cfgl']==$row['grade']) $selected='selected'; else $selected='';
?>
		<option  value="<?=$row['grade']?>" <?=$selected?>><?=$row['grade']?></option>
<?php 	
		}
?>
	</select>
    </div>
		<table style="font-size:75%;" class="hoverable center" >
			<thead class="blue-text text lighten-2">
				<tr>
					<th></th>
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
				<tr data-position="top" data-delay="50" data-tooltip="Click row to view to student information">
					<td><input type="checkbox"  id="<?=$row['student_id']?>" name="check_list[]" value="<?=$row['student_id']?>">
 						<label for="<?=$row['student_id']?>"></label>
					</td>
					<td class="tooltipped clickableRow" href="viewstudent.php?id=<?=$row['student_id']?>" data-position="top" data-delay="50" data-tooltip="Click row to view to student information"><?=$row['last_name']?></td>
					<td class="clickableRow"  href="viewstudent.php?id=<?=$row['student_id']?>" ><?=$row['first_name']?></td>
					<td class="clickableRow"  href="viewstudent.php?id=<?=$row['student_id']?>"><?=$row['age']?></td>
					<td class="clickableRow"  href="viewstudent.php?id=<?=$row['student_id']?>"><?=$row['grade']?></td>
					<td class="clickableRow"  href="viewstudent.php?id=<?=$row['student_id']?>"><?=$row['academicstatus']?></td>
					<td class="clickableRow"  href="viewstudent.php?id=<?=$row['student_id']?>" ><?=$row['last_accessed']?></td>
					<td class="clickableRow"  href="viewstudent.php?id=<?=$row['student_id']?>" ><?php if($row['total_balance']==0 && $row['state']==0) echo "Clear"; else if($row['state']==1) echo "Deleted"; else echo $row['total_balance'];?></td>
				</tr>	
<?php	
			}
?>
		</table>
		<input type="submit" name="test" value="Print">
		</form>
	</div>
</div>
<iframe id='fames' src="testprintsb.php?" name="frame"></iframe>
<script src="jquery-2.1.3.min.js"></script>
<script>

	$(function(){
		$(".clickableRow").click(function() {
            window.document.location = $(this).attr("href");
      });
		$('#fames').hide();
	});

</script>
<?php
	include('footer.php');
?>