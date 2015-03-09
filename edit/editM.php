<?php
	include('../processes/process.php');
	$connect=connectDB();

	$getMode=mysqli_fetch_assoc(getMode($connect, $_GET['id']));

	if(isset($_POST['edit'])){
		extract($_POST);
			updateMode($connect,$_GET['id'], $mode);
			}
	?>

<form method="POST">
			Time
			<input type="text" name="mode" value="<?=$getMode['mode']?>"/>
			<input type="submit" name="edit" value="Edit Record"/>		
</form>
<a href ="../option.php">Back</a>