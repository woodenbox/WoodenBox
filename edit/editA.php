<?php
	include('../processes/process.php');
	$connect=connectDB();

	$getStatus=mysqli_fetch_assoc(getStatus($connect, $_GET['id']));

	if(isset($_POST['edit'])){
		extract($_POST);
			updateStatus($connect,$_GET['id'], $status);
			}
			
	?>

<form method="POST">
			Time
			<input type="text" name="mode" value="<?=$getStatus['status']?>"/>
			<input type="submit" name="edit" value="Edit Record"/>		
</form>
<a href ="../option.php">Back</a>