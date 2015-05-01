<?php
    session_start();
   
    include('processes/process.php');
    $connect = connectDB();

    $datengayon = date('Y-m-d');

    $checkStudent = viewStudentAccount($connect, $_GET['id']);
    $viewStudent = mysqli_fetch_assoc($checkStudent);

	if(isset($_POST['submit'])){
		if($_FILES["imgfile"]["size"]>0){
			$filename=$_FILES["imgfile"]["name"];
			$filetype=$_FILES["imgfile"]["type"];	
			$filesize=$_FILES["imgfile"]["size"];

			if ((($filetype=="image/jpeg") || ($filetype=="image/png")  || ($filetype=="image/pjpeg")) && ($filesize<200000)){
				$checker="uploads/$filename";
				extract($_POST);
				$imageLocation=$filename;
				reEnrollStudent($connect, $_GET['id'], $first_name, $last_name, $middle_name, $age, $grades, $fromTime, $toTime, $academicstatus, $paymentmode);
				$idd=$_GET['id'];

            	if(!empty($_POST['check_list'])) {
            		$xx=0;
            		foreach($_POST['check_list'] as $check) {
            			$balance = addOthers($connect, $check) -> fetch_assoc();
            			$HowsMany = $balance['price'] * $_POST['howmany'][$xx];
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
    				    }
                    } else {
    				        addBalanceDB($connect, $idd, $arrayFeeSchedule['item'], $arrayFeeSchedule['fee'], $arrayFeeSchedule['due_date']);        
                            }
                }
                unlink('uploads/'.$_GET['id']);  
                move_uploaded_file($_FILES["imgfile"]["tmp_name"], "uploads/" . $idd);
    			echo '<script>alert("Enrollment Successful");</script>';
    			header('Location:viewstudent.php?id='.$idd);
	       } else {
		          echo '<script type="text/javascript"> alert("Invalid file. Please select a file that is jpg or png.");</script>';
	               }
        } else {
	           extract($_POST);
	           $imageLocation=null;
	           reEnrollStudent($connect, $_GET['id'], $first_name, $last_name, $middle_name, $age, $grades, $fromTime, $toTime, $academicstatus, $paymentmode);
	           $idd=$_GET['id'];

	           if(!empty($_POST['check_list'])) {
                    $xx=0;
                    foreach($_POST['check_list'] as $check) {
                        $balance = addOthers($connect, $check) -> fetch_assoc();
                        $HowsMany = $balance['price'] * $_POST['howmany'][$xx];
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
        				}
		          	} else {
				            addBalanceDB($connect, $idd, $arrayFeeSchedule['item'], $arrayFeeSchedule['fee'], $arrayFeeSchedule['due_date']);        
		                  	}
                }
            echo '<script> alert("Re-enrollment Successful");</script>';
           header('Location:viewstudent.php?id='.$idd);
        }
    }

    if(isset($_POST['cancel'])){
        header('Location: viewstudent.php?id='.$_SESSION['studentfee']);
    }

    ?>
    <!--================================ crap ^ ================================!-->
    <head>
    	<title>Student Enrollment</title>
		  <link href="asd/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/init.css" type="text/css" rel="stylesheet" media="screen,projection"/>

    </head>
		 <div class="section no-pad-bot blue lighten-1" id="index-banner">
        <div class="container nav-wrapper">
	
          <h1 class="header center-on-small-only white-text">Re-enroll a Student</h1>
          <div class='row '>
            <h4 class ="header light blue-text text-lighten-4">     Fill up the form
 </h4>

  
  
 <h4 class="right-align" style="margin-top:-50px;"><a class="dropdown-button" href="#!" data-activates="dropdown1"> <i class="mdi-communication-message white-text waves-effect waves-blue"></i></a>
 
 
  <a class="dropdown-button" href="#!" data-activates="dropdown1"> <i class="mdi-action-account-box white-text waves-effect waves-blue"></i></a></h4>
 <ul id='dropdown1' class='dropdown-content'>
			<li>  <a href="logout.php">Log Out</a></li>
            <?php if($_SESSION['access_control']>1){ ?><li>  <a href="option.php">Options</a></li><?php } ?>
  </ul>
	  
	 
	 
	 
	 </ul>
 </div>
          </div>
		  </div>
		  
		  
		  <div class="container"><a href="#" data-activates="nav-mobile" class="button-collapse top-nav full"></a></div>
      <ul id="nav-mobile" class="side-nav fixed">

	   <li class="logo" style="padding-left:45px;padding-top:15px;"><image src="asdg.png"></li>
	   <div class="section"></div>
	  <div class="divider"></div><div class="section"></div>
