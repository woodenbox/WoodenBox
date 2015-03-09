<?php
	session_start();

	include('processes/process.php');
	$connect = connectDB();
	$payment_date = date('Y-m-d');

	$mydate=getdate(date("U"));

	if(!isset($_SESSION['studenttransac'])){
		header('Location: viewstudent.php?id='.$_SESSION['studentfee']);
	}

	$checkStudent = viewStudentAccount($connect, $_SESSION['studentfee']);
	$viewStudent = mysqli_fetch_assoc($checkStudent);
	
	$checkARNumber = getARNumber($connect);
	$getARNumber = mysqli_fetch_assoc($checkARNumber);

    			/*if($balance['balance'] - $_POST['amount'] > 0 ){
    				echo '<script>alert("hello");</script>';
    			}*/
            	
            	//$x = $x+$balance['balance'];
            	//echo $_POST['amount'];
			//echo $x . '</br>';
	if(isset($_POST['submit'])){
		extract($_POST);
		$total=0;
		if(!empty($_POST['check_list'])) {
    		foreach($_POST['check_list'] as $check) {	
				$balance = getBalance($connect, $check) -> fetch_assoc();
				$total = $total+$balance['balance']+$balance['penalty_balance'];
    		}
    		echo '1' . $total;
    		echo '1' . $_POST ['amount'];
    		if($total >= $_POST['amount']){
    			echo '<script>alert("we are in");</script>';
    			$remaining = $_POST['amount'];
    			echo '2' . $remaining;
    			balancePayment($connect, $viewStudent['last_name'], $viewStudent['first_name'], $payment_date, $_POST['amount'], $_SESSION['studentfee'], $mydate['month'], $mydate['year'], $_POST['arnumber'], $_POST['dr'], $_POST['cr'], $_POST['remark']);
    			foreach($_POST['check_list'] as $check) {
    					$balance = getBalance($connect, $check) -> fetch_assoc();
    					$remaining = ($balance['balance']) - $remaining;
    					echo '3' . $remaining;
    					if($remaining > 0){
    						echo '4' . $remaining;
    						balanceClear($connect, $check, $remaining);
    						break;
    					} else if ($remaining <= 0){
    						echo '4' . $remaining;
    						$remaining = (-1*$remaining);
    						balanceClear($connect, $check, 0);
    						$remaining = ($balance['penalty_balance']) - $remaining;
    						if($remaining > 0 ){
    							echo "Penalty" . $remaining;
    							penaltyClear($connect, $check, $remaining);
    							break;
    						} else if($remaining <=0){
    							$remaining = (-1*$remaining);
    							penaltyClear($connect, $check, 0);
    							echo "clear" . $remaining;
    						}
    					}
    			}
    		echo '<script>alert("Enrollment Successful");</script>';
    		unset($_SESSION['studenttransac']);
    		header('Location: index.php');
    		//header('Location: viewStudent.php?id='.$_SESSION['studentfee']);
    		}
		}
	}

	if(isset($_POST['cancel'])){
		header('Location: viewstudent.php?id='.$_SESSION['studentfee']);
	}
?>

<head>
	<title>Payment</title>
	<link href="asd/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/init.css" type="text/css" rel="stylesheet" media="screen,projection"/>

</head>

<form method="POST">
	<label><?=$viewStudent['first_name']?> </label><label><?=$viewStudent['last_name']?></label></br>
<table name="first_name">
	<thead>
		<tr>
			<th></th>
			<th>Item</th>
			<th>Balance</th>
			<th>Due Date</th>
			<th>Penalty</th>
		</tr>
	</thead>

<?php	
	$table=getStudentBalancePayment($connect, $_SESSION['studentfee']);
	while($row=mysqli_fetch_assoc($table)){
?>

		<input type="checkbox"  name="check_list[]" value="<?=$row['id']?>" id="test5"/>
		  <label for="test5"><?=$row['item']?></label><br>
			
			<td>	  <label for="test5"><?=$row['item']?></label><br><?=$row['balance']?></td>
			<td><?=$row['due_date']?></td>
			<td><?=$row['penalty_balance']?></td>
		</tr>	
<?php	
	}
?>
	</table>
	<input type="number" min="0" placeholder="Enter Amount" name="amount" pattern="[0-9]+([.][0-9]+)?" step="0.01" required/></br>
	<input type="number" min="0" placeholder="AR Number" name="arnumber" value="<?=$getARNumber['ar']+1?>" pattern="[0-9]+" required/></br>
	<input type="text" placeholder="D.R." name="dr"/></br>
	<input type="text" placeholder="C.R." name="cr"/></br>
	<input type="text" placeholder="Remarks" name="remark" required/></br>
	<input type="submit" name="submit" value="Make Payment" >
	<input type="button" name="cancel" value="Cancel" onclick="location.href = 'viewstudent.php?id=<?=$_SESSION['studentfee']?>';">
</form>


<?php
	include('footer.php');
?>
    <script src="http://www.gstatic.com/external_hosted/picturefill/picturefill.min.js"></script>
  <script src="asd/js/materialize.js"></script>
  <script src="asd/js/init.js"></script>
  