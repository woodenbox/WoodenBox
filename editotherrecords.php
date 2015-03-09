<?php
	session_start();
	include('header.php');
	include('processes/process.php');
	$connect = connectDB();

	$getOtherRecord = mysqli_fetch_assoc(getOtherRecord($connect, $_GET['id']));

	if(isset($_POST['submit'])){
		extract($_POST);
		updateOtherRecords($connect, $_GET['id'], $grade_level, $quarter, $average);
		header('Location: viewstudent.php?id='.$_SESSION['studentfee']);
	}

	if(isset($_POST['delete'])){
		deleteOtherRecords($connect, $_GET['id']);
		header('Location: viewstudent.php?id='.$_SESSION['studentfee']);
	}

	if(isset($_POST['return'])){
		header('Location: viewstudent.php?id='.$_SESSION['studentfee']);
	}
?>

<form method="POST">
	<label>Date</label><input type="date" name="grade_level" value="<?=$getOtherRecord['date']?>"/></br>
	<label>Sent To</label><input type="text" name="quarter" value="<?=$getOtherRecord['sent_to']?>" pattern="[A-Za-z0-9 ]+"/></br>
	<label>Reason</label><input type="text" name="average" value="<?=$getOtherRecord['reason']?>" pattern="[A-Za-z0-9 ]+"/></br>

	<input type="submit" name="submit" value="Save"></br>
	<input type="submit" name="delete" value="Delete"></br>
	<input type="submit" name="return" value="Cancel">
</form>



<?php
	include('footer.php');
?>