<li class="" style="padding-top:15px;padding-bottom:15px;">	<b><a  class=" waves-effect waves-green" style="font-size:14px;" href="index.php">Cash Reports<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a  style="font-size:14px;" href="studentaccounts.php" class="waves-effect waves-green">Student Accounts<?echo"\t";?></a></li>
<li class="bold" style="padding-top:15px;padding-bottom:15px;">	<a style="font-size:14px;" href="search.php" class="waves-effect waves-green">Student List<?echo"\t";?></a></li>



<li class="" style="padding-top:15px;padding-bottom:15px;">	<a style=" font-size:14px;" href="addstudent.php" class="waves-effect waves-green">Add Student<?echo"\t";?></a></li>




   
   
   
   
   
   
   
   
   






  </ul>	
</b>
		  
		  
		  
	
	
	
	
	
	<div style="margin-left:290px;margin-right:1300px;margin-top:50px;">

	
	

    <form method="POST" enctype="multipart/form-data">
    	<div class="image-upload">
    		<label for="file-input">
    			<img src="uploads/<?=$_GET['id']?>"  height="150" width="150"/>
    		</label>
    		<input style="display: none;" id="file-input"  name="imgfile" type="file"/>
    	</div>
		
    	<input style="margin-left:170px;margin-top:-140px;" type="text" placeholder="First Name" name="first_name" pattern="[A-Za-z ]+" value="<?=$viewStudent['first_name']?>"required/></br>
    	<input style="margin-left:550px;margin-top:-140px;" type="text" placeholder="Last Name" name="last_name"  pattern="[A-Za-z]+" value="<?=$viewStudent['last_name']?>" required/></br>
    	<input style="margin-left:950px;margin-top:-140px;" type="text" placeholder="Middle Name" name="middle_name" pattern="[A-Za-z. ]+" value="<?=$viewStudent['middle_name']?>"/></br>
    	<input style="margin-left:170px;margin-top:-60px;" type="text" placeholder="Age" name="age" value="<?=$viewStudent['age']?>"/></br>
		<br>
<div class="divider"> </div><div class="divider" style="position:relative;left: 300px;top:-1px;"> </div><div class="divider" style="position:relative;left: 600px;top:-2px;"> </div>
<div class="divider" style="position:relative;left: 900px;top:-3px;"> </div><div class="divider" style="position:relative;left: 1200px;top:-4px;"> </div>

    	<p class="blue-text text lighten-2" style="font-weight:bold;">Grade:</p>
    	<select name="grades" id="grades">
    		<?php
    		$checkGradesTable = viewGrade($connect);
    		while ($arrayGradesTable = mysqli_fetch_array($checkGradesTable, MYSQLI_ASSOC)) {
    			$grade_level=$arrayGradesTable["grade_levels"];
    			echo "<option value=\"$grade_level\">$grade_level</option>";        
    		}
    		?>
    	</select></br>
		<div style="position: relative;left: 350px;top: -143px;">
    	<p class="blue-text text lighten-2" style="font-weight:bold;">From:</p>
    	<select name="fromTime">
    		<?php
    		$checkTimeTable = getTimeDB($connect);
    		while($arrayTimeTable=mysqli_fetch_array($checkTimeTable, MYSQLI_ASSOC)){
    			$time = $arrayTimeTable["time"];
    			echo"<option value=\"$time\">$time</option>";
    		}
    		?>
    	</select></div>
		<div style="position: relative;left: 700px;top: -249px;">
    	<p class="blue-text text lighten-2" style="font-weight:bold;">To:</p>
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
    	<p class="blue-text text lighten-2" style="font-weight:bold;">Academic Status:</p>
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
    	<p class="blue-text text lighten-2" style="font-weight:bold;">Payment Mode:</p>
    	<select name="paymentmode">
    		<?php
    		$checkPaymentModeTable=getPaymentModeDB($connect);
    		while($arrayPaymentModeTable=mysqli_fetch_array($checkPaymentModeTable, MYSQLI_ASSOC)){
    			$mode=$arrayPaymentModeTable["mode"];
    			echo"<option value=\"$mode\">$mode</option>";
    		}
    		?>
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
<button class="btn waves-effect waves-light green" type="submit" name="submit" value="Enroll" onclick="return confirm('Are you sure?');" style="position:relative;bottom:450px;left:300px;">Enroll</button>
<button class="btn waves-effect waves-light green" type="submit" name="cancel" value="cancel" onclick="return confirm('Are you sure?');" style="position:relative;bottom:450px;left:300px;">Cancel</button>


</form>
</div>
<?php
include("footer.php");
?>
    <script src="http://www.gstatic.com/external_hosted/picturefill/picturefill.min.js"></script>
  <script src="asd/js/materialize.js"></script>
  <script src="asd/js/init.js"></script>
  
  