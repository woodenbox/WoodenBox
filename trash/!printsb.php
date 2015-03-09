<?php
		session_start();
	include('processes/process.php');
	$connect = connectDB();
	$mydate=getdate(date("U"));

	$checkStudent = viewStudentAccount($connect, $_GET['id']);
	$viewStudent = mysqli_fetch_assoc($checkStudent);

	$getFeeSchedule=getFeeSchedulePrint($connect, $viewStudent['grade'], $viewStudent['paymentmode']);
	$getAR=getARPrint($connect, $_GET['id']);
	
	$getSumTui=getSumTuitionPrint($connect, $viewStudent['grade'], $viewStudent['paymentmode']);
	$viewSumTui=mysqli_fetch_assoc($getSumTui);
	
	$getARTotal = getARTotalPrint($connect, $_GET['id']);
	$viewARTotal = mysqli_fetch_assoc($getARTotal);

	$getTotalBalance = getTotalBalancePrint($connect, $_GET['id']);
	$viewTotalBalance = mysqli_fetch_assoc($getTotalBalance);
?>

NOAH'S ARK ANGEL LEARNING & TUTORIAL CENTER INC 
<?php echo $mydate['month']." ".$mydate['year'];?></br>
2119-A Moreno Compound, Pedro Gil St., Sta. Ana, Manila Time: <?php echo $viewStudent['fromTime']."-".$viewStudent['toTime'];?></br>
STATEMENT OF ACCOUNT <?php echo $viewStudent['paymentmode'];?> LEVEL: <?=$viewStudent['grade'];?></br>
NAME OF STUDENT: <?php echo $viewStudent['first_name']." ".$viewStudent['middle_name']." ".$viewStudent['last_name'];?></br>

TOTAL FEE: 

<table>
	<?php while($row = mysqli_fetch_assoc($getFeeSchedule)){
?>	
		<tr>
			<td><?=$row['item']?></td>
			<td><?=$row['fee']?></td>
		</tr>		
<?php	}
?>
</table></br>
LESS: PAYMENT AR<?php while($row=mysqli_fetch_assoc($getAR)){ echo " ".$row['ar'];}?></br>  
<?php echo $viewSumTui['fee'];?></br>
<?php echo $viewARTotal['total'];?></br>
TOTAL BALANCE AS OF THIS MONTH <?php echo $viewSumTui['fee']-$viewARTotal['total']?></br>

COMPUTATION
<table>
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
			<rd><?php echo $row['balance']*0.5?></td>
			<td><?=$row['penalty_balance']?></td>
		</tr>		
<?php
}	
	$counter++;
	}
?>
	</table>
Total Collectible for this month ----- > <?=$viewTotalBalance['total']?></br>

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