<?php
	include('../processes/process.php');
	$connect=connectDB();
	if(isset($_POST['add'])){
		$status=$_POST['status'];
			$add=addStatus($connect,$status);
			if($add){
				echo "Added successfully";
			}
			else{
				echo "Failed to add";
			}
		
	}
?>

<form method="POST">
			Academic Status
			<input type="text" name="status" value=""/>
			<input type="submit" name="add" value="Add Record"/>
			<input type="reset" name="clear" value="Clear"/></td>
			</form>
			<a href ="../option.php">Back</a>

