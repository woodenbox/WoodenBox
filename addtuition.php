<?php
session_start();
	include('processes/process.php');
	$connect=connectDB();

	if(isset($_POST['zxc'])){
		extract($_POST);
			insertTuition($connect,$grade, $fee_type, $item, $tuition_fee, $due_date);
			header('Location: option.php');
			}
$header="Tuition Fees";
$header2="Add tuition fees";
			include('header.php');

	?>



<div style="position: relative;width: 80%;bottom: -2%; left: 16%;">
<form method="POST">
			<input style="width:10%;" type="text" placeholder="Grade" name="grade" pattern="[A-Za-z0-9 ]+" required/>
			<br/>
			<div class="input_field" style="width:10%;">
			<select  name="fee_type">
			<?php $getPaymentModeDB = getPaymentModeDB($connect);
				while($row=mysqli_fetch_array($getPaymentModeDB, MYSQLI_ASSOC)){
					$status=$row["mode"]; ?>
				<option  value="<?=$status?>"><?=$status?></option>
			<?php } ?>
			</select></div>
			<br/>
			<input style="width:10%;" type="text" placeholder="Item" name="item" pattern="[A-Za-z0-9]+" required/>
			<br/>
			<input style="width:10%;" type="number"  placeholder="Tuition Fee" name="tuition_fee"  pattern="[0-9]+([.][0-9]+)?" step="0.01" required/>
			<br/>
			<input style="width:10%;" type="date" name="due_date"/>
			</br>
				<button class="btn waves-effect waves-light blue lighten-2 white-text" type="submit" name="zxc" value="Save"/>Save</button>
			<br/>
				<button class="btn waves-effect waves-light blue lighten-2 white-text"  type="submit" onclick="location.href='option.php'" value="Back"/>Back</button>
</form>
</div>