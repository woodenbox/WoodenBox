<?php
	include('../processes/process.php');
	$connect=connectDB();
	$editTuitionFee=mysqli_fetch_assoc(editTuitionFee($connect, $_GET['id']));

	if(isset($_POST['submit'])){
		extract($_POST);
			updateTuitioFee($connect,$_GET['id'], $tuition_fee, $due_date);
			header('Location: ../option.php');
			}
	?>

<form method="POST">
			<?=$editTuitionFee['grade']?>
			<br/>
			<?=$editTuitionFee['fee_type']?>
			<br/>
			<?=$editTuitionFee['item']?>
			<br/>
			<input type="number" name="tuition_fee"  pattern="[0-9]+([.][0-9]+)?" step="0.01" required value="<?=$editTuitionFee['fee']?>"/>
			<br/>
			<input type="date" name="due_date" value="<?=$editTuitionFee['due_date']?>"/>
			<input type="submit" name="submit" value="Save"/>

</form>
<a href ="../option.php">Back</a>