<?php
session_start();

include('processes/process.php');
$connect = connectDB();

$datengayon = date('Y-m-d');

/*
	$monthNum  = 4;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = $dateObj->format('F');

echo $monthName;


	$mydate=getdate(date("U"));
	echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";
	$date2=date('Y-m-d', strtotime('10 March 2011'));

	$date1=date('Y-m-d', strtotime('11 December 2010'));

	for($x=1; $x<=12; $x++){
	$date3=date('Y-m-d', strtotime('+' . $x . ' month'));
	echo $date3;
	
	}

	$time = strtotime("2010.12.11");
	$final = date("Y-m-d", strtotime("+1 month", $time));
*/













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
                	//move_uploaded_file($_FILES["imgfile"]["tmp_name"],"uploads/$filename");
					extract($_POST);
					$imageLocation=$filename;
					addStudentDB($connect, $first_name, $last_name, $middle_name, $age, $grades, $fromTime, $toTime, $academicstatus, $paymentmode, $uniform, $peuniform, $imageLocation, $datengayon);
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
		}}

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
			}}
                	//$temp = explode(".",$_FILES["imgfile"]["name"]);
                	//$newfilename = rand(1,99999) . '.' .end($temp);
                	//echo "location";
                	//echo $imageLocation;
                	//echo "here";
                	//echo $idd;
                	//echo "newfile";
                	//echo $newfilename;
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

	addStudentDB($connect, $first_name, $last_name, $middle_name, $age, $grades, $fromTime, $toTime, $academicstatus, $paymentmode, null, null, $imageLocation, $datengayon);
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
		}}



		$getFeeSchedule=getFeeSchedule($connect, $grades, $paymentmode);


			//if($paymentmode=='Monthly'){
				/*$getMonthlyFeeSchedule = getMonthlyFeeSchedule($connect, $grades);
				while ($arrayFeeSchedule = mysqli_fetch_array($getMonthlyFeeSchedule, MYSQLI_ASSOC)) {
	    			addBalanceDB($connect, $idd, $arrayFeeSchedule['item'], $arrayFeeSchedule['fee'], $arrayFeeSchedule['due_date']);        
	    		}*/


    		//} else{
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
			}}


/*       		$remark="Downpayment";
       		$payment_date = '2000-11-11';
       		$dr="";
       		$cr="";
       		$tuition=9000;
			if($paymentmode=="Cash"){
                $checkFeeTable = getFeeDB($connect, $paymentmode);
				$getFeeRow = mysqli_fetch_assoc($checkFeeTable);
				$cash = 9000;
				$balance = $tuition - $cash;
                //addBalanceDB($connect, $idd, $balance, $cash, '2000-11-11');
                payBalanceDB($connect, $last_name, $first_name, $payment_date, $cash, $dr, $cr, $tuition, $remark, $idd);
            }	
 */          
            echo '<script> alert("Enrollment Successful");</script>';
           header('Location:viewstudent.php?id='.$idd);
        }
    }



$active = 4;

?>


    <?php $header = "Add Student";?>
	<?php $header2 =  "Enroll a Student";

	include('header.php');?>

   







    <head>
    	<title>Student Enrollment</title>
		  <link href="asd/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/init.css" type="text/css" rel="stylesheet" media="screen,projection"/>




    </head>
	



<div style="position: relative;width: 80%;bottom: -2%; left: 16%;">
	<br>
<div class="row">
    <form method="POST" enctype="multipart/form-data" class="col s12">
    	<div class="image-upload">
    		<label for="file-input" style="float:left;padding-right:2%;" class="validate tooltipped" data-position="bottom" data-delay="50" data-tooltip="Click to upload a photo!">
    			<img src="uploads/imagethumbnail.png"  height="150" width="150"/>
    		</label>
    		<input style="display: none;" id="file-input"  name="imgfile" type="file"/>



	<div class="input-field col s3" >
			 	<input id="first_name" type="text" class="validate tooltipped" data-position="top" data-delay="50" data-tooltip="Student's First Name" name="first_name" pattern="[A-Za-z ]+" style="font-size:90%;" required>
      			  <label for="first_name" style="font-size:75%;">First Name</label>
      	</div>



    	</div>
		


	


	<div class="input-field col s3">
			 	<input id="middle_name" type="text" class="validate tooltipped" data-position="top" data-delay="50" data-tooltip="Student's Middle Name" name="middle_name" pattern="[A-Za-z. ]+" style="font-size:90%;" required>
      			  <label for="middle_name" style="font-size:75%;">Middle Name</label>
      	</div>



     <div class="input-field col s3">
			 	<input id="last_name" type="text" class="validate tooltipped" data-position="top" data-delay="50" data-tooltip="Student's Last Name" name="last_name" pattern="[A-Za-z ]+" style="font-size:90%;" required>
      			  <label for="last_name" style="font-size:75%;">Last Name</label>
      	</div>
    	



    <div class="row">



 <div class="input-field col s3">
			 	<input id="age" type="text" name="age" pattern="[A-Za-z ]+" style="font-size:90%;" class="validate tooltipped" data-position="bottom" data-delay="50" data-tooltip="Student's Age" required>
      			  <label for="age" style="font-size:75%;">Age</label>
      	</div>
    	





    	</div>









    </div>


		


