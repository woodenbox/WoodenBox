<?php
	session_start();
	include('header.php');
	include('processes/process.php');
	$connect=connectDB();

	$_SESSION['studentfee'] = $_GET['id'];
	if(!isset($_GET['by'])){
		$_GET['by']='student_id';
	}

	if(!isset($_GET['sortby'])){
		$_GET['sortby'] = 'DESC';
	}

	$table=viewStudents($connect, $_GET['by'], $_GET['sortby']);
	
	
	$datengayon = date('Y-m-d');
	$percentage = 0.05;


	$checkStudent = viewStudentAccount($connect, $_GET['id']);
	$viewStudent = mysqli_fetch_assoc($checkStudent);

	if($viewStudent['student_id'] == null){
		echo "<script>alert('Student Not Found'); window.location.href='index.php';</script>";
	}

	$getPenalty = getPenalty($connect, $_GET['id']);

				$duee=add('2011-01-30', 1);
	updateLastAccessed($connect, $datengayon, $_GET['id']);
	while($updatePenaltyRow = mysqli_fetch_assoc($getPenalty)){
		$x = 0;
		$due_date = $updatePenaltyRow['due_date'];
		if(strtotime($due_date) < strtotime($datengayon) && $due_date!=null && $updatePenaltyRow['waive'] == 0){
			echo $datengayon;
		while(strtotime($due_date) < strtotime($datengayon)){
			$x = $x+1;
			//$due_date = date("Y-m-d", strtotime("next month", strtotime($due_date)));
			$due_date1 = add($due_date, 1);
			//$due_date=add('2011-01-28', 1);
			//echo $due_date1->format('Y-m-d');
			$due_date = $due_date1->format('Y-m-d');
			//echo $due_date . "</br>";
			/*$time = strtotime("2010.12.11");
			$final = date("Y-m-d", strtotime("+1 month", $time))	
*/		}
			$str = $due_date;
			//echo $str;
			$year = date('Y', strtotime($str));
			$month = date('m', strtotime($str));
			//echo $month;
			//echo $year;
			//echo date('Y-m-d', strtotime("$year-$month-30"));

			if(date('m', strtotime($str)) != 02 /*&& date('d', strtotime($str))==28*/){
				$due_date= date('Y-m-d', strtotime("$year-$month-30"));
			}
			$y = $updatePenaltyRow['penalty_count'] + $x;
		$penaltybalanceSum = (($updatePenaltyRow['balance'] * $percentage) * $x) + $updatePenaltyRow['penalty_balance'];
		updatePenalty($connect, $updatePenaltyRow['id'], $y, $penaltybalanceSum, $due_date);
		}
	}

		$getTotalBalance = getTotalBalancePrint($connect, $_GET['id'], $datengayon);
		$viewTotalBalance = mysqli_fetch_assoc($getTotalBalance);
	
	if(isset($_POST['submit'])){
		session_start();
		$_SESSION['studenttransac'] = 1;
		header('Location: payment.php');
	}

	if(isset($_POST['delete'])){
		deleteStudent($connect, $_GET['id']);
		header('Location: studentaccounts.php');
	}

	if(isset($_POST['edit'])){
		header('Location: editstudent.php?id='.$_GET['id']);
	}

	if(isset($_POST['reenrol'])){
		header('Location: reenroll.php?id='.$_GET['id']);
	}
		if(isset($_POST['asd'])){
		extract($_POST);
		insertOtherRecords($connect, $_GET['id'], $grade_level, $quarter, $average);
		header('Location: viewstudent.php?id='.$_GET['id']);
	}

	if(isset($_POST['return'])){
		header('Location: viewstudent.php?id='.$_GET['id']);
	}
	
	
?>
<!--================================ crap ^ ================================!-->
<head>
	<title>Student Accounts</title>
</head>



<div class="section no-pad-bot blue lighten-1" id="index-banner">
        <div class="container nav-wrapper">
	
          <h1 class="header center-on-small-only white-text">Student Accounts</h1>
          <div class='row '>
            <h4 class ="header light blue-text text-lighten-4">  Current balance of students
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
		  
		  
		  
		  <div class="container"><a href="#" data-activates="nav-mobile" class="button-collapse top-nav full"></a></div>
      <ul id="nav-mobile" class="side-nav fixed">

	   <li class="logo" style="padding-left:45px;padding-top:15px;"><image src="asdg.png"></li>
	   <div class="section"></div>
	  <div class="divider"></div><div class="section"></div>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<b><a  class="waves-effect waves-green" style="font-size:14px;" href="index.php">Cash Reports<?echo"\t";?></a></li>
