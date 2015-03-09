<?php
	include('../processes/process.php');
	$connect=connectDB();
	$getGrade=mysqli_fetch_assoc(getGrade($connect, $_GET['id']));

	if(isset($_POST['b'])){
		extract($_POST);
			updateMode($connect,$_GET['id'], $mode);
			}
	?>

<form method="POST">
			Time
			<input type="text" name="mode" value="<?=$getGrades['grade']?>"/>
			<input type="submit" name="b" value="Edit Record"/>		
</form>
<a href ="../option.php">Back</a>