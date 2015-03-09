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
    ?>
    <head>
    	<title>Student Enrollment</title>
		  <link href="asd/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/init.css" type="text/css" rel="stylesheet" media="screen,projection"/>




    </head>
	 <div class="section no-pad-bot blue lighten-1" id="index-banner">
        <div class="container nav-wrapper">
	
          <h1 class="header center-on-small-only white-text">Enroll a Student</h1>
          <div class='row '>
            <h4 class ="header light blue-text text-lighten-4">     Fill up the form
 </h4>

  
  
 <h4 class="right-align" style="margin-top:-50px;"><a class="dropdown-button" href="#!" data-activates="dropdown1"> <i class="mdi-communication-message white-text waves-effect waves-blue"></i></a>
 
 
  <a class="dropdown-button" href="#!" data-activates="dropdown1"> <i class="mdi-action-account-box white-text waves-effect waves-blue"></i></a></h4>
 <ul id='dropdown1' class='dropdown-content'>
			<li>  <a href="logout.php">Log Out</a></li>
			<li>  <a href="option.php">Options</a></li>
  </ul>
	  
	 
	 
	 
	 </ul>
 </div>
          </div>
		  </div>

      
<!--================================eto ung cashflow table. merun div para sa scroll bar================================!-->

<div class="container"><a href="#" data-activates="nav-mobile" class="button-collapse top-nav full"></a></div>
      <ul id="nav-mobile" class="side-nav fixed">

	   <li class="logo" style="padding-left:45px;padding-top:15px;"><image src="asdg.png" onclick="toast('Huehue', 400)"></li>
	   <div class="section"></div>
	  <div class="divider"></div><div class="section"></div>
<li class="" style="padding-top:15px;padding-bottom:15px;">	<b><a  class=" waves-effect waves-green" style="font-size:14px;" href="index.php">Cash Reports<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a  style="font-size:14px;" href="studentaccounts.php" class="waves-effect waves-green">Student Accounts<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="search.php" class="waves-effect waves-green">Student List<?echo"\t";?></a></li>



<li class="active blue lighten-1" style="padding-top:15px;padding-bottom:15px;">	<a style=" font-size:14px;" href="addstudent.php" class="white-text waves-effect waves-green">Add Student<?echo"\t";?></a></li>




   
   
   
   
   
   
   
   
   






  </ul>	
</b>

<div style="margin-left:290px;margin-right:1300px;margin-top:50px;">

    <form method="POST" enctype="multipart/form-data">
    	<div class="image-upload">
    		<label for="file-input">
    			<img src="uploads/imagethumbnail.png"  height="150" width="150"/>
    		</label>
    		<input style="display: none;" id="file-input"  name="imgfile" type="file"/>
    	</div>
		
    	<input style="margin-left:170px;margin-top:-140px;" class="col s12 validate" type="text" placeholder="First Name" name="first_name" pattern="[A-Za-z]+" requiblue/></br>
    	<input style="margin-left:550px;margin-top:-140px;" class="col s3" type="text" placeholder="Last Name" name="last_name"  pattern="[A-Za-z]+" requiblue/></br>
    	<input style="margin-left:950px;margin-top:-140px;" class="col s3" type="text" placeholder="Middle Name" name="middle_name" pattern="[A-Za-z]+"/></br>
    	<input style="margin-left:170px;margin-top:-60px;" class="col s3" type="text" placeholder="Age" name="age"/></br>
		
