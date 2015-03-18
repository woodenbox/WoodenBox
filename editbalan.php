<?php
	session_start();
	include('processes/process.php');
	$connect=connectDB();

	$getBalance = mysqli_fetch_assoc(getBalance($connect, $_GET['id']));

	if(isset($_POST['delete'])){
		deleteStudentBalance($connect, $_GET['id'], 1);
		header('Location:viewstudent.php?id='.$_SESSION['studentfee']);
	}

	if($_SESSION['access_control']<2){
		header('Location:studentaccounts.php');
	}

	if(isset($_POST['undelete'])){
		deleteStudentBalance($connect, $_GET['id'], 0);
		header('Location: viewstudent.php?id='.$_SESSION['studentfee']);
	}

	if(isset($_POST['submit'])){
		extract($_POST);
		updateStudentBalance($connect, $_GET['id'], $getBalance['item'], $balance, $due_date, $penalty_balance, $penalty_count);
		header('Location:viewstudent.php?id='.$_SESSION['studentfee']);
	}

	if(isset($_POST['return'])){
		header('Location:viewstudent.php?id='.$_SESSION['studentfee']);
	}
	$header="Edit";
	$header2="Edit balance";
	include('header.php');
?>


      
<!--================================eto ung cashflow table. merun div para sa scroll bar================================!-->





<div style="position: relative;width: 80%;bottom: -2%; left: 16%;">
		<p class="blue-text"><?=$getBalance['item']?></p>
<form method="POST" class="col s3" style="font-size:75%;">

<div class="divider" style="width:30%;"></div>
<br>

	Balance
<div class="row">
<div class="col s2">
	<input type="number" name="balance" value="<?=$getBalance['balance']?>" pattern="[0-9]+([.][0-9]+)?" step="0.01" required/>
</div></div>



	Due Date<div class="row">
<div class="col s2">


	<input type="date" name="due_date" value="<?=$getBalance['due_date']?>" />
</div></div>

	Balance<div class="row">
<div class="col s2"><input type="number" name="penalty_balance" value="<?=$getBalance['penalty_balance']?>" pattern="[0-9]+([.][0-9]+)?" step="0.01"/>
</div></div>

	Penalty Count<div class="row">
<div class="col s2"><input type="number" name="penalty_count" value="<?=$getBalance['penalty_count']?>" pattern="[0-9]+"/>
</div></div>
</form>

	<button class="btn waves-effect waves-light white blue-text text-lighten-2" type="submit" name="submit" value="Save">Save</button>
	<?php if($getBalance['waive']==0){ ?>
		<button class="btn waves-effect waves-light white blue-text text-lighten-2" type="submit" name="delete" value="Waive">Waive</button>
	<?php } else { ?>

		<button class="btn waves-effect waves-light white blue-text text-lighten-2" type="submit" name="undelete" value="Unwaive">Unwaive</button>
	<?php } ?>

	<button class="btn waves-effect waves-light white blue-text text-lighten-2" type="submit" name="return" onclick="location.href='viewstudent.php?id=<?=$_GET['id']?>'" value="Cancel">Cancel</button>
</form>

<script src="http://www.gstatic.com/external_hosted/picturefill/picturefill.min.js"></script>
<script src="asd/js/materialize.js"></script>
<script src="asd/js/init.js"></script>

<?php
	include('footer.php');
?>