<li class="active blue lighten-1" style="padding-top:15px;padding-bottom:15px;">	<a  style="font-size:14px;" href="studentaccounts.php" class="white-text wwaves-effect waves-green">Student Accounts<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="search.php" class="waves-effect waves-green">Student List<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="addstudent.php" class="waves-effect waves-green">Add Student<?echo"\t";?></a></li>
  </ul>	
</b>



</br>
</br>

<!--================================ div ulit para sa scrollbar. students table ================================!-->
<div class="section no-pad-bot blue lighten-1" id="index-banner">
        <div class="container nav-wrapper">
	
          <h1 class="header center-on-small-only white-text">Student Info</h1>
          <div class='row '>
            <h4 class ="header light blue-text text-lighten-4">  Student General Information
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
		   <div class="container"><a href="#" data-activates="nav-mobile" class="button-collapse top-nav full"></a></div>
      <ul id="nav-mobile" class="side-nav fixed">

	   <li class="logo" style="padding-left:45px;padding-top:15px;"><image src="asdg.png"></li>
	   <div class="section"></div>

<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<b><a  class="waves-effect waves-green" style="font-size:14px;" href="index.php">Cash Reports<?echo"\t";?></a></li>
<li class="" style="padding-top:15px;padding-bottom:15px;">	<a  style="font-size:14px;" href="studentaccounts.php" class=" waves-effect waves-green">Student Accounts<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="search.php" class="waves-effect waves-green">Student List<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="addstudent.php" class="waves-effect waves-green">Add Student<?echo"\t";?></a></li>
  </ul>	
</b>



</br>
</br>



<!--================================ student info ================================!-->

<div style="margin-left:290px;margin-right:1300px;margin-top:-180px;">
<form method="POST">
<!--================================ some buttons ================================!-->

<button class="btn waves-effect waves-light green" type="submit" name="delete" value="Delete Student" style="position: relative;top:150px;left: 700px;" >Delete Student</button></br>
<button class="btn waves-effect waves-light green" type="submit" name="reenrol" value="Re-enroll Student" style="position: relative;top:160px; left: 700px;"  >Re-enroll Student</button></br>
<button class="btn waves-effect waves-light green" type="submit" name="edit" value="Edit" style="position: relative;top:170px; left: 700px;"  >Edit Student</button></br>


	<img class="backup_picture" src="uploads/<?=$_GET['id']?>" alt="Student Image" height="150" width="150">
	
	<label style="position: relative;top:-145px;margin-left:170px;margin-top:-0px;">First Name:</label>
	<label style="position: relative;top:-163px;left: 65px;margin-left:170px;margin-top:-0px;"><?=$viewStudent['first_name']?></label></br>
	<label style="position: relative;top:-181px;left: 135px;margin-left:170px;margin-top:-0px;">Last Name:</label>
	<label style="position: relative;top:-199px;left: 200px;margin-left:170px;margin-top:-0px;"><?=$viewStudent['last_name']?></label></br>
	<label style="position: relative;top:-216px;left: 260px;margin-left:170px;margin-top:-0px;">Middle Name:</label>
	<label style="position: relative;top:-234px;left: 338px;margin-left:170px;margin-top:-0px;"><?=$viewStudent['middle_name']?></label></br>
	<label style="position: relative;top:-228px;left: 0px;margin-left:170px;margin-top:-0px;">Age:</label>
	<label style="position: relative;top:-246px;left: 30px;margin-left:170px;margin-top:-0px;"><?=$viewStudent['age']?></label></br>
	<label style="position: relative;top:-264px;left: 80px;margin-left:170px;margin-top:-0px;">Grade:</label>
	<label style="position: relative;top:-282px;left: 119px;margin-left:170px;margin-top:-0px;"><?=$viewStudent['grade']?></label></br>
	<label style="position: relative;top:-275px;left: 0px;margin-left:170px;margin-top:-0px;">From:</label>
	<label style="position: relative;top:-292px;left: 37px;margin-left:170px;margin-top:-0px;"><?=$viewStudent['fromTime']?></label></br>
	<label style="position: relative;top:-310px;left: 100px;margin-left:170px;margin-top:-0px;">To:</label>
	<label style="position: relative;top:-328px;left: 124px;margin-left:170px;margin-top:-0px;"><?=$viewStudent['toTime']?></label></br>
	<label style="position: relative;top:-322px;left: 0px;margin-left:170px;margin-top:-0px;">Academic Status:</label>
	<label style="position: relative;top:-340px;left: 102px;margin-left:170px;margin-top:-0px;"><?=$viewStudent['academicstatus']?></label></br>
	<label style="position: relative;top:-333px;left: 0px;margin-left:170px;margin-top:-0px;">Payment Mode:</label>
	<label style="position: relative;top:-351px;left: 89px;margin-left:170px;margin-top:-0px;"><?=$viewStudent['paymentmode']?></label></br>
	

