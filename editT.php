<?php
	session_start();
	include('processes/process.php');
	$connect=connectDB();

	$getTime=mysqli_fetch_assoc(getTime($connect, $_GET['id']));

	if(isset($_POST['edit'])){
		extract($_POST);
			updateTime($connect,$_GET['id'], $time);
			header('Location: ..\option.php');
			}
			$header="Edit";
			$header2="Edit Time";
			include('header.php');
	?>
<head>
    <title>Edit Student</title>

</head>
<div style="position: relative;width: 80%;bottom: -2%; left: 16%;">

<form method="POST">
			Time<br>
			<input style="width:10%;" type="text" name="time" value="<?=$getTime['time']?>"/><br>
			<input type="submit" name="edit" value="Edit Record"/>		
</form>
<a href ="../option.php">Back</a>
</div>
