<?php
	session_start();?>





<?php


	include('processes/process.php');
	$connect = connectDB();
	$mydate=getdate(date("U"));

	if(!isset($_GET['month'])){
		$_GET['month'] = $mydate['month'];
	}

	if(!isset($_GET['year'])){
		$_GET['year'] = $mydate['year'];
	}

	$checkUserTable = getFandLnameDB($connect, $_SESSION['user_id']);
	$getUserRow = mysqli_fetch_assoc($checkUserTable);
	$table=searchCashFlow($connect, "", "", "");
	//$table = getCashFlowIndex($connect, $_GET['month'], $_GET['year']);
	$active = 1;


	?>



    <?php $header = "Welcome " . $getUserRow['first_name'] ." ". $getUserRow['last_name'] ;?>
	<?php $header2 =  "Cash Report for the month of " . $_GET['month']." ".$_GET['year'];

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
		echo "<script>alert('".$_SESSION['cfsy']."');</script>";
		echo "<script>alert('".$_SESSION['cfgl']."');</script>";
		echo "<script>alert('".$_SESSION['cfmonth']."');</script>";
		$table=searchCashFlow($connect, $cfsy, $cfmonth, $cfgl);
	}
	?>








<head>

  <link href="asd/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/init.css" type="text/css" rel="stylesheet" media="screen,projection"/>



	<title>Cash Flow</title>
</head>

<body>

<!--================================crap ^ ================================!-->

 

	

<!--================================eto ung cashflow table. merun div para sa scroll bar================================!-->



<div style="position: relative;width: 80%;bottom: -2%; left: 16%;">



<form method="POST">	
<select name="cfsy">
	 <option value="<?php echo $selectSY['from']." - ".$selectSY['to'];?>">Current School Year</option>
  <?php while($row=mysqli_fetch_array($selectDistinctSY, MYSQLI_ASSOC)){
  	if($_SESSION==$row['sy']) $selected='selected'; else $selected='';?>
  		<option value="<?=$row['sy']?>" <?=$selected?>><?=$row['sy']?></option>
<?php   } ?>
</select>
<select name="cfmonth">
  <option value="">All Months</option>
  <?php while($row=mysqli_fetch_array($selectDistinctMonth, MYSQLI_ASSOC)){
  	if($_SESSION==$row['month']) $selected='selected'; else $selected='';?>
<option value="<?=$row['month']?>" <?=$selected?>><?=$row['month']?></option>
 <?php  } ?>
</select>


<select name="cfgl">
  <option value="">All Grade Level</option>
  <?php while($row=mysqli_fetch_array($selectDistinctGrade, MYSQLI_ASSOC)){
  	if($_SESSION==$row['grade']) $selected='selected'; else $selected='';?>
<option value="<?=$row['grade']?>" <?=$selected?>><?=$row['grade']?></option>
  <?php } ?>
</select>

<input type="submit" name="searchcf" value="Search">
</form>
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


<br>
<div id="txtHint"><b>Person info will be listed here...</b></div>



	<div class="row">
  <form class="col s12 m7" method="POST">
    <div class="row">
      <div class="input-field col s6">
        <input id="first_name" type="text" class="validate" pattern="[A-Za-z0-9 ]+" name="search">
        <label for="first_name"><i class="mdi-action-search "></i>Search</label>
      </div>
   
	<button class="btn-floating btn-large waves-effect waves-light white blue-text text-lighten 2 mdi-action-search" style="font-size:200%;;" type="submit" name="submit"/>
  </form>
</div>
        





    <div class="hide-on-small-only"  style="position:relative;top:0%;float:right;left:2%;">
      

 <ul class="section table-of-contents">
        


		<li class="blue-text text lighten-2" style="font-size:100%;">	Cash Flow List</li>
		
			<div class="divider" style="width:100%;"></div>
			
<?php
	$table2=getPreviousCashFlow($connect);	
	while($row=mysqli_fetch_assoc($table2)){
?>
	
			<li style="font-size:75%;"><a href="index.php?month=<?=$row['month']?>&year=<?=$row['year']?>" >
			<?=$row['month']." ".$row['year']?></a></li>
			
<?php	
	}
$_GET['id'] =5;
?>


 </ul>
</div>



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




 
         
<!--================================eto ung cashflows table================================!-->

</br>
</br>




<!--===============================eto ung listahan ng other cashflows================================!-->
<!-- <a class="waves-effect waves-light btn-large  green lighten-2" id='buttone'onclick="myFunction()"> Print this page </a> !-->

    </div>

<!--================================eto ung listahan ng other cashflows================================!-->

<!--================================eto ung print button================================!-->


<!--================================crap V ================================!-->
<script src="jquery-2.1.3.min.js"></script>
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
    <script src="http://www.gstatic.com/external_hosted/picturefill/picturefill.min.js"></script>
  <script src="asd/js/materialize.js"></script>
  <script src="asd/js/init.js"></script>
  
  
  </body>