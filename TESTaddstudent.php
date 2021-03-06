<?php
	session_start();
	include('processes/process.php');
	$connect = connectDB();
	$datengayon = date('Y-m-d');
	if(isset($_POST['submit'])){
		if($_FILES["imgfile"]["size"]>0){
			$filename=$_FILES["imgfile"]["name"];
			$filetype=$_FILES["imgfile"]["type"];	
			$filesize=$_FILES["imgfile"]["size"];
			if ((($filetype=="image/jpeg") || ($filetype=="image/png")  || ($filetype=="image/pjpeg")) && ($filesize<200000)){
				$checker="uploads/$filename";
				if(file_exists($checker)){
					echo '<script type="text/javascript">alert("File name already exist. Please apply proper image name formating.");</script>';
				} else {
					extract($_POST);
					$imageLocation=$filename;
					addStudentDB($connect, $first_name, $last_name, $middle_name, $age, $grades, $fromTime, $toTime, $academicstatus, $paymentmode, $uniform, $peuniform, $imageLocation, $datengayon,$sy);
					$idd=mysqli_insert_id($connect);
					if(!empty($_POST['check_list'])) {
						$xx=0;
						foreach($_POST['check_list'] as $check) {
							$balance = addOthers($connect, $check) -> fetch_assoc();
							$HowsMany = $balance['price'] * $_POST['howmany'][$xx];
							echo $_POST['howmany'][$xx], '<br>';
							echo $HowsMany, '<br>';
							addBalanceDB($connect, $idd, $balance['item'], $HowsMany, null);
							$xx++;
						}
					}
					$getFeeSchedule=getFeeSchedule($connect, $grades, $paymentmode);
					$mydate=getdate(date("U"));
					$year= $mydate["year"];
					while ($arrayFeeSchedule = mysqli_fetch_array($getFeeSchedule, MYSQLI_ASSOC)) {
						if($arrayFeeSchedule['item']=='Monthly Fee'){
							for($dues=1; $dues<=10; $dues++){
								$date_str=date('Y-m-d', strtotime("$year-05-30"));
								$monthlyDue = add($date_str, $dues);
								$dateObj   = DateTime::createFromFormat('!m', $monthlyDue->format('m'));
								$monthName = $dateObj->format('F'); // March
								addBalanceDB($connect, $idd, $monthName." fee", $arrayFeeSchedule['fee'], $monthlyDue->format('Y-m-d')); 
								echo $monthlyDue->format('Y-m-d'), '<br>';
								echo $monthlyDue->format('m'), '<br>';
								echo $monthName;
							}
						} else {
							addBalanceDB($connect, $idd, $arrayFeeSchedule['item'], $arrayFeeSchedule['fee'], $arrayFeeSchedule['due_date']);        
						}
					}
					move_uploaded_file($_FILES["imgfile"]["tmp_name"], "uploads/" . $idd);
					echo '<script>alert("Enrollment Successful");</script>';
					header('Location:viewstudent.php?id='.$idd);
				}
			} else {
				echo '<script type="text/javascript"> alert("Invalid file. Please select a file that is jpg or png.");</script>';
			}
		} else {
			extract($_POST);
			$imageLocation=null;
			addStudentDB($connect, $first_name, $last_name, $middle_name, $age, $grades, $fromTime, $toTime, $academicstatus, $paymentmode, null, null, $imageLocation, $datengayon, $sy);
			$idd=mysqli_insert_id($connect);
     		copy('uploads/imagethumbnail.png', 'uploads/'.$idd);
			if(!empty($_POST['check_list'])) {
				$xx=0;
				foreach($_POST['check_list'] as $check) {
					$balance = addOthers($connect, $check) -> fetch_assoc();
					$HowsMany = $balance['price'] * $_POST['howmany'][$xx];
					echo $_POST['howmany'][$xx], '<br>';
					echo $HowsMany, '<br>';
					addBalanceDB($connect, $idd, $balance['item'], $HowsMany, null);
					$xx++;
				}
			}
			$getFeeSchedule=getFeeSchedule($connect, $grades, $paymentmode);
	   		$mydate=getdate(date("U"));
	    	$year= $mydate["year"];
		    while ($arrayFeeSchedule = mysqli_fetch_array($getFeeSchedule, MYSQLI_ASSOC)) {
	    		if($arrayFeeSchedule['item']=='Monthly Fee'){
	    			for($dues=1; $dues<=10; $dues++){
		    			$date_str=date('Y-m-d', strtotime("$year-05-30"));
		    			$monthlyDue = add($date_str, $dues);
		    			$dateObj   = DateTime::createFromFormat('!m', $monthlyDue->format('m'));
						$monthName = $dateObj->format('F'); // March
						addBalanceDB($connect, $idd, $monthName." fee", $arrayFeeSchedule['fee'], $monthlyDue->format('Y-m-d')); 
						echo $monthlyDue->format('Y-m-d'), '<br>';
						echo $monthlyDue->format('m'), '<br>';
						echo $monthName;
					}
				} else {
					addBalanceDB($connect, $idd, $arrayFeeSchedule['item'], $arrayFeeSchedule['fee'], $arrayFeeSchedule['due_date']);        
				}
			}
           echo '<script> alert("Enrollment Successful");</script>';
        }
    }
 	$header = "Add Student";
	$header2 =  "Enroll a Student";
	include('header.php');
	$selectSY=selectSY($connect);
