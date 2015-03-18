<?php
	session_start();
	include('processes/process.php');
	$connect = connectDB();
	$mydate=getdate(date("U"));
	if(!isset($_GET['month'])){
		$_GET['month'] = $mydate['month'];
	}
	if(!isset($_GET['year'])){
		$_GET['year'] = $mydate['year'];
	}
	if(!isset($_GET['page'])){
		$_GET['page']=1;
	}
	$checkUserTable = getFandLnameDB($connect, $_SESSION['user_id']);
	$getUserRow = mysqli_fetch_assoc($checkUserTable);
    $header = "Welcome " . $getUserRow['first_name'] ." ". $getUserRow['last_name'] ;
	$header2 =  "Cash Report for the month of " . $_GET['month']." ".$_GET['year'];
	$table=searchCashFlow($connect, "", "", "");
	include('header.php');
	$selectDistinctSY=selectDistinctSY($connect);
	$selectDistinctMonth=selectDistinctMonth($connect);
	$selectDistinctGrade=selectDistinctGrade($connect);
	$selectSY=mysqli_fetch_assoc(selectSY($connect));
	if(isset($_POST['searchcf'])){
		extract($_POST);
		$_SESSION['cfsy']=$cfsy;
		$_SESSION['cfmonth']=$cfmonth;
		$_SESSION['cfgl']=$cfgl;
		$table=searchCashFlow($connect, $cfsy, $cfmonth, $cfgl);
	}
?>
<head>
	<title>Cash Flow</title>
</head>
<form method="POST">	
	<h6 style="font-weight:400;" class="blue-text text-darken-1"> Filter by: </h6>
	<select name="cfsy" style="position:relative; left:30px;"  >
 		<option value="<?php echo $selectSY['from']." - ".$selectSY['to'];?>"><p class="blue">Current School Year</p></option>
<?php	while($row=mysqli_fetch_array($selectDistinctSY, MYSQLI_ASSOC)){
			if($_SESSION['cfsy']==$row['sy']) $selected='selected'; else $selected='';
?>
		<option value="<?=$row['sy']?>" <?=$selected?>><?=$row['sy']?></option>
<?php   } 
?>
	</select>
	<select name="cfmonth">
		<option value="">All Months</option>
<?php 	
		while($row=mysqli_fetch_array($selectDistinctMonth, MYSQLI_ASSOC)){
			if($_SESSION['cfmonth']==$row['month']) $selected='selected'; else $selected='';
?>
		<option value="<?=$row['month']?>" <?=$selected?>><?=$row['month']?></option>
<?php  
		} 
?>
	</select>
	<select name="cfgl">
		<option value="">All Grade Level</option>
<?php 	
		while($row=mysqli_fetch_array($selectDistinctGrade, MYSQLI_ASSOC)){
			if($_SESSION['cfgl']==$row['grade']) $selected='selected'; else $selected='';
?>
		<option value="<?=$row['grade']?>" <?=$selected?>><?=$row['grade']?></option>
<?php 	
		}
?>
	</select>
	<input type="submit" name="searchcf" value="Search">
</form>
<div style="position: relative;width: 80%;bottom: -2%; left: 233%;">
	<div id="table-scroll" style="position:relative;height:40%; width: 90%;bottom:40%;overflow:auto;";>
		<table style="font-size:75%;" class="hoverable">
			<thead class="blue-text text lighten-2">
				<tr>
					<th>Date</th>
					<th>Student</th>
					<th>A.R. Number</th>
					<th>Cash</th>
		<!--		<th>D.R.</th>
					<th>C.R.</th>!-->
					<th>Tuition Fees</th>
					<th>Remarks</th>
				</tr>
			</thead>
<?php
			while($row=mysqli_fetch_assoc($table)){
?>
				<tr class='thin <?php if($row['state']==1){?> grey lighten-3 grey-text text-lighten-1<?php } ?>' href="viewstudent.php?id=<?=$row['student_id']?>">
					<td><?=$row['month']." ".date('d', strtotime($row['payment_date']))." ".$row['year']?></td>
					<td><?=$row['first_name']." ".$row['last_name']?></td>
					<td><?=$row['ar']?></td>
					<td><?=$row['cash']?></td>
		<!--		<td><?php//$row['dr']?></td>
					<td><?php//$row['cr']?></td>!-->
					<td><?=$row['tuition']?></td>
					<td><?=$row['remark']?></td>
					<td><?php if ($_SESSION['access_control']==2){ ?> <a href="editcashflow.php?id=<?=$row['id']?>">edit<?php } else { }?></a></td>
				</tr>
<?php	
			}
?>
		</table>
	</div>
</div>
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
	<a class="btn-floating waves-effect waves-light btn-large  blue lighten-2 white-text tooltipped" id='buttone'onclick="myFunction()" data-position="top" data-delay="50" data-tooltip="Print!">
		<i class="large mdi-action-print"></i>
	</a>
</div>

<script>
	$(function(){
		$(".clickableRow").click(function() {
            window.document.location = $(this).attr("href");
      	});
		$(".clickableStudent").click(function() {
            window.document.location = $(this).attr("href");
      	});	      	
      	$("#buttone").click(function myFunction() {
    		$("<iframe>").hide().attr("src", "printcf.php?month=<?=$_GET['month']?>&year=<?=$_GET['year']?>").appendTo("body");   
		});
	});
</script>
<?php
//echo "<html><head></head><body> <script type='application/javascript'>window.onload=function(){window.print()}</script></body></html>";
	include('footer.php');
?>







</div>

  
  </body>