<?php
		session_start();
	include('processes/process.php');
	$connect = connectDB();
	$mydate=getdate(date("U"));

	$checkStudent = viewStudentAccount($connect, $_GET['id']);
	$viewStudent = mysqli_fetch_assoc($checkStudent);

	$getFeeSchedule=getFeeSchedulePrint($connect, $viewStudent['grade'], $viewStudent['paymentmode']);
	$getAR=getARPrint($connect, $_GET['id']);
	
	$getSumTui=getSumTuitionPrint($connect, $_GET['id']);
	$viewSumTui=mysqli_fetch_assoc($getSumTui);
	
	$getARTotal = getARTotalPrint($connect, $_GET['id']);
	$viewARTotal = mysqli_fetch_assoc($getARTotal);

	$getTotalBalance = getTotalBalancePrint($connect, $_GET['id']);
	$viewTotalBalance = mysqli_fetch_assoc($getTotalBalance);
?>
<head>
<link rel="stylesheet" type="text/css" href="spacing.css">
</head>

<p><strong>NOAH'S ARK ANGEL LEARNING & TUTORIAL CENTER INC <span id="moving"><?php echo $mydate['month']." ".$mydate['year'];?></span> </strong></p>

<p>2119-A Moreno Compound, Pedro Gil St., Sta. Ana, Manila <span id="moving">Time:<?php echo  $viewStudent['fromTime']."".$viewStudent['toTime'];?></span></p>

<strong>STATEMENT OF ACCOUNT<span id ="moving2">LEVEL: <?=$viewStudent['grade'];?></span><span style="margin-left: 20px;"><?php echo $viewStudent['paymentmode'];?></span> </br>
NAME OF STUDENT: <span style="margin-left: 20px;"><?php echo $viewStudent['first_name']." ".$viewStudent['middle_name']." ".$viewStudent['last_name'];?> <span></strong></br>

<br>
<p><strong>TOTAL FEE:</strong></p>


<?php while($row = mysqli_fetch_assoc($getFeeSchedule)){
?>	


<table style="margin-left: 100px; width: 100%;">
	<tr>
		<td style="width: 100px;"><?=$row['item']?></td>
		<td style="margin-left: 120px; width: 100px;"><?=$row['fee']?></td>
	</tr>
</table>

<?php	}
?>


<p style="margin-left: 100px;">LESS: PAYMENT AR<?php while($row=mysqli_fetch_assoc($getAR)){ echo " ".$row['ar'];}?>
<?php echo $viewSumTui['fee'];?>
<span style="margin-left: 200px;">
<?php echo $viewARTotal['total'];?>
</p>
</span>

<p style="margin-left: 100px;">TOTAL BALANCE AS OF THIS MONTH</p>
<p style="margin-left: 485px;"> <?php echo $viewSumTui['fee']?></p>

<br>
<br>
<p><strong>COMPUTATION</strong></p>
<table style="margin-left: 100px; width:450px;">
<?php
	$counter=1;
	$table=getStudentBalancePrint($connect, $_GET['id']);	
	while($row=mysqli_fetch_assoc($table)){
?>		
		<tr>
			<td><?=$counter?></td>
			<td><?php echo $row['item'];?></td>
			<td></td>
			<td></td>
			<td><?=$row['balance']?></td>
		</tr>
		<?php if($row['penalty_balance'] > 0){?>
		<tr>
			<td></td>
			<td>ADD: 5% Penalty Charges</td>
			<td><?=$row['penalty_count']?></td>
			<rd><?php //echo $row['balance']*0.5?></td>
			<td><?=$row['penalty_balance']?></td>
		</tr>		
<?php
}	
	$counter++;
	}
?>
	</table>
<p style="margin-left: 450px;">_____________</p>
<p style="margin-left: 100px;"><strong>Total Collectible for this month ------------ </strong> </p>
<p style="margin-left: 490;"><strong><?=$viewTotalBalance['total']?><strong></p>

<p style="text-align: center;">NOTE: PLEASE UPDATE YOUR UNPAID TUITION FEE ON OR BEFORE 2ND QUARTER EXAMINATION ON </p>
<p style="text-align: center">OCTOBER 27-39, 2015</p>

<br>
<br>

<p>Certified true and correct <span style="float:right; width: 150;">RECIEVED BY:</span></p>
<br>
<h3>GLORIA S. CAUMERON <span style="float:right;">____________________</span></h3>



	<script src="jquery-2.1.3.min.js"></script>
<script>

/*	$(function(){

		$(document).ready(function () {
    window.print();
    document.location.href = "viewstudent.php?id=<?=$_GET['id']?>"; 
	});
	});
*/
</script>