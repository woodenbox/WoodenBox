<?php
	include('../processes/process.php');
	$connect=connectDB();

	$getTime=mysqli_fetch_assoc(getTime($connect, $_GET['id']));

	if(isset($_POST['edit'])){
		extract($_POST);
			updateTime($connect,$_GET['id'], $time);
			header('Location: ..\option.php');
			}
	?>

<form method="POST">
			Time
			<input type="text" name="time" value="<?=$getTime['time']?>"/>
			<input type="submit" name="edit" value="Edit Record"/>		
</form>
<a href ="../option.php">Back</a>