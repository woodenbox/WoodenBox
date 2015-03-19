<?php
	session_start();
	include('processes/process.php');
	$connect = connectDB();
	$mydate=getdate(date("U"));
	if(!isset($_GET['page'])){
		$_GET['page']=1;
	}
	if(!isset($_GET['month'])){
		$_GET['month'] = $mydate['month'];
	}
	if(!isset($_GET['year'])){
		$_GET['year'] = $mydate['year'];
	}
	if(!isset($_GET['page'])){
		$_GET['page']=1;
	}
	if(!isset($_SESSION['cfsy'])){
		$_SESSION['cfsy']="2014 - 2015";
	}
	if(!isset($_SESSION['cfmonth'])){
		$_SESSION['cfmonth']="";
	}
	if(!isset($_SESSION['cfgl'])){
		$_SESSION['cfgl']="";
	}
	if(!isset($_SESSION['specific'])){
		$_SESSION['specific']="";
	}

	$checkUserTable = getFandLnameDB($connect, $_SESSION['user_id']);
	$getUserRow = mysqli_fetch_assoc($checkUserTable);
    $header = "Welcome " . $getUserRow['first_name'] ." ". $getUserRow['last_name'] ;
	$header2 =  "Cash Report for the month of " . $_GET['month']." ".$_GET['year'];
	
	$table=searchCashFlow($connect, $_SESSION['cfsy'], $_SESSION['cfmonth'], $_SESSION['cfgl'], $_SESSION['specific']);
	$total=mysqli_num_rows($table);
	$rows=5;
	$pages=ceil($total/$rows);
	$table=viewStudentsPage($connect, $_GET['page'],$rows, $_SESSION['cfsy'], $_SESSION['cfmonth'], $_SESSION['cfgl'], $_SESSION['specific']);

	$getTotalCashFlow=mysqli_fetch_assoc(getTotalCashFlow($connect, $_SESSION['cfsy'], $_SESSION['cfmonth'], $_SESSION['cfgl'], $_SESSION['specific']));
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
		$_SESSION['specific']=$specific;
		$_GET['page']=1;
		$table=searchCashFlow($connect, $cfsy, $cfmonth, $cfgl, $specific);
		$total=mysqli_num_rows($table);
		$rows=5;
		$pages=ceil($total/$rows);
		$table=viewStudentsPage($connect, $_GET['page'],$rows, $_SESSION['cfsy'], $_SESSION['cfmonth'], $_SESSION['cfgl'], $_SESSION['specific']);
		$getTotalCashFlow=mysqli_fetch_assoc(getTotalCashFlow($connect, $cfsy, $cfmonth, $cfgl, $specific));
	}
?>
<head>
	<title>Cash Flow</title>
</head>
<div style="position: relative;width: 80%;bottom: -2%; left: 16%;">















<p class="blue-text text-lighten-2"></p>















	<h6 style="font-weight:400;" class="blue-text text-darken-1"> Filter by: </h6>

<div class="row">
  <form class="col s12"  method="POST">
    <div class="row" style="position: relative;bottom:35px;">

      <div class="input-field col s2  tooltipped" data-position="top" data-delay="50" data-tooltip="Filter transactions by school year">


	<select name="cfsy" style="position:relative; left:30px;"  >
 		<option value="<?php echo $selectSY['from']." - ".$selectSY['to'];?>"><p class="blue">Current School Year</p></option>
<?php	while($row=mysqli_fetch_array($selectDistinctSY, MYSQLI_ASSOC)){
			if($_SESSION['cfsy']==$row['sy']) $selected='selected'; else $selected='';
?>
		<option value="<?=$row['sy']?>" <?=$selected?>><?=$row['sy']?></option>
<?php   } 
?>

	</select>


      </div>



      <div class="input-field col s6 m2  tooltipped" data-position="top" data-delay="50" data-tooltip="Filter transactions by month">

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


      </div>

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


<div class="input-field col s4 m2"style="position: relative;padding-top: 1.5%;" >



	<input type="text" name="specific" pattern="[A-Za-z ]+" title="Please enter letters only" placeholder="Search Student Name" style="position: relative; top: 50%;" data-position="top" data-delay="50" data-tooltip="Search a student's transactions" class="tooltipped">
   </div>


<div class="input-field col s2 m2	">

	<button data-position="right" data-delay="50" data-tooltip="Search!" 
class="btn-floating btn-large tooltipped waves-effect waves-light white blue-text text-lighten 2 mdi-action-search" 
style="font-size:200%;;" type="submit" name="searchcf"/>

	 </div>
    <link href="asd/css/pagination.css" type="text/css" rel="stylesheet" media="screen,projection"/>



    </div>
   
</div>
        




</form>




	<div style="position:relative;height:40%; width: 90%;bottom:70px;";>
		<table style="font-size:75%;height:50%;" class="hoverable">
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
	<div  style="position:relative;bottom:60px;">
	<ul class="pagination">
	<?php
if($total>1){
	for($cnt=1;$cnt<=$pages;$cnt++){
?>
	<li
	<?php
		if($cnt==$_GET['page'])
			echo "class=active";
	?>
	><a href="index.php?page=<?=$cnt?>"><?=$cnt?></a></li>
<?php
	}
}
?>
</ul>
<p style="position:relative;bottom:20px;">Total Cash: <?=$getTotalCashFlow['cash']?></p>

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