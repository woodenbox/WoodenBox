<?php
	session_start();
	include('header.php');
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
	$table = getCashFlow($connect, $_GET['month'], $_GET['year']);
?>

<head>

  <link href="asd/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/init.css" type="text/css" rel="stylesheet" media="screen,projection"/>








	<title>Cash Flow</title>
</head>

<body>

<!--================================crap ^ ================================!-->

 <div class="section no-pad-bot blue lighten-1" id="index-banner">
        <div class="container nav-wrapper">
	
          <h1 class="header center-on-small-only white-text">WelcomePUTANGINANILIM<?php echo $getUserRow['first_name'] ." ". $getUserRow['last_name']?></h1>
          <div class='row '>
            <h4 class ="header light blue-text text-lighten-4">       Cash Report for the month of  <?=$_GET['month']." ".$_GET['year']?>
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

      
<!--================================eto ung cashflow table. merun div para sa scroll bar================================!-->

<div class="container"><a href="#" data-activates="nav-mobile" class="button-collapse top-nav full"></a></div>
      <ul id="nav-mobile" class="side-nav fixed">

	   <li class="logo" style="padding-left:45px;padding-top:15px;"><image src="asdg.png"></li>
	   <div class="section"></div>
	  <div class="divider"></div><div class="section"></div>
<li class="active blue lighten-1" style="padding-top:15px;padding-bottom:15px;">	<b><a  class="white-text waves-effect waves-green" style="font-size:14px;" href="index.php">Cash Reports<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a  style="font-size:14px;" href="studentaccounts.php" class="waves-effect waves-green">Student Accounts<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="search.php" class="waves-effect waves-green">Student List<?echo"\t";?></a></li>



<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="addstudent.php" class="waves-effect waves-green">Add Student<?echo"\t";?></a></li>




   
   
   
   
   
   
   
   
   






  </ul>	
</b>





<div style="padding-left:290px;padding-right:270px;">

<div id="table-scroll" style="height:50%;overflow:auto;">
<table>
	<thead class="blue-text text lighten-2">
		<tr>
			<th>Date</th>
			<th>Student</th>
			<th>A.R. Number</th>
			<th>Cash</th>
			<th>D.R.</th>
			<th>C.R.</th>
			<th>Tuition Fees</th>
			<th>Remarks</th>
		</tr>
	</thead>

<?php
	while($row=mysqli_fetch_assoc($table)){
?>
		<tr class='clickableStudent thin' href="viewstudent.php?id=<?=$row['student_id']?>">
			<td><?=$row['month']." ".date('d', strtotime($row['payment_date']))." ".$row['year']?></td>
			<td><?=$row['first_name']." ".$row['last_name']?></td>
			<td><?=$row['ar']?></td>
			<td><?=$row['cash']?></td>
			<td><?=$row['dr']?></td>
			<td><?=$row['cr']?></td>
			<td><?=$row['tuition']?></td>
			<td><?=$row['remark']?></td>
			<td><a href="editcashflow.php?id=<?=$row['id']?>">i</a></td>
		</tr>	
<?php	
	}
?>
</table>
</div>
<!--================================eto ung cashflows table================================!-->

</br>
</br>
<!--================================eto ung listahan ng other cashflows================================!-->
<a class="waves-effect waves-light btn-large  green lighten-2" id='buttone'onclick="myFunction()"> Print this page </a>

 <div style="height: 1px;width: 180px;position: relative;right: -1400px;top: -610px;">
          <ul class="section table-of-contents">
        


		<li class="blue-text text lighten-2" style="font-size:24px;">	Cash Flow List</li>
		
			<div class="divider"></div>
			
<?php
	$table=getPreviousCashFlow($connect);	
	while($row=mysqli_fetch_assoc($table)){
?>
	
			<li style="font-size:18px;"><a href="index.php?month=<?=$row['month']?>&year=<?=$row['year']?>" >
			<?=$row['month']." ".$row['year']?></a></li>
			
<?php	
	}
$_GET['id'] =5;
?>


 </ul>
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