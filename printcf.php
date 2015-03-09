<?php
	session_start();
	include('processes/process.php');
	$connect = connectDB();
	$mydate=getdate(date("U"));
	
	if(!isset($_GET['page'])){
		$_GET['page']=1;
	}

?>
<head>
<link rel="stylesheet" type="text/css" href="spacing.css">
</head>
ACKNOWLEDGEMENT RECEIPT(SY)</br>
FOR THE MONTH OF <?php echo $mydate['month']." ".$mydate['year'];?></br>


<table class="spacing">
	<thead>
		<tr>
			<th class="style">Date</th>
			<th class="style">Student</th>
			<th class="style">A.R. Number</th>
			<th class="style">Cash</th>
			<th class="style">DR.</th>
			<th class="style">CR.</th>
			<th class="style">Tuition Fees</th>
			<th class="style">Remarks</th>
		</tr>
	</thead>


<?php
	$getCashFlow = getCashFlow($connect, $_GET['month'], $_GET['year']);
	while($row=mysqli_fetch_assoc($getCashFlow)){
?>
		<tr>
			<td class="spacing2"><?=$row['month']." ".date('d', strtotime($row['payment_date']))." ".$row['year']?></td>
			<td class="spacing2"><?=$row['first_name']." ".$row['last_name']?></td>
			<td><?=$row['ar']?></td>
			<td><?=$row['cash']?></td>
			<td><?=$row['dr']?></td>
			<td><?=$row['cr']?></td>
			<td><?=$row['tuition']?></td>
			<td><?=$row['remark']?></td>
		</tr>	
<?php	
	}
?>
</table>

<script src="jquery-2.1.3.min.js"></script>
<script>

	$(function(){

		$(document).ready(function () {
    window.print();
	});
	});

</script>