<div class="divider" style="position:relative;top: -300px;"></div>.



<!--================================ table ng mga bayarin ================================!-->	

<div style="position: relative;bottom:320px;">

<table name="first_name">
			<p style="font-size: 14px;font-weight:bold;position: relative; " class="blue-text text lighten-2">Item</th></p>
			<p style="font-size: 14px;font-weight:bold;position: relative; bottom: 44px;left:140px;"class="blue-text text lighten-2">Balance</th></p>
			<p style="font-size: 14px;font-weight:bold;position: relative; bottom: 88px;left: 280px;" class="blue-text text lighten-2">Due Date</th></p>
			<p style="font-size: 14px;font-weight:bold;position: relative; bottom: 132px;left: 420px;" class="blue-text text lighten-2">Penalty</th></p>
			<p style="font-size: 14px;font-weight:bold;position: relative; bottom: 176px;left: 580px;" class="blue-text text lighten-2">Penalty Count</th></p>
		
		
	

<?php
	$table=getStudentBalance($connect, $_GET['id']);	
	while($row=mysqli_fetch_assoc($table)){
?>
		<tr class="editBalance" href="editbalan.php?id=<?=$row['id']?>">
			<td style="position: relative;left:-30px;top: -187px;"><?=$row['item']?></td>
			<td style="position: relative;left:20px;top:-187px;"><?=$row['balance']?></td>
			<td style="position: relative;left:90px;top: -187px;"><?=$row['due_date']?></td>
			<td style="position: relative;left:180px;top: -187px;"><?=$row['penalty_balance']?></td>
			<td style="position: relative;left:300px;top: -187px;"><?=$row['penalty_count']?></td>
			<td style="position: relative;left:450px;top: -187px;"><?php if($row['waive']==0) echo ""; else echo "Waived";?></td>
		</tr>	
<?php	
	}
?>
	</table></div>
<!--================================ table ng mga bayarin ================================!-->
<div style="position: relative;bottom:470px;">
		<button class="btn waves-effect waves-light green" type="submit" name="submit" value="Make Payment">Make Payment</button>
		<button class="btn waves-effect waves-light green" type="button" onclick="frames['frame'].print()" value="Print Accounts" style="position: relative; left:200px; top:-50px;;">Print Accounts</button>
</div>
<!--================================ total receivables ng mga bayarin ================================!-->
<div style="position: relative;bottom:470px;">
	<p style="font-weight:bold">	Total Receivables This Month:</p> <?php if($viewTotalBalance['total']==null) echo "None"; else echo $viewTotalBalance['total'];?>

</div>
<!--================================ additional info table ================================!-->
<table>
<p style="font-size: 14px;font-weight:bold;position: relative;bottom:430px; " class="blue-text text lighten-2">Grade Level</p>
<p style="font-size: 14px;font-weight:bold;position: relative;bottom:474px; left:200px; " class="blue-text text lighten-2">			Quarter</p>
<p style="font-size: 14px;font-weight:bold;position: relative;bottom:518px; left:370px;" class="blue-text text lighten-2">			Average</p>
		
	

<?php
	$table=getAcademicStatus($connect, $_GET['id']);	
	while($row=mysqli_fetch_assoc($table)){
?>
		<tr class='editRowAS' href="editacademicstatus.php?id=<?=$row['id']?>">
			<td style="position:relative;bottom:520px;"><?=$row['grade_level']?></td>
			<td style="position:relative;bottom:520px;left:20px;"> <?=$row['quarter']?></td>
			<td style="position:relative;bottom:520px;;left: 135px;"><?=$row['average']?></td>
		</tr>	
<?php	
	}
?>	
		<tr class='clickableRowAS' href="addacademicstatus.php?id=<?=$_GET['id']?>">
			<td style="position:relative;bottom:520px;">Add Data</td>
			<td></td>
			<td></td>
		</tr>
