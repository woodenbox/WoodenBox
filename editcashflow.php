<?php
	session_start();
	include('processes/process.php');
	$connect=connectDB();

	if($_SESSION['access_control']<2){
		header('Location:index.php');
	}

	$checkUserTable = editCashFlow($connect, $_GET['id']);
	$getUserRow = mysqli_fetch_assoc($checkUserTable);


	if(isset($_POST['123'])){
		extract($_POST);
		updateCashFlow($connect, $_GET['id'], $arnumber, $cash, $dr, $cr, $tuitionfee, $remarks);
		header('Location:index.php');
	}

	if(isset($_POST['return'])){
		header('Location:index.php');
	}








	?>



    <?php $header = "Edit Cashflow" ;?>
	<?php $header2 =  "Edit Cashflow";

	include('header.php');?>


<!--================================ crap ^ ================================!-->
<head>
	<title>Edit Cash Flow</title>
</head>





<div style="position: relative;width: 80%;bottom: -2%; left: 16%;">
<form method="POST" class="col s2" style="font-size:75%;">
	<!--================================ eto ung name ng student na nagpay ================================!-->
	<label><?php echo $getUserRow['first_name'] ." ". $getUserRow['last_name']?></label></br>

	<!--================================ eto ung options na i-eedit ================================!-->
	<label>AR Number</label>

<div class="row">
	<div class="col s2">
	<input type="number" name="arnumber" value="<?=$getUserRow['ar']?>" pattern="[0-9]+" title="Numbers up to two decimal values" required/></div></div>
	<label>Cash</label>



<div class="row">
	<div class="col s2">
	<input type="number" name="cash" value="<?=$getUserRow['cash']?>" pattern="[0-9]+([.][0-9]+)?" step="0.01" required title="Numbers up to two decimal values"/></br>
	<!--<label>D.R.</label><input type="text" name="dr" value="<?php //$getUserRow['dr']?>" pattern="[A-Za-z0-9]+"/></br>!-->
	<!--<label>C.R.</label><input type="text" name="cr" value="<?php //$getUserRow['cr']?>"  pattern="[A-Za-z0-9]+"/></br>!--></div></div>
	<label>Tuition Fees</label>



<div class="row">
	<div class="col s2">
	<input type="number" name="tuitionfee" value="<?=$getUserRow['tuition']?>" pattern="[0-9]+([.][0-9]+)?" step="0.01" title="Numbers up to two decimal values" required/></br>
</div></div>	<labe>Remarks</label>



<div class="row">
	<div class="col s2"></form>
		<input type="text" name="remarks" value="<?=$getUserRow['remark']?>"  pattern="[A-Za-z ]+" title="Only letters and spaces are accepted" required/></br>
	</div></div>
	<button class="btn waves-effect waves-light white blue-text text-lighten-2"  name="123" value="Save">Save</button>
	<?php if($getUserRow['state']==0){ ?>
		
		<?php }else{ ?>
		<button class="btn waves-effect waves-light white blue-text text-lighten-2"  name="restore" value="Restore">Restore</button>
		<?php } ?>
	<button class="btn waves-effect waves-light white blue-text text-lighten-2" onclick="location.href='index.php'" name="return" >Cancel</button>
</form>

<!--================================ crap V ================================!-->
<?php
	include('footer.php');
?>