<?php
	session_start();
	include('header.php');
	include('processes/process.php');
	$connect = connectDB();

	$getAcademicStat = mysqli_fetch_assoc(getAcademicStat($connect, $_GET['id']));

	if(isset($_POST['submit'])){
		extract($_POST);
		updateAcademicStatus($connect, $_GET['id'], $grade_level, $quarter, $average);
		header('Location: viewstudent.php?id='.$_SESSION['studentfee']);
	}

	if(isset($_POST['delete'])){
		deleteAcademicStatus($connect, $_GET['id']);
		header('Location: viewstudent.php?id='.$_SESSION['studentfee']);
	}

	if(isset($_POST['return'])){
		header('Location: viewstudent.php?id='.$_SESSION['studentfee']);
	}
?>

<form method="POST">
	<label>Grade Level</label><input type="text" name="grade_level" value="<?=$getAcademicStat['grade_level']?>" pattern="[0-9]+"/></br>
	<label>Quarter</label><input type="text" name="quarter" value="<?=$getAcademicStat['quarter']?>" pattern="[A-Za-z0-9]+"/></br>
	<label>Average</label><input type="text" name="average" value="<?=$getAcademicStat['average']?>" pattern="[0-9]+"/></br>

	<input type="submit" name="submit" value="Save"></br>
	<input type="submit" name="delete" value="Delete"></br>
	<input type="submit" name="return" value="Cancel">
</form>



<?php
	include('footer.php');
?>