</table>
<!--================================ additional info table ================================!-->

<!--================================ more additional info table ================================!-->
<table>
	
		<p style="font-size: 14px;font-weight:bold;position: relative;bottom:400px; " class="blue-text text lighten-2">	Date</p>
		<p style="font-size: 14px;font-weight:bold;position: relative;bottom:444px;left:200px; " class="blue-text text lighten-2">	Sent To</p>
		<p style="font-size: 14px;font-weight:bold;position: relative;bottom:488px;left: 370px; " class="blue-text text lighten-2">	Reason</p>
	

<?php
	$table=getOtherRecords($connect, $_GET['id']);	
	while($row=mysqli_fetch_assoc($table)){
?>
		<tr class='editRowOR' href="editotherrecords.php?id=<?=$row['id']?>">
			<td style="position:relative;bottom:490px; left:-20px;"><?=$row['date']?></td>
			<td style="position:relative;bottom:490px; left:80px;"><?=$row['sent_to']?></td>
			<td style="position:relative;bottom:490px; left:155px;"><?=$row['reason']?></td>
		</tr>	
<?php	
	}

?>	



		<tr>
			<td style="position:relative;bottom:500px;"> <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Add data</a>
  <div id="modal1" class="modal">
    <div class="modal-content">
      <form method="POST">
	<label>Date</label><input type="date" name="grade_level"/></br>
	<label>Sent To</label><input type="text" name="quarter" pattern="[A-Za-z0-9]+"/></br>
	<label>Reason</label><input type="text" name="average" pattern="[A-Za-z0-9]+"/></br>

	<input type="submit" name="asd" value="Save"></br>
	<input type="submit" name="return" value="Cancel">
</form>

 
    </div>
   
  </div></td>
			<td></td>
			<td></td>
		</tr>
</table>
<!--================================ more additional infor table ================================!-->



<!--================================ some buttons ================================!-->


</form>
<!--================================  crap V ================================!-->



<script src="jquery-2.1.3.min.js"></script>



<script>
$(function(){

    /*$(".backup_picture").error(function(){
        $(this).attr('src', 'uploads/imagethumbnail.png');
    });*/
    $('#fames').hide();

    $(".clickableRowAS").click(function() {
            window.document.location = $(this).attr("href");
      });
    
    $(".editRowAS").click(function() {
            window.document.location = $(this).attr("href");
      });

    $(".clickableRowOR").click(function() {
            window.document.location = $(this).attr("href");
    });

    $(".editRowOR").click(function() {
            window.document.location = $(this).attr("href");
    });

    $(".editBalance").click(function() {
            window.document.location = $(this).attr("href");
    });
});
</script>

<iframe id='fames' src="printsb.php?id=<?=$_GET['id']?>" name="frame"></iframe>
<?php
	include('footer.php');
?>
</div>
<div id="footer" style="margin-bottom:-824px;">
<footer class="page-footer blue lighten-1">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">WoodenBox</h5>
                <p class="grey-text text-lighten-4">With the combined efforts of four students from Don Bosco Technical College, here is WoodenBox, a student accounts penalty System with printable statement of accounts and cash flow.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text"></h5>
                <ul>
            
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2015 Noah's Ark Institute of Learning, All rights reserved.
            <a class="grey-text text-lighten-4 right" href="#!"></a>
            </div>
          </div>
        </footer>
            </div>
    <script src="http://www.gstatic.com/external_hosted/picturefill/picturefill.min.js"></script>
  <script src="asd/js/materialize.js"></script>
  <script src="asd/js/init.js"></script>
  
  
<div style="padding-left:290px;padding-right:270px;">
<div id="table-scroll" style="height:50%;overflow:auto;">
<table >
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

<?php
	while($row=mysqli_fetch_assoc($table)){
?>
		<tr href="viewstudent.php?id=<?=$row['student_id']?>" class="clickableRow <?php if($row['total_balance']==0) echo "green lighten-3"; 
																					 else echo ""; ?>">
			<td><?=$row['last_name']?></td>
			<td><?=$row['first_name']?></td>
			<td><?=$row['age']?></td>
			<td><?=$row['grade']?></td>
			<td><?=$row['academicstatus']?></td>
			<td><?=$row['last_accessed']?></td>
			<td><?php if($row['total_balance']==0) echo "Clear"; else echo $row['total_balance'];?></td>
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