<br>
<div class="divider"> </div><div class="divider" style="position:relative;left: 300px;top:-1px;"> </div><div class="divider" style="position:relative;left: 600px;top:-2px;"> </div>
<div class="divider" style="position:relative;left: 900px;top:-3px;"> </div><div class="divider" style="position:relative;left: 1200px;top:-4px;"> </div>

    	<p class="blue-text text lighten-2" style="font-weight:bold;">Grade:</p>
    	<select class="col s3" name="grades" id="grades">
    		<?php
    		$checkGradesTable = getGradesDB($connect);
    		while ($arrayGradesTable = mysqli_fetch_array($checkGradesTable, MYSQLI_ASSOC)) {
    			$grade_level=$arrayGradesTable["grade_levels"];
    			echo "<option value=\"$grade_level\">$grade_level</option>";        
    		}
    		?>
    	</select></br>
		
		
		<div style="position: relative;left: 350px;top: -143px;">
	
    	<p class="blue-text lighten-2" style="font-weight:bold;">From: </p>
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
			<div style="position: relative;left: 700px;top: -249px;">
		
    	<p class="blue-text lighten-2" style="font-weight:bold;">	To:</p>
    	<select name="toTime">
    		<?php
    		$checkTimeTable2 = getTimeDB($connect);
    		while($arrayTimeTable=mysqli_fetch_array($checkTimeTable2, MYSQLI_ASSOC)){
    			$time = $arrayTimeTable["time"];
    			echo"<option value=\"$time\">$time</option>";
    		}
    		?>
			
    	</select></div></br>
		<div class="divider" style="position:relative;bottom: 225px;"></div>		<div class="divider" style="position:relative;bottom: 226px;left:300px;"></div>
			<div class="divider" style="position:relative;bottom: 227px;left:600px;"></div>	<div class="divider" style="position:relative;bottom: 228px;left:900px;"></div>
				<div class="divider" style="position:relative;bottom: 229px;left:1200px;"></div>
				
				<div style="position: relative;left: 00px;top: -229px;">
    	<p class="blue-text lighten-2" style="font-weight:bold;">Academic Status:</p>
    	<select name="academicstatus">
    		<?php
    		$checkAcademicStatusTable = getAcademicStatusDB($connect);
    		while($arrayAcademicTable=mysqli_fetch_array($checkAcademicStatusTable, MYSQLI_ASSOC)){
    			$status=$arrayAcademicTable["status"];
    			echo"<option value=\"$status\">$status</option>";
    		}
    		?>
    	</select></div></br>
		<div style="position: relative;left: 350px;top: -372px;">
		<p class="blue-text lighten-2" style="font-weight:bold;">
    	Payment Mode:</p>
    	<select name="paymentmode">
    		<?php
    		$checkPaymentModeTable=getPaymentModeDB($connect);
    		while($arrayPaymentModeTable=mysqli_fetch_array($checkPaymentModeTable, MYSQLI_ASSOC)){
    			$mode=$arrayPaymentModeTable["mode"];
    			echo"<option value=\"$mode\">$mode</option>";
    		}
    		?>
			
			
			
			<div class="diver"></div>
			
			
			
			
			
			
    	</select></div>
	

    	
    				<div style="position:relative;bottom:370px;font-weight:bold;" class="blue-text text lighten-2">Item</div>
    				<div style="position:relative;bottom:392px;font-weight:bold;left: 300px;" class="blue-text text lighten-2">	Price</div>
    				<div style="position:relative;bottom:412px;font-weight:bold;left: 600px;" class="blue-text text lighten-2">Quantity  	</div>	
					<div class="divider" style="position:relative;bottom:402px;"></div><div class="divider" style="position:relative;bottom:403px;left:150px;"></div>.
					<div class="divider" style="position:relative;bottom:426px;left:450px;"></div>
    		<?php	
    		$table=getOthers($connect);
    		while($row=mysqli_fetch_assoc($table)){
    			?>
				
			
		
			</table>
    				<input type="checkbox" id="<?=$row['id']?>"  name="check_list[]" value="<?=$row['id']?>"  />
    				<label for="<?=$row['id']?>"style="position:relative;left:000px;bottom:401px;"><?=$row['item']?></label>
    				<p style="position:relative;left:300px;bottom:445px;"><?=$row['price']?></p>
    				<input style="position:relative;left:300px;bottom:500px;left:450px;"type="text" placeholder="Enter Amount"  pattern="[0-9]+" name="howmany[]"/>
    				
    			<?php	
    		}
    		?>
    



    	<script src="jquery-2.1.3.min.js"></script>
    	<script>



</script>
<div class="divider" style="position:relative;bottom:470px;"></div><div class="divider" style="position:relative;bottom:471px;left:300px;"></div>
<div class="divider" style="position:relative;bottom:472px;left:600px;"></div><div class="divider" style="position:relative;bottom:473px;left:900px;"></div>
<div class="divider" style="position:relative;bottom:474px;left:1200px;"></div>
<button class="btn waves-effect waves-light green" type="submit" name="submit" value="Enroll" onclick="return confirm('Are you sure?');" style="position:relative;bottom:450px;left:700px;">Enroll</button>



</form>



</div>
<?php
include("footer.php");
?>
    <script src="http://www.gstatic.com/external_hosted/picturefill/picturefill.min.js"></script>
  <script src="asd/js/materialize.js"></script>
  <script src="asd/js/init.js"></script>
  
  