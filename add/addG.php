<?php
	include('../processes/process.php');
	$connect=connectDB();
	if(isset($_POST['add'])){
		$grade=$_POST['grade'];
			$add=addGrade($connect,$grade);
			if($add){
				echo "Added successfully";
			}
			else{
				echo "Failed to add";
			}
		
	}
?>


<form method="POST">
			Grade Level
			<input type="text" name="grade" value=""/>
			<input type="submit" name="add" value="Add Record"/>
			<input type="reset" name="clear" value="Clear"/></td>
			</form>
			<a href ="../option.php">Back</a>