<div class="divider" style="position:relative;"> </div>




<div class="row">


    	<p class="blue-text text lighten-2" style="font-weight:bold;font-size:85%;">Grade:</p>
 
    	<div class="col s2" >

    	<select name="grades" id="grades">
    		<?php
    		$checkGradesTable = viewGrade($connect);
    		while ($arrayGradesTable = mysqli_fetch_array($checkGradesTable, MYSQLI_ASSOC)) {
    			$grade_level=$arrayGradesTable["grade_levels"];
    			echo "<option value=\"$grade_level\">$grade_level</option>";        
    		}
    		?>
    	</select></br>






		
		
		<div style="position: relative;left: 150%;top: -143px;">
	
    	<p class="blue-text lighten-2" style="font-weight:bold;font-size:85%;">From: </p>
    	<select style="margin-left:-370px;margin-top:-143px;" name="fromTime">
    		<?php
    		$checkTimeTable = getTimeDB($connect);
    		while($arrayTimeTable=mysqli_fetch_array($checkTimeTable, MYSQLI_ASSOC)){
    			$time = $arrayTimeTable["time"];
    			echo"<option value=\"$time\">$time</option>";
    		}
    		?>
    	</select>
		</div>
			<div style="position: relative;left: 300%;top: -249px;">
	
    	<p class="blue-text lighten-2" style="font-weight:bold;font-size:85%;">	To:</p>
    	<select name="toTime">
    		<?php
    		$checkTimeTable2 = getTimeDB($connect);
    		while($arrayTimeTable=mysqli_fetch_array($checkTimeTable2, MYSQLI_ASSOC)){
    			$time = $arrayTimeTable["time"];
    			echo"<option value=\"$time\">$time</option>";
    		}
    		?>
			
    	</select></div></br></div></div>


<div class="row">
				
				<div style="position: relative;left: 00px;top: -229px;">
    	<p class="blue-text lighten-2" style="font-weight:bold;font-size:85%;">Academic Status:</p>
    	<div class="col s3">
    	<select name="academicstatus">
    		<?php
    		$checkAcademicStatusTable = getAcademicStatusDB($connect);
    		while($arrayAcademicTable=mysqli_fetch_array($checkAcademicStatusTable, MYSQLI_ASSOC)){
    			$status=$arrayAcademicTable["status"];
    			echo"<option value=\"$status\">$status</option>";
    		}
    		?>
    	</select>
		<div style="position: relative;left: 350px;top: -116px;">
		<p class="blue-text lighten-2" style="font-weight:bold;font-size:85%;">
    	Payment Mode:</p><div class="col s12">
    	<select name="paymentmode">
    		<?php
    		$checkPaymentModeTable=getPaymentModeDB($connect);
    		while($arrayPaymentModeTable=mysqli_fetch_array($checkPaymentModeTable, MYSQLI_ASSOC)){
    			$mode=$arrayPaymentModeTable["mode"];
    			echo"<option value=\"$mode\">$mode</option>";
    		}
    		?>
			
			
			
			<div class="diver"></div>
			
			
			
			
			
			
    	</select></div></div></div></div></div>

	
</br>
    	
    				<div style="position:relative;bottom:370px;font-weight:bold;" class="blue-text text lighten-2">Item</div>
    				<div style="position:relative;bottom:392px;font-weight:bold;left: 250px;" class="blue-text text lighten-2">	Price</div>
    				<div style="position:relative;bottom:412px;font-weight:bold;left: 350px;" class="blue-text text lighten-2">Quantity  	</div>	

    		<?php	
    		$table=getOthers($connect);
    		while($row=mysqli_fetch_assoc($table)){
    			?>
				
			
		
			</table>
    				<input type="checkbox" id="<?=$row['id']?>"  name="check_list[]" value="<?=$row['id']?>"  />
    				<label for="<?=$row['id']?>"style="position:relative;left:00px;bottom:400px;"><?=$row['item']?></label>
    				<p style="position:relative;left:250px;bottom:445px;"><?=$row['price']?></p>
    				

    				 <div class="input-field col s2 m1"  style="position:relative;left:300px;bottom:500px;left:350px;">
       										 <input id="enter_amount" type="text" class="validate" name="howmany[]" pattern="[0-9]" style="width:12%;"	>
        											<label for="enter_amount">Enter Amount</label>


     				 </div>
    		<!--   <input style="position:relative;left:300px;bottom:500px;left:350px;"type="text" placeholder="Enter Amount"  pattern="[0-9]" name="howmany[]"/>		!-->

    				
    			<?php	
    		}
    		?>
    <button class="btn waves-effect waves-light blue lighten-2 white-text" type="submit" name="submit" value="Enroll" onclick="return confirm('Please check details before continuing?');" style="position:relative;left:0%;bottom: 490px;">Enroll</button>





    	<script src="jquery-2.1.3.min.js"></script>
    	<script>



</script>



</form>



</div>
<?php
include("footer.php");
?>
    <script src="http://www.gstatic.com/external_hosted/picturefill/picturefill.min.js"></script>
  <script src="asd/js/materialize.js"></script>
  <script src="asd/js/init.js"></script>
  
  