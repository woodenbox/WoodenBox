<?php
	include('processes/process.php');
	$connect=connectDB();

	if(isset($_POST['zxc'])){
		extract($_POST);
			insertTuition($connect,$grade, $fee_type, $item, $tuition_fee, $due_date);
			header('Location: option.php');
			}

	?>

<form method="POST">
			<input type="text" placeholder="Grade" name="grade" pattern="[A-Za-z0-9 ]+" required/>
			<br/>
			<select name="fee_type">
			<?php $getPaymentModeDB = getPaymentModeDB($connect);
				while($row=mysqli_fetch_array($getPaymentModeDB, MYSQLI_ASSOC)){
					$status=$row["mode"]; ?>
				<option value="<?=$status?>"><?=$status?></option>
			<?php } ?>
			</select>
			<br/>
			<input type="text" placeholder="Item" name="item" pattern="[A-Za-z0-9]+" required/>
			<br/>
			<input type="number"  placeholder="Tuition Fee" name="tuition_fee"  pattern="[0-9]+([.][0-9]+)?" step="0.01" required/>
			<br/>
			<input type="date" name="due_date"/>
			</br>
			<input type="submit" name="zxc" value="Save"/>
			<br/>
			<input  type="submit" onclick="location.href='option.php'" value="Back"/>
</form>