?>
<head>
    <title>Student Enrollment</title>
	<link href="asd/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  	<link href="asd/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  	<link href="asd/css/init.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<form method="POST" enctype="multipart/form-data" class="col s12">

	<!-- VVVVVSENSITIVE TONG PART NA TO WAG MO MASYADO GALAWINVVVVV !-->
    <div class="image-upload">
    	<label for="file-input">
    		<img src="uploads/imagethumbnail.png"  height="150" width="150"/>
    	</label>
    	<input style="display: none;" id="file-input"  name="imgfile" type="file"/>
    </div>
	<!-- ^^^^^ SENSITIVE TONG PART NA TO WAG MO MASYADO GALAWIN ^^^^^!-->

	<input id="first_name" type="text" name="first_name" pattern="[A-Za-z ]+"required>
	<label for="first_name" style="font-size:75%;">First Name</label>
	<input id="middle_name" type="text" name="middle_name" pattern="[A-Za-z. ]+" required>
	<label for="middle_name" style="font-size:75%;">Middle Name</label>
	<input id="last_name" type="text" name="last_name" pattern="[A-Za-z ]+" required>
    <label for="last_name" style="font-size:75%;">Last Name</label>
	<input id="age" type="text" name="age" pattern="[0-9]+" required>
	<label for="age" style="font-size:75%;">Age</label>
	<input id="sy" type="text" name="sy" value="<?=$selectSY['from']?> - <?=$selectSY['to']?>" pattern="[2][0][1-9][ ][-][ ][2][0][0-9][0-9]" required>
	<label for="sy" style="font-size:75%;">Age</label>
    <p>Grade:</p>
    <select name="grades" id="grades">
<?php
    	$checkGradesTable = viewGrade($connect);
    	while ($arrayGradesTable = mysqli_fetch_array($checkGradesTable, MYSQLI_ASSOC)) {
    		$grade_level=$arrayGradesTable["grade_levels"];
    		echo "<option value=\"$grade_level\">$grade_level</option>";        
    	}
?>
    </select></br>
    <p>From:</p>
    <select name="fromTime">
<?php
    	$checkTimeTable = getTimeDB($connect);
    	while($arrayTimeTable=mysqli_fetch_array($checkTimeTable, MYSQLI_ASSOC)){
    		$time = $arrayTimeTable["time"];
    		echo"<option value=\"$time\">$time</option>";
    	}
?>
    </select>
   	<p>To:</p>
    <select name="toTime">
<?php
    	$checkTimeTable2 = getTimeDB($connect);
    	while($arrayTimeTable=mysqli_fetch_array($checkTimeTable2, MYSQLI_ASSOC)){
    		$time = $arrayTimeTable["time"];
    		echo"<option value=\"$time\">$time</option>";
		}
?>
			
    </select>
	<p>Academic Status:</p>
    <select name="academicstatus">
<?php
    	$checkAcademicStatusTable = getAcademicStatusDB($connect);
    	while($arrayAcademicTable=mysqli_fetch_array($checkAcademicStatusTable, MYSQLI_ASSOC)){
    		$status=$arrayAcademicTable["status"];
    		echo"<option value=\"$status\">$status</option>";
		}
?>
    </select>
	<p>Payment Mode:</p>
    <select name="paymentmode">
<?php
    	$checkPaymentModeTable=getPaymentModeDB($connect);
    	while($arrayPaymentModeTable=mysqli_fetch_array($checkPaymentModeTable, MYSQLI_ASSOC)){
    		$mode=$arrayPaymentModeTable["mode"];
    		echo"<option value=\"$mode\">$mode</option>";
    	}
?>
	</select>
	<div>Item</div>
	<div>Price</div>
	<div>Quantity</div>	
<?php	
    $table=getOthers($connect);
    while($row=mysqli_fetch_assoc($table)){
?>
		<input type="checkbox" id="<?=$row['id']?>"  name="check_list[]" value="<?=$row['id']?>"  />
		<label for="<?=$row['id']?>"><?=$row['item']?></label>
		<p><?=$row['price']?></p>			
		<div>
			<input id="enter_amount" type="text" class="validate" name="howmany[]" pattern="[0-9]" style="width:12%;"	>
			<label for="enter_amount">Enter Amount</label>
		</div>
<?php	
    }
?>
    <button class="btn waves-effect waves-light blue lighten-2 white-text" type="submit" name="submit" value="Enroll" onclick="return confirm('Please check details before continuing?');" style="position:relative;left:0%;bottom: 490px;">Enroll</button>
</form>
<script src="http://www.gstatic.com/external_hosted/picturefill/picturefill.min.js"></script>
<script src="asd/js/materialize.js"></script>
<script src="asd/js/init.js"></script>
  
<?php
	include("footer.php");
?>
