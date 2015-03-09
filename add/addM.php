<?php
	include('../processes/process.php');
	$connect=connectDB();
	if(isset($_POST['add'])){
		$mode=$_POST['mode'];
			$add=addMode($connect,$mode);
			if($add){
				echo "Added successfully";
			}
			else{
				echo "Failed to add";
			}
		
	}
?>

<form method="POST">
			Mode
			<input type="text" name="mode" value=""/>
			<input type="submit" name="add" value="Add Record"/>
			<input type="reset" name="clear" value="Clear"/></td>
			</form>
			<a href ="../option.php">Back</a>

