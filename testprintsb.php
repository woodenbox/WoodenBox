<?php
	session_start();
	include('processes/process.php');
	$connect = connectDB();
	$mydate=getdate(date("U"));
if(!isset($_SESSION['check_list'])){
			$peempty=sortStudents($connect, $_SESSION['ggg']);
		while($rowe=mysqli_fetch_assoc($peempty)){	
        $checkStudent = viewStudentAccount($connect, $rowe['student_id']);
		$viewStudent = mysqli_fetch_assoc($checkStudent);
		$getFeeSchedule=getFeeSchedulePrint($connect, $viewStudent['paymentmode'], $viewStudent['grade']);
		$getOrigi=mysqli_fetch_assoc(getTotalOrig($connect, $rowe['student_id']));
		$getAR=getARPrint($connect, $rowe['student_id']);
		$getSumTui=getSumTuitionPrint($connect, $rowe['student_id']);
		$viewSumTui=mysqli_fetch_assoc($getSumTui);
		$getMonthlyFee=mysqli_fetch_assoc(getMonthlyFee($connect, $rowe['student_id']));
		$getMonths=getMonths($connect,$rowe['student_id']);
		$getARTotal = getARTotalPrint($connect, $rowe['student_id']);
		$viewARTotal = mysqli_fetch_assoc($getARTotal);
		$getTotalBalance = getTotalBalancePrint($connect, $rowe['student_id']);
		$viewTotalBalance = mysqli_fetch_assoc($getTotalBalance);
?>
<div style="transform: scale(.89); transform-origin: 0% 0%;">
<div style="float:left;">
<img src="logo.png" alt="logo" style="height:60px; width:70px">
</div>
<a style="font-family: Vrinda;"><strong>NOAH'S ARK ANGEL LEARNING & TUTORIAL CENTER INC</strong> <br>
<a style="font-family: Vrinda;">589-2645/0935-1207644</a></a><br>
<a style="font-family: Vrinda; font-size: 13;">2119-A Moreno Compound, Pedro Gil St., Sta. Ana, Manila 
<a  style="margin-left: 100px; font-family: Vrinda;"><?php echo $mydate['month']." ".$mydate['year'];?></a></a><br>

<a style="font-family: Vrinda;"><strong>STATEMENT OF ACCOUNT</strong>
<a style="margin-left: 105px; font-family: Vrinda;"><?php echo $viewStudent['paymentmode'];?>
<a style="margin-left: 75px; font-family: Vrinda;">Time:<?php echo  $viewStudent['fromTime']." - ".$viewStudent['toTime'];?></a></a></a><br>

<a style="font-family: Vrinda;"><strong>NAME OF STUDENT: <a style="margin-left: 30px;font-family: Vrinda;"><?php echo $viewStudent['first_name']." ".$viewStudent['middle_name']." ".$viewStudent['last_name'];?>
<a style="margin-left: 160px; font-family: Vrinda;">LEVEL:  <?=$viewStudent['grade'];?></strong></a></a></a>
<br>
<br>


<a style="font-family: Vrinda;"><strong>TOTAL FEE:</strong></a><br>

<?php if($viewStudent['paymentmode']=='Monthly') { 
		while($row = mysqli_fetch_assoc($getFeeSchedule)){
			if($row['item']!='Monthly Fee'){ 
?>
				<a style="margin-left: 100px; font-family: Vrinda;"><?=$row['item']?>
				<a style="float: right; margin-right: 170px; font-family: Vrinda;"><?=$row['fee']?></a></a><br>
<?php 		} else { ?>
				<a style="margin-left: 100px; font-family: Vrinda;"><?=$row['item']?>
				<a style="float: right; margin-right: 170px; font-family: Vrinda;"><?=$row['fee']*10?></a></a><br>
<?php }
		} 
	} else {
		while($row = mysqli_fetch_assoc($getFeeSchedule)){ ?>	
			<a style="margin-left: 100px; font-family: Vrinda;"><?=$row['item']?>
			<a style="float: right; margin-right: 170px; font-family: Vrinda;"><?=$row['fee']?></a></a><br>
<?php 	}
	}
?>


<a style="margin-left: 440px; font-family: Vrinda;"><?php echo $getOrigi['origi'];?></a><br>

<a style="margin-left: 100px; font-family: Vrinda;">LESS: PAYMENT <span style="font-size:8;" >AR</span></a>
<a  style="font-size:8;"><?php while($row=mysqli_fetch_assoc($getAR)){ echo " ".$row['ar'];}?></a>

<a style="margin-left: 209px; font-family: Vrinda;"><?php echo $viewARTotal['total'];?></a><br>


<a style="margin-left: 100px; font-family: Vrinda;">TOTAL BALANCE AS OF THIS MONTH</a>
<a  style="margin-left: 75px; font-family: Vrinda;"> <?php echo $viewSumTui['fee']?></a><br>


<a style="font-family: Vrinda;"><strong>COMPUTATION</strong></a>

<?php
	$counter=1;
	$table=getStudentBalancePrint($connect, $rowe['student_id']);	
	while($row=mysqli_fetch_assoc($table)){
?>		
		<br>
			<a style="margin-left: 100px; font-family: Vrinda;"><?=$counter?></a>
			<a style="font-family: Vrinda;"><strong><?php echo $row['item'];?></strong></a>
			<a style="float: right; margin-right: 130px; font-family: Vrinda;"><strong><?=$row['balance']?></strong></a>
	
		<?php if($row['penalty_balance'] > 0){?>
			<br>
			<a style="margin-left: 100px; font-family: Vrinda;">ADD: 5% Penalty Charges</a>
			<a style="float: center; margin-left: 100px; font-family: Vrinda;"><?=$row['penalty_count']?></a>
			<a style="float: right; margin-right: 125px; font-family: Vrinda;"><?=$row['penalty_balance']?></a>
		</a>		
<?php
}	
	$counter++;
	}
	?>
	<br>
<a style="margin-left: 98px; font-family: Vrinda;"><strong>TOTAL COLLECTIBLE FOR THIS MONTH</strong>
<a style="float: right; margin-right: 130px; font-family: Vrinda;"><strong><?=$viewTotalBalance['total']?></strong></a><br><br>


<a style="font-family: Vrinda; margin-left: 100px;">DUE DATE: TO BE PAID ON OR BEFORE 30th DAY OF THE MONTH</a><br>
<a style="text-align: center; font-family: Vrinda;">NOTE: Agreed additional 5% penalty charges added for non settlement of account</a><br>
<a style="font-family: Vrinda;">Certified true and correct <a style="float:right; width: 150;  font-family: Vrinda;">RECIEVED BY:</a></a><br>
<br>
<a style="font-family: Vrinda;">GLORIA S. CAUMERON <a style="float:right;">____________________</a></a>

</div>
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
<?php 
	} 
}
	else {
	foreach ($_SESSION['check_list'] as $key => $value){
        $checkStudent = viewStudentAccount($connect, $value);
		$viewStudent = mysqli_fetch_assoc($checkStudent);
		$getFeeSchedule=getFeeSchedulePrint($connect, $viewStudent['paymentmode'], $viewStudent['grade']);
		$getOrigi=mysqli_fetch_assoc(getTotalOrig($connect, $value));
		$getAR=getARPrint($connect, $value);
		$getSumTui=getSumTuitionPrint($connect, $value);
		$viewSumTui=mysqli_fetch_assoc($getSumTui);
		$getMonthlyFee=mysqli_fetch_assoc(getMonthlyFee($connect, $value));
		$getMonths=getMonths($connect, $value);
		$getARTotal = getARTotalPrint($connect, $value);
		$viewARTotal = mysqli_fetch_assoc($getARTotal);
		$getTotalBalance = getTotalBalancePrint($connect, $value);
		$viewTotalBalance = mysqli_fetch_assoc($getTotalBalance);
?>
<div style="transform: scale(.89); transform-origin: 0% 0%;">
<div style="float:left;">
<img src="logo.png" alt="logo" style="height:60px; width:70px">
</div>
<a style="font-family: Vrinda;"><strong>NOAH'S ARK ANGEL LEARNING & TUTORIAL CENTER INC</strong> <br>
<a style="font-family: Vrinda;">589-2645/0935-1207644</a></a><br>
<a style="font-family: Vrinda; font-size: 13;">2119-A Moreno Compound, Pedro Gil St., Sta. Ana, Manila 
<a  style="margin-left: 100px; font-family: Vrinda;"><?php echo $mydate['month']." ".$mydate['year'];?></a></a><br>

<a style="font-family: Vrinda;"><strong>STATEMENT OF ACCOUNT</strong>
<a style="margin-left: 105px; font-family: Vrinda;"><?php echo $viewStudent['paymentmode'];?>
<a style="margin-left: 75px; font-family: Vrinda;">Time:<?php echo  $viewStudent['fromTime']." - ".$viewStudent['toTime'];?></a></a></a><br>

<a style="font-family: Vrinda;"><strong>NAME OF STUDENT: <a style="margin-left: 30px;font-family: Vrinda;"><?php echo $viewStudent['first_name']." ".$viewStudent['middle_name']." ".$viewStudent['last_name'];?>
<a style="margin-left: 160px; font-family: Vrinda;">LEVEL:  <?=$viewStudent['grade'];?></strong></a></a></a>
<br>
<br>


<a style="font-family: Vrinda;"><strong>TOTAL FEE:</strong></a><br>

<?php if($viewStudent['paymentmode']=='Monthly') { 
		while($row = mysqli_fetch_assoc($getFeeSchedule)){
			if($row['item']!='Monthly Fee'){ 
?>
				<a style="margin-left: 100px; font-family: Vrinda;"><?=$row['item']?>
				<a style="float: right; margin-right: 170px; font-family: Vrinda;"><?=$row['fee']?></a></a><br>
<?php 		} else { ?>
				<a style="margin-left: 100px; font-family: Vrinda;"><?=$row['item']?>
				<a style="float: right; margin-right: 170px; font-family: Vrinda;"><?=$row['fee']*10?></a></a><br>
<?php }
		} 
	} else {
		while($row = mysqli_fetch_assoc($getFeeSchedule)){ ?>	
			<a style="margin-left: 100px; font-family: Vrinda;"><?=$row['item']?>
			<a style="float: right; margin-right: 170px; font-family: Vrinda;"><?=$row['fee']?></a></a><br>
<?php 	}
	}
?>


<a style="margin-left: 440px; font-family: Vrinda;"><?php echo $getOrigi['origi'];?></a><br>

<a style="margin-left: 100px; font-family: Vrinda;">LESS: PAYMENT <span style="font-size:8;" >AR</span></a>
<a  style="font-size:8;"><?php while($row=mysqli_fetch_assoc($getAR)){ echo " ".$row['ar'];}?></a>

<a style="margin-left: 209px; font-family: Vrinda;"><?php echo $viewARTotal['total'];?></a><br>


<a style="margin-left: 100px; font-family: Vrinda;">TOTAL BALANCE AS OF THIS MONTH</a>
<a  style="margin-left: 75px; font-family: Vrinda;"> <?php echo $viewSumTui['fee']?></a><br>


<a style="font-family: Vrinda;"><strong>COMPUTATION</strong></a>

<?php
	$counter=1;
	$table=getStudentBalancePrint($connect, $value);	
	while($row=mysqli_fetch_assoc($table)){
?>		
		<br>
			<a style="margin-left: 100px; font-family: Vrinda;"><?=$counter?></a>
			<a style="font-family: Vrinda;"><strong><?php echo $row['item'];?></strong></a>
			<a style="float: right; margin-right: 130px; font-family: Vrinda;"><strong><?=$row['balance']?></strong></a>
	
		<?php if($row['penalty_balance'] > 0){?>
			<br>
			<a style="margin-left: 100px; font-family: Vrinda;">ADD: 5% Penalty Charges</a>
			<a style="float: center; margin-left: 100px; font-family: Vrinda;"><?=$row['penalty_count']?></a>
			<a style="float: right; margin-right: 125px; font-family: Vrinda;"><?=$row['penalty_balance']?></a>
		</a>		
<?php
}	
	$counter++;
	}
	?>
	<br>
<a style="margin-left: 98px; font-family: Vrinda;"><strong>TOTAL COLLECTIBLE FOR THIS MONTH</strong>
<a style="float: right; margin-right: 130px; font-family: Vrinda;"><strong><?=$viewTotalBalance['total']?></strong></a><br><br>


<a style="font-family: Vrinda; margin-left: 100px;">DUE DATE: TO BE PAID ON OR BEFORE 30th DAY OF THE MONTH</a><br>
<a style="text-align: center; font-family: Vrinda;">NOTE: Agreed additional 5% penalty charges added for non settlement of account</a><br>
<a style="font-family: Vrinda;">Certified true and correct <a style="float:right; width: 150;  font-family: Vrinda;">RECIEVED BY:</a></a><br>
<br>
<a style="font-family: Vrinda;">GLORIA S. CAUMERON <a style="float:right;">____________________</a></a>

</div>
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
<?php 
	} 
	unset($_SESSION['check_list']);
}
?>  