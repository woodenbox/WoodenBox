<?php
	session_start();
	include('processes/process.php');
	$connect=connectDB();
	$editTuitionFee=mysqli_fetch_assoc(editTuitionFee($connect, $_GET['id']));

	if(isset($_POST['submit'])){
		extract($_POST);
			updateTuitioFee($connect,$_GET['id'], $tuition_fee, $due_date);
			header('Location: option.php');
			}
			$header="Edit";
			$header2="Edit Grade";
	include('header.php');
	?>
<head>
    <title>Edit Student</title>
	
</head>
<div style="position: relative;width: 80%;bottom: -2%; left: 16%;">
<form method="POST">
			<?=$editTuitionFee['grade']?>
			<br/>
			<?=$editTuitionFee['fee_type']?>
			<br/>
			<?=$editTuitionFee['item']?>
			<br/>

			<input style="width: 10%;" type="number" name="tuition_fee"  pattern="[0-9]+([.][0-9]+)?" step="0.01" required value="<?=$editTuitionFee['fee']?>"/>
			<br/>
			<input style="width: 10%;" type="date" name="due_date" value="<?=$editTuitionFee['due_date']?>"/><br>
			<button class="btn waves-effect waves-light blue lighten-2 white-text" type="submit" name="submit" value="Save"/>Save</button>

</form>
	<button class="btn waves-effect waves-light blue lighten-2 white-text" href="option.php">Back</a>
</div>