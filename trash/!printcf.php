<?php
	session_start();
	include('processes/process.php');
	$connect = connectDB();

	if(!isset($_GET['page'])){
		$_GET['page']=1;
	}

?>

<table>
	<thead>
		<tr>
			<th>Date</th>
			<th>Student</th>
			<th>A.R. Number</th>
			<th>Cash</th>
			<th>DR.</th>
			<th>CR.</th>
			<th>Tuition Fees</th>
			<th>Remarks</th>
		</tr>
	</thead>

<?php
	$getCashFlow = getCashFlow($connect, $_GET['month'], $_GET['year']);
	while($row=mysqli_fetch_assoc($getCashFlow)){
?>
		<tr>
			<td><?=$row['month']." ".date('d', strtotime($row['payment_date']))." ".$row['year']?></td>
			<td><?=$row['first_name']." ".$row['last_name']?></td>
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