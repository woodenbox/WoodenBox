<?php
	include('processes/process.php');
	$connect=connectDB();

	$getMode=mysqli_fetch_assoc(getMode($connect, $_GET['id']));

	if(isset($_POST['edit'])){
		extract($_POST);
			updateMode($connect,$_GET['id'], $mode);
			}
			include('header.php');
	?>
<head>
    <title>Edit Student</title>
	
</head>


<div style="position: relative;width: 80%;bottom: -2%; left: 16%;"><form method="POST">
			Time
			<button class="btn waves-effect waves-light blue lighten-2 white-text" type="text" name="mode" value="<?=$getMode['mode']?>"/><?=$getMode['mode']?></button>
			<button class="btn waves-effect waves-light blue lighten-2 white-text" type="submit" name="edit" value="Edit Record"/>Edit Record</button>	
</form>
<button class="btn waves-effect waves-light blue lighten-2 white-text" href="option.php">Back</button>
</div>
