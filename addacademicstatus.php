<?php
	session_start();
	include('header.php');
	include('processes/process.php');
	$connect = connectDB();

	if(isset($_POST['submit'])){
		extract($_POST);
		insertAcademicStatus($connect, $_GET['id'], $grade_level, $quarter, $average);
		header('Location: viewstudent.php?id='.$_GET['id']);
	}

	if(isset($_POST['return'])){
		header('Location: viewstudent.php?id='.$_GET['id']);
	}
?>

<form method="POST">
	<label>Grade Level</label><input type="text" name="grade_level" pattern="[0-9]+"/></br>
	<label>Quarter</label><input type="text" name="quarter" pattern="[A-Za-z0-9]+"/></br>
	<label>Average</label><input type="text" name="average" pattern="[0-9]+"/></br>

	<input type="submit" name="submit" value="Save"></br>
	<input type="submit" name="return" value="Cancel">
</form>



<?php
	include('footer.php');
?>