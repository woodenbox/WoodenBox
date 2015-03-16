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
if(!isset($_GET['page'])){
		$_GET['page']=1;
	}
	/*$month=$_GET['month'];
	$year=$_GET['year'];
	$table=getCashFlowIndex($connect, $month, $year);
	$total=mysqli_num_rows($table);
	$rows=5;
	$pages=ceil($total/$rows);
	$table=viewCashFlowPage($connect,$_GET['page'],$rows, $month, $year); 
	*/
	$checkUserTable = getFandLnameDB($connect, $_SESSION['user_id']);
	$getUserRow = mysqli_fetch_assoc($checkUserTable);
	$table = getCashFlowIndex($connect, $_GET['month'], $_GET['year']);
	$total=mysqli_num_rows($table);
	$rows=5;
	$pages=ceil($total/$rows);
	$table=viewCashFlowPage($connect, $_GET['page'], $rows, $_GET['month'], $_GET['year']);
	
	
	
	
?>

<head>

  <link href="asd/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/init.css" type="text/css" rel="stylesheet" media="screen,projection"/>








	<title>Cash Flow</title>
</head>

<body>

<!--================================crap ^ ================================!-->

 <div class="section no-pad-bot blue lighten-1" id="index-banner" style="position: relative;width: 100%;height: 186px; left: 0%;">
        <div class="container nav-wrapper">
	
          <h2 style="padding-left:2%;" class="header center-on-small-only white-text">Welcome <?php echo $getUserRow['first_name'] ." ". $getUserRow['last_name']?></h1>
          <div class='row '>
            <h5 style="padding-left:2%;" class ="header light blue-text text-lighten-4">       Cash Report for the month of  <?=$_GET['month']." ".$_GET['year']?>




            	   <div style="float:right;">
  
 <h4 style="position: relative;width: 100%;top: 0; left: 0%;">

 <a class="dropdown-button" href="#!" data-activates="dropdown2" style="position: relative;width: 100%;top: 0; left: 0%;"> <i class="mdi-communication-message white-text waves-effect waves-blue"></i></a>
 
  <a class="dropdown-button" href="#!" data-activates="dropdown1" style="position: relative;width: 100%;top: 0; left: 0%;"> <i class="mdi-action-account-box white-text waves-effect waves-blue"></i></a></h4>
 <ul id='dropdown1' class='dropdown-content'>
			<li>  <a href="logout.php">Log Out</a></li>
			<?php if($_SESSION['access_control']>1){ ?><li>  <a href="option.php">Options</a></li><?php } ?>
  </ul>
  
   <ul id='dropdown2' class='dropdown-content'>
    <li><a href="#!">one</a></li>
    <li><a href="#!">two</a></li>
    <li class="divider"></li>
    <li><a href="#!">three</a></li>
  </ul>
	  
	 
	 
	 
	</div>
 </h4>


 </div>
          </div>
		  </div>

<!--================================eto ung cashflow table. merun div para sa scroll bar================================!-->

<div class="container"><a href="#" data-activates="nav-mobile" class="button-collapse top-nav full" style="position: fixed;"></a></div>
      <ul id="nav-mobile" class="side-nav fixed">

	   <li class="logo" style="padding-left:25px;padding-top:40px;"><image src="asdg.png" onclick="toast('Huehue', 400)" style="background-size:100%;"></li>
	   <div class="section"></div>  
	
<li class="active blue lighten-1" style="padding-top:15px;padding-bottom:15px;">	<b><a  class="white-text waves-effect waves-green" style="font-size:80%;" href="index.php">Cash Reports<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a  style="font-size:80%;" href="studentaccounts.php" class="waves-effect waves-green">Student Accounts<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:80%;" href="search.php" class="waves-effect waves-green">Student List<?echo"\t";?></a></li>



<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:80%;" href="addstudent.php" class="waves-effect waves-green">Add Student<?echo"\t";?></a></li>




   
   
   
   
   
   
   
   
   






  </ul>	
</b>

<div style="position: relative;width: 80%;bottom: -2%; left: 16%;">

	



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
        





 <ul class="section table-of-contents" style="position:relative;top:0%;float:right;left:2%;">
        


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

<<<<<<< HEAD

 </ul>





<div id="table-scroll" style="position:relative;height:60%; width: 90%;bottom:30px;overflow:auto;";>
<table style="font-size:75%;" class="hoverable">
=======
<div style="padding-left:290px;padding-right:270px;">
<?php
	if($total>1){
		for($count=1;$count<=$pages;$count++){

if($count==$_GET['page'])?><a href="index.php?page=<?=$count?>"><?=$count?></a>
<?php
		}
	}
?>
<div id="table-scroll" style="height:60%;overflow:auto;">
<table>
>>>>>>> no message
	<thead class="blue-text text lighten-2">
		<tr>
			<th>Date</th>
			<th>Student</th>
			<th>A.R. Number</th>
			<th>Cash</th>
<!--			<th>D.R.</th>
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
<!--			<td><?php//$row['dr']?></td>
			<td><?php//$row['cr']?></td>!-->
			<td><?=$row['tuition']?></td>
			<td><?=$row['remark']?></td>
			<td><?php if ($_SESSION['access_control']==2){ ?> <a href="editcashflow.php?id=<?=$row['id']?>">edit<?php } else { }?></a></td>
		</tr>
<?php	
	}
?>
</table>
<?php
	if($total>1){
		for($count=1;$count<=$pages;$count++){
?>
<?php if($count==$_GET['page'])?><a href="index.php?page=<?=$count?>"><?=$count?></a>
<?php
		}
	}
?>
</div>




 
         
<!--================================eto ung cashflows table================================!-->

</br>
</br>




<!--================================eto ung listahan ng other cashflows================================!-->
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