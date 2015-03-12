<?php
	session_start();
	include('processes/process.php');
	$connect = connectDB();
	$mydate=getdate(date("U"));
	
	if(!isset($_GET['page'])){
		$_GET['page']=1;
	}

	$getSY=mysqli_fetch_assoc(getSY($connect));

	$getTotalCashFlow=mysqli_fetch_assoc(getTotalCashFlow($connect, $_GET['month'], $_GET['year']));
/*
	header("Content-type: application/doc");
	header("Content-Disposition: attachment;Filename=FamilyRecord.doc");
*/
?>
<head>
</head>
<a style="font-family: Vrinda;font-weight: bold; font-size:80%;">ACKNOWLEDGEMENT RECEIPT (SY <?=$getSY['from']."-".$getSY['to']?>)</a><br>
<a style="font-family: Vrinda;font-size:80%;">For the month of <?php echo $_GET['month']." ".$_GET['year'];?></a></br>


<table style="border: 1px; width: 100%;
text-align: center; font-family: Vrinda;">
	<thead style="border-spacing: 0px 0px;">
		<tr>
			<th>Date</th>
			<th>Student</th>
			<th>A.R. Number</th>
			<th>Cash</th>
<!--			<th>DR.</th>
			<th>CR.</th>!-->
			<th>Tuition Fees</th>
			<th>Remarks</th>
		</tr>
	</thead>


<?php
	$getCashFlow = getCashFlow($connect, $_GET['month'], $_GET['year']);
		$x=1;
	while($row=mysqli_fetch_assoc($getCashFlow)){
?>
		<tr style="font-size: 80%;">
			<td><?=$row['month']." ".date('d', strtotime($row['payment_date'])).", ".$row['year']?></td>
			<td><?=$row['first_name']." ".$row['last_name']?></td>
			<td><?=$row['ar']?></td>
			<td><?=$row['cash']?></td>
<!--			<td><?php//$row['dr']?></td>
			<td><?php//$row['cr']?></td>!-->
			<td><?=$row['tuition']?></td>
			<td><?=$row['remark']?></td>
		</tr>	
<?php
	if($x==21){
		echo "<tr>
			<td></br></td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
		</tr>";
		$x=1;	
	}	
	$x++;
	}
?>
<tr>
			<td></td>
			<td></td>
			<td>Total Cash Recieved</td>
			<td><?=$getTotalCashFlow['cash']?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
</table>

<script src="jquery-2.1.3.min.js"></script>
<script>

	$(function(){

		$(document).ready(function () {
    window.print();
	});
	});

</script>