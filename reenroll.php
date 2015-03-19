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
				reEnrollStudent($connect, $_GET['id'], $first_name, $last_name, $middle_name, $age, $grades, $fromTime, $toTime, $academicstatus, $paymentmode,$sy);
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
	           reEnrollStudent($connect, $_GET['id'], $first_name, $last_name, $middle_name, $age, $grades, $fromTime, $toTime, $academicstatus, $paymentmode,$sy);
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
$active = 0;
    $selectSY=mysqli_fetch_assoc(selectSY($connect));
        ?>



    <?php $header = "Re-enroll"?>
    <?php $header2 =  "Re-ehroll a student";

    include('header.php');?>

    <!--================================ crap ^ ================================!-->
    <head>
    	<title>Student Enrollment</title>
		  <link href="asd/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/init.css" type="text/css" rel="stylesheet" media="screen,projection"/>

    </head>

	
	
	
	
<div style="position: relative;width: 80%;bottom: -2%; left: 16%;">
	
	
<div class="row">
    <form method="POST" enctype="multipart/form-data" class="col s12">
        <div class="row">
    	<div class="image-upload">
    		<label for="file-input" style="float:left;">
    			<img src="uploads/<?=$_GET['id']?>"  height="150" width="150"/>
    		</label>
    		<input style="display: none;" id="file-input"  name="imgfile" type="file"/>

      <div class="input-field col s3" style="">
        <input id="first_name" type="text" name="first_name" pattern="[A-Za-z ]+" class="validate" value="<?=$viewStudent['first_name']?>"required>
        <label for="first_name">First Name</label>
      </div>


       <div class="input-field col s3" style="">
        <input id="middle_name" type="text" name="middle_name" pattern="[A-Za-z ]+" class="validate" value="<?=$viewStudent['middle_name']?>"required>
        <label for="middle_name">Middle Name</label>
      </div>
 

               <div class="input-field col s3" style="">
        <input id="last_name" type="text" name="last_name" pattern="[A-Za-z ]+" class="validate" value="<?=$viewStudent['last_name']?>"required>
        <label for="last_name">Middle Name</label>
            <input id="sy" type="text" name="sy" value="<?=$selectSY['from']?> - <?=$selectSY['to']?>" pattern="[2][0][1-9][0-9][ ][-][ ][2][0][0-9][0-9]">
    <label for="sy" style="font-size:75%;">School Year</label>
      </div>
 


  </form>
</div>

<br><BR>
</div>




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
    
        <p class="blue-text lighten-2" style="font-weight:bold;font-size:85%;"> To:</p>
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
                    <div style="position:relative;bottom:392px;font-weight:bold;left: 250px;" class="blue-text text lighten-2"> Price</div>
                    <div style="position:relative;bottom:412px;font-weight:bold;left: 350px;" class="blue-text text lighten-2">Quantity     </div>  

            <?php   
            $table=getOthers($connect);
            while($row=mysqli_fetch_assoc($table)){
                ?>
                
            
        
            </table>
                    <input type="checkbox" id="<?=$row['id']?>"  name="check_list[]" value="<?=$row['id']?>"  />
                    <label for="<?=$row['id']?>"style="position:relative;left:00px;bottom:400px;"><?=$row['item']?></label>
                    <p style="position:relative;left:250px;bottom:445px;"><?=$row['price']?></p>
                    

                     <div class="input-field col s4 m12"  style="position:relative;left:300px;bottom:510px;left:350px;">
                                             <input id="enter_amount" type="text" class="validate" name="howmany[]" pattern="[0-9]" style="width:12%;"  >
                                                    <label for="enter_amount">Enter Amount</label>


                     </div>
            <!--   <input style="position:relative;left:300px;bottom:500px;left:350px;"type="text" placeholder="Enter Amount"  pattern="[0-9]" name="howmany[]"/>       !-->

                    
                <?php   
            }
            ?><br><br><br>
    <input class="btn waves-effect waves-light green" type="submit" name="submit" value="Enroll" onclick="return confirm('Please check details before continuing?');" style="position:relative;left:0%;bottom: 490px;">





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
  
  