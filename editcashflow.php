<?php
	session_start();
	include('header.php');
	include('processes/process.php');
	$connect=connectDB();

	$checkUserTable = editCashFlow($connect, $_GET['id']);
	$getUserRow = mysqli_fetch_assoc($checkUserTable);

	if(isset($_POST['delete'])){
		deleteCashFlow($connect, $_GET['id']);
		header('Location:index.php');
	}

	if(isset($_POST['submit'])){
		extract($_POST);
		updateCashFlow($connect, $_GET['id'], $arnumber, $cash, $dr, $cr, $tuitionfee, $remarks);
		header('Location:index.php');
	}

	if(isset($_POST['return'])){
		header('Location:index.php');
	}

?></br>
<!--================================ crap ^ ================================!-->

<form method="POST">
	<!--================================ eto ung name ng student na nagpay ================================!-->
	<label><?php echo $getUserRow['first_name'] ." ". $getUserRow['last_name']?></label></br>

	<!--================================ eto ung options na i-eedit ================================!-->
	<label>AR Number</label><input type="number" name="arnumber" value="<?=$getUserRow['ar']?>" pattern="[0-9]+" required/></br>
	<label>Cash</label><input type="number" name="cash" value="<?=$getUserRow['cash']?>" pattern="[0-9]+([.][0-9]+)?" step="0.01" required/></br>
	<label>D.R.</label><input type="text" name="dr" value="<?=$getUserRow['dr']?>" pattern="[A-Za-z0-9]+"/></br>
	<label>C.R.</label><input type="text" name="cr" value="<?=$getUserRow['cr']?>"  pattern="[A-Za-z0-9]+"/></br>
	<label>Tuition Fees</label><input type="number" name="tuitionfee" value="<?=$getUserRow['tuition']?>" pattern="[0-9]+([.][0-9]+)?" step="0.01" required/></br>
	<labe>Remarks</label><input type="text" name="remarks" value="<?=$getUserRow['remark']?>"  pattern="[A-Za-z ]+" required/></br>
	
	<input type="submit" name="submit" value="Save"></br>
	<input type="submit" name="delete" value="Delete Payment">
	<input type="submit" name="return" value="Cancel">
</form>

<!--================================ crap V ================================!-->
<?php
	include('footer.php');
?>