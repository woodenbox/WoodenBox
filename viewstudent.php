<?php
	session_start();

	include('processes/process.php');
	$connect = connectDB();
	$datengayon = date('Y-m-d');
	$percentage = 0.05;

	$_SESSION['studentfee'] = $_GET['id'];

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
	if(isset($_POST['dsa'])){
		extract($_POST);
		insertAcademicStatus($connect, $_GET['id'], $grade_level, $quarter, $average);
		header('Location: viewstudent.php?id='.$_GET['id']);
	}
$payment_date = date('Y-m-d');

	$mydate=getdate(date("U"));


	$checkStudent = viewStudentAccount($connect, $_SESSION['studentfee']);
	$viewStudent = mysqli_fetch_assoc($checkStudent);
	
	$checkARNumber = getARNumber($connect);
	$getARNumber = mysqli_fetch_assoc($checkARNumber);

    			/*if($balance['balance'] - $_POST['amount'] > 0 ){
    				echo '<script>alert("hello");</script>';
    			}*/
            	
            	//$x = $x+$balance['balance'];
            	//echo $_POST['amount'];
			//echo $x . '</br>';
	if(isset($_POST['456'])){
		extract($_POST);
		$total=0;
		if(!empty($_POST['check_list'])) {
    		foreach($_POST['check_list'] as $check) {	
				$balance = getBalance($connect, $check) -> fetch_assoc();
				$total = $total+$balance['balance']+$balance['penalty_balance'];
    		}
    		echo '1' . $total;
    		echo '1' . $_POST ['amount'];
    		if($total >= $_POST['amount']){
    			echo '<script>alert("we are in");</script>';
    			$remaining = $_POST['amount'];
    			echo '2' . $remaining;
    			balancePayment($connect, $viewStudent['last_name'], $viewStudent['first_name'], $payment_date, $_POST['amount'], $_SESSION['studentfee'], $mydate['month'], $mydate['year'], $_POST['arnumber'], $_POST['dr'], $_POST['cr'], $_POST['
				
				
				']);
    			foreach($_POST['check_list'] as $check) {
    					$balance = getBalance($connect, $check) -> fetch_assoc();
    					$remaining = ($balance['balance']) - $remaining;
    					echo '3' . $remaining;
    					if($remaining > 0){
    						echo '4' . $remaining;
    						balanceClear($connect, $check, $remaining);
    						break;
    					} else if ($remaining <= 0){
    						echo '4' . $remaining;
    						$remaining = (-1*$remaining);
    						balanceClear($connect, $check, 0);
    						$remaining = ($balance['penalty_balance']) - $remaining;
    						if($remaining > 0 ){
    							echo "Penalty" . $remaining;
    							penaltyClear($connect, $check, $remaining);
    							break;
    						} else if($remaining <=0){
    							$remaining = (-1*$remaining);
    							penaltyClear($connect, $check, 0);
    							echo "clear" . $remaining;
    						}
    					}
    			}
    		echo '<script>alert("Enrollment Successful");</script>';
    		unset($_SESSION['studenttransac']);
    		header('Location: viewstudent.php?id='.$_GET['id']);
    		//header('Location: viewStudent.php?id='.$_SESSION['studentfee']);
    		}
		}
	}

?>
<!--================================ crap ^ ================================!-->

<!--================================ title lang ng tab ng student na nakaopen ================================!-->
<head>
	<title><?php echo $viewStudent['first_name'] . " " . $viewStudent['last_name'];?></title>
			  <link href="asd/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/init.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<!--================================ crap ^ ================================!-->






<!--================================ crap ^ ================================!-->


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
<!--================================ crap ^ ================================!-->







<!--================================ crap ^ ================================!-->
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
<!--================================ crap ^ ================================!-->


<!--================================ student info ================================!-->

<div style="margin-left:290px;px;margin-right:50px;margin-top:-180px;">

<form method="POST">
<!--================================ some buttons ================================!-->

<button class="btn waves-effect waves-light green" type="submit" name="delete" value="Delete Student" style="position: relative;top:150px;left: 700px;" onclick="return confirm('Are you sure?');" >Delete Student</button></br>
<button class="btn waves-effect waves-light green" type="submit" name="reenrol" value="Re-enroll Student" style="position: relative;top:160px; left: 700px;"  >Re-enroll Student</button></br>
<button class="btn waves-effect waves-light green" type="submit" name="edit" value="Edit" style="position: relative;top:170px; left: 700px;"  >Edit Student</button></br>
		

	<img class="backup_picture" src="uploads/<?=$_GET['id']?>" alt="Student Image" height="150" width="150" style="float:left;">
	
	<div style="padding-top:18px;">
	<label style="position: static;float:left;padding-left:20px;">First Name:</label>
	<label style="position: static;float:left;padding-left:2px;"><?=$viewStudent['first_name']?></label>
	<label style="position: static;float:left;padding-left:14px;">Last Name:</label>
	<label style="position: static;float:left;padding-left:2px;"><?=$viewStudent['last_name']?></label>
	<label style="position: static;float:left;padding-left:14px;">Middle Name:</label>
	<label style="position: static;float:left;padding-left:2px;"><?=$viewStudent['middle_name']?></label></br>
	<label style="position: static;float:left;padding-left:20px;">Age:</label>
	<label style="position: static;float:left;padding-left:2px;"><?=$viewStudent['age']?></label>
	<label style="position: static;float:left;padding-left:14px;">Grade:</label>
	<label style="position: static;float:left;padding-left:2px;"><?=$viewStudent['grade']?></label></br>
	<label style="position: static;float:left;padding-left:20px;">From:</label>
	<label style="position: static;float:left;padding-left:2px;"><?=$viewStudent['fromTime']?></label>
	<label style="position: static;float:left;padding-left:14px;">To:</label>
	<label style="position: static;float:left;padding-left:2px;"><?=$viewStudent['toTime']?></label><br>
	<label style="position: static;float:left;padding-left:20px;">Academic Status:</label>
	<label style="position: static;float:left;padding-left:2px;"><?=$viewStudent['academicstatus']?></label></br>
	<label style="position: static;float:left;padding-left:20px;">Payment Mode:</label>
	<label style="position: static;float:left;padding-left:2px;"><?=$viewStudent['paymentmode']?></label></br>
	
	</div>






<!--================================ table ng mga bayarin ================================!-->	
</br></br><br>
<div>

<table name="first_name" border="1";>
<thead>
			<tr style="font-size: 14px;font-weight:bold;" class="blue-text text lighten-2"><td>Item</td>
			<td>Balance</td>
			<td>Due Date</td>
			<td>Penalty</td>
			<td>Penalty Count</td></tr>
		</thead>
		
	

<?php
	$table=getStudentBalance($connect, $_GET['id']);	
	while($row=mysqli_fetch_assoc($table)){
?>
		<tr class="editBalance" href="editbalan.php?id=<?=$row['id']?>">
			<td><?=$row['item']?></td>
			<td><?=$row['balance']?></td>
			<td><?=$row['due_date']?></td>
			<td><?=$row['penalty_balance']?></td>
			<td><?=$row['penalty_count']?></td>
			<td><?php if($row['waive']==0) echo ""; else echo "Waived";?></td>
			

		</tr>	
<?php	
	}
?>

	</table>
	</div>
<!--================================ table ng mga bayarin ================================!-->
<br>



<a style="float:left;" class="btn waves-effect waves-light green" type="button" onclick="frames['frame'].print()" value="Print Accounts">Print Accounts</a>&nbsp&nbsp&nbsp&nbsp


<a class="waves-effect waves-light btn modal-trigger green" href="#modal3" style="float:center;">Make Payment</a>


  <div id="modal3" class="modal">
    <div class="modal-content">
		<form method="POST">
			<label><?=$viewStudent['first_name']?> </label><label><?=$viewStudent['last_name']?></label></br>

	<table>
	<thead>
		<tr>
			<td>Item</td>
			<td>Balance</td>
			<td>Due Date</td>
			<td>Penalty</td>
		</tr>
	</thead>

<?php	
	$table=getStudentBalancePayment($connect, $_GET['id']);
	while($row=mysqli_fetch_assoc($table)){
?>
<tr>
		<td><input type="checkbox"  name="check_list[]" value="<?=$row['id']?>" id="<?=$row['item']?>"/>
		  <label for="<?=$row['item']?>"><?=$row['item']?></label></td>
		  
			
		<td><?=$row['balance']?></td>
			<td><?=$row['due_date']?></td>
			<td><?=$row['penalty_balance']?></td>
			</tr>
		
<?php	
	}
?>
	
<tr>
	<td><input type="number" min="0" placeholder="Enter Amount" name="amount" pattern="[0-9]+([.][0-9]+)?"/></td>
	<td><input type="number" min="0" placeholder="AR Number" name="arnumber" value="<?=$getARNumber['ar']+1?>" pattern="[0-9]+" required/></td>
	<td><input type="text" placeholder="D.R." name="dr"/></td>
	<td><input type="text" placeholder="C.R." name="cr"/></td>
	<td><input type="text" placeholder="Remarks" name="remark"/></td><br></tr><tr>
	<td><button class="btn waves-effect waves-light green" type="submit" name="456" value="Make Payment" >Make Payment</button></td>
<td>	<button class="btn waves-effect waves-light green" type="submit" name="cancel" value="Cancel" onclick="location.href = 'viewstudent.php?id=<?=$_SESSION['studentfee']?>';">Cancel</button></td></tr></table>
</form>
</div>
    </div>


		

<!--================================ total receivables ng mga bayarin ================================!-->
<div class="divider"></div>
<div>
	<p style="font-weight:bold">	Total Receivables This Month:</p> <?php if($viewTotalBalance['total']==null) echo "None"; else echo $viewTotalBalance['total'];?>

</div><br>
<div class="divider"></div>
<!--================================ additional info table ================================!-->

<table>
<tr>
<td><p style="font-size: 14px;font-weight:bold;" class="blue-text text lighten-2">Grade Level</p></td>
<td><p style="font-size: 14px;font-weight:bold;" class="blue-text text lighten-2">Quarter</p></td>
<td><p style="font-size: 14px;font-weight:bold;" class="blue-text text lighten-2">Average</p></td></tr>
		
	

<?php
	$table=getAcademicStatus($connect, $_GET['id']);	
	while($row=mysqli_fetch_assoc($table)){
?>
		<tr class='editRowAS' href="editacademicstatus.php?id=<?=$row['id']?>">
			<td><?=$row['grade_level']?></td>
			<td> <?=$row['quarter']?></td>
			<td><?=$row['average']?></td>
		</tr>	
<?php	
	}
?>	
				
</table><br>
			<div class="divider"></div>
			<br>
  <a class="waves-effect waves-light btn modal-trigger" href="#modal2">Add Data</a>

 
  <div id="modal2" class="modal">
    <div class="modal-content">
     <form method="POST">
	<label>Grade Level</label><input type="text" name="grade_level" pattern="[0-9]+"/></br>
	<label>Quarter</label><input type="text" name="quarter" pattern="[A-Za-z0-9]+"/></br>
	<label>Average</label><input type="text" name="average" pattern="[0-9]+"/></br>

	<button class="btn waves-effect waves-light green" type="submit" name="dsa" value="Save">Save</button>
	<button class="btn waves-effect waves-light green" type="submit" name="return" value="Cancel">Cancel</button>
</form>
    </div>
  </div>
<br>
			<div class="divider"></div>
			

<!--================================ additional info table ================================!-->

<!--================================ more additional info table ================================!-->

<div>
<table>
	<tr>
		<td><p style="font-size: 14px;font-weight:bold;" class="blue-text text lighten-2">	Date</p></td>
		<td><p style="font-size: 14px;font-weight:bold;" class="blue-text text lighten-2">	Sent To</p></td>
		<td><p style="font-size: 14px;font-weight:bold;" class="blue-text text lighten-2">	Reason</p></td>
	

<?php
	$table=getOtherRecords($connect, $_GET['id']);	
	while($row=mysqli_fetch_assoc($table)){
?>
		<tr class='editRowOR' href="editotherrecords.php?id=<?=$row['id']?>">
			<td><?=$row['date']?></td>
			<td><?=$row['sent_to']?></td>
			<td><?=$row['reason']?></td>
		</tr>	
<?php	
	}

?>	



		</table><br>
			<div class="divider"></div><br>
  <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Add data</a>
  <div id="modal1" class="modal">
    <div class="modal-content">
      <form method="POST">
	<label>Date</label><input type="date" name="grade_level"/></br>
	<label>Sent To</label><input type="text" name="quarter" pattern="[A-Za-z0-9]+"/></br>
	<label>Reason</label><input type="text" name="average" pattern="[A-Za-z0-9]+"/></br>

	<button class="btn waves-effect waves-light green" type="submit" name="asd" value="Save">Save</button>
	<button class="btn waves-effect waves-light green" type="submit" name="return" value="Cancel">Cancel</button>
</form>

    </div>
  </div>
  </div>
  
	<div class="divider"></div>
<!--================================ more additional infor table ================================!-->



<!--================================ some buttons ================================!-->


</form>
<!--================================  crap V ================================!-->



<script src="jquery-2.1.3.min.js"></script>

</div>

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



<script src="http://www.gstatic.com/external_hosted/picturefill/picturefill.min.js"></script>
<script src="asd/js/materialize.js"></script>
<script src="asd/js/init.js"></script>
  
  