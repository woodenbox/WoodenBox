<?php
    session_start();
    include('processes/process.php');
    $connect = connectDB();
    $checkStudent = viewStudentAccount($connect, $_GET['id']);
    $viewStudent = mysqli_fetch_assoc($checkStudent);
    $datengayon = date('Y-m-d');
    $selectSY=mysqli_fetch_assoc(selectSY($connect));
    $yeye=$selectSY['from']." - ".$selectSY['to'];

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
                    reEnroll($connect, $_GET['id'], $age, $grade, $fromTime, $toTime, $academicstatus, $paymentmode, $yeye);
                    $idd=$_GET['id'];
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
            reEnroll($connect, $_GET['id'], $age, $grade, $fromTime, $toTime, $academicstatus, $paymentmode, $yeye);
            $idd= $_GET['id'];
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
            header('Location:viewstudent.php?id='.$idd);
            echo '<script> alert("Enrollment Successful");</script>';
        }
    }
    $header = "Re-enroll";
    $header2 =  "Re-enroll a Student";
    include('header.php');
?>
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
    <!-- VVVVVSENSITIVE TONG PART NA TO WAG MO MASYADO GALAWINVVVVV !-->
    <div class="col s3 tooltipped" style="float:right;" data-position="bottom" data-delay="50" data-tooltip="Click to upload a picture">
    <div class="image-upload">
        <label for="file-input">
            <img src="uploads/imagethumbnail.png"  height="150" width="150"/>
        </label>
        <input style="display: none;" id="file-input"  name="imgfile" type="file"/>
    </div>
    </div>
    <!-- ^^^^^ SENSITIVE TONG PART NA TO WAG MO MASYADO GALAWIN ^^^^^!-->
    <div class="input-field col s3 tooltipped"  data-position="top" data-delay="50" data-tooltip="Student's First Name">
    <input id="first_name" type="text" name="first_name"  value="<?=$viewStudent['first_name']?>" pattern="[A-Za-z ]+" disabled >
    <label for="first_name" style="font-size:75%;">First Name</label>
    </div>

    <div class="input-field col s3 tooltipped"  data-position="top" data-delay="50" data-tooltip="Student's Middle Name">
    <input id="middle_name" type="text" name="middle_name" p value="<?=$viewStudent['middle_name']?>" attern="[A-Za-z. ]+" disabled>
    <label for="middle_name" style="font-size:75%;">Middle Name</label>
    </div>

    <div class="input-field col s3 tooltipped"  data-position="top" data-delay="50" data-tooltip="Student's Last Name">
    <input id="last_name" type="text" name="last_name"  value="<?=$viewStudent['last_name']?>" pattern="[A-Za-z ]+" disabled>
    <label for="last_name" style="font-size:75%;">Last Name</label>
    </div>

    <div class="row">
        <div class="input-field col s3 tooltipped"  data-position="top" data-delay="50" data-tooltip="Student's Age">
    <input id="age" type="text" name="age" pattern="[0-9]+"  value="<?=$viewStudent['age']?>" required>
    <label for="age" style="font-size:75%;">Age</label>
        </div>

        <div class="input-field col s3  tooltipped"  data-position="top" data-delay="50" data-tooltip="Enter school year">
    <input id="sy" type="text" name="sy" value="<?=$selectSY['from']?> - <?=$selectSY['to']?>" pattern="[2][0][1-9][0-9][ ][-][ ][2][0][0-9][0-9]">
    <label for="sy" style="font-size:75%;">School Year</label>
    </div></div>
    <div class="divider"></div>
<div class="row">
    <div class="input-field col s2  tooltipped"  data-position="top" data-delay="50" data-tooltip="Student's Grade Level">
    <p>Grade:</p>
    <select name="grades" id="grades">
<?php
        $checkGradesTable = viewGrade($connect);
        while ($arrayGradesTable = mysqli_fetch_array($checkGradesTable, MYSQLI_ASSOC)) {
            $grade_level=$arrayGradesTable["grade_levels"];
            echo "<option value=\"$grade_level\">$grade_level</option>";        
        }
?>
        <!--this!-->
    </select></div>


<div class="input-field col s2  tooltipped"  data-position="top" data-delay="50" data-tooltip="Start of class">
    <p>From:</p>
    <select name="fromTime">
<?php
        $checkTimeTable = getTimeDB($connect);
        while($arrayTimeTable=mysqli_fetch_array($checkTimeTable, MYSQLI_ASSOC)){
            $time = $arrayTimeTable["time"];
            echo"<option value=\"$time\">$time</option>";
        }
?>
    </select></div>
    <div class="input-field col s2 tooltipped"  data-position="top" data-delay="50" data-tooltip="Dismissal">
    <p>To:</p>
    <select name="toTime">
<?php
        $checkTimeTable2 = getTimeDB($connect);
        while($arrayTimeTable=mysqli_fetch_array($checkTimeTable2, MYSQLI_ASSOC)){
            $time = $arrayTimeTable["time"];
            echo"<option value=\"$time\">$time</option>";
        }
?>
            
    </select></div></div>
    <div class="divider"></div>
<div class="row">
<div class="input-field col s3  tooltipped"  data-position="top" data-delay="50" data-tooltip="Student's Academic Status">

    <p>Academic Status:</p>
    <select name="academicstatus">
<?php
        $checkAcademicStatusTable = getAcademicStatusDB($connect);
        while($arrayAcademicTable=mysqli_fetch_array($checkAcademicStatusTable, MYSQLI_ASSOC)){
            $status=$arrayAcademicTable["status"];
            echo"<option value=\"$status\">$status</option>";
        }
?>
    </select></div>
    <div class="input-field col s3 tooltipped"  data-position="top" data-delay="50" data-tooltip="How will payment be processed">
    <p>Payment Mode:</p>
    <select name="paymentmode">
<?php
        $checkPaymentModeTable=getPaymentModeDB($connect);
        while($arrayPaymentModeTable=mysqli_fetch_array($checkPaymentModeTable, MYSQLI_ASSOC)){
            $mode=$arrayPaymentModeTable["mode"];
            echo"<option value=\"$mode\">$mode</option>";
        }
?>
    </select></div></div><div class="divider"></div>
    <table>
<tr>
<td style="position:relative; left:14%;">
    Item
</td>
<td style="position:relative; left:14%;">
    Price
</td>
<td>
    Quantity
</td>
</tr>
</table>
<table>
<?php   
    $table=getOthers($connect);
    while($row=mysqli_fetch_assoc($table)){
?>

        <tr>
        <td><input type="checkbox" id="<?=$row['id']?>"  name="check_list[]" value="<?=$row['id']?>"  />

        <label for="<?=$row['id']?>"><?=$row['item']?></label>
<td>
    <?=$row['price']?>      
</td>
<td>
            <input id="enter_amount" type="text" class="validate" name="howmany[]" pattern="[0-9]" style="width:12%;"   >
            <label for="enter_amount">Enter Amount</label>
</td>
        </td></tr>
    

<?php   
    }
?>

</table>
    <button class="btn waves-effect waves-light blue lighten-2 white-text" type="submit" name="submit" value="Enroll" onclick="return confirm('Please check details before continuing?');">Enroll</button>
</div>

</form>
</div>
<script src="http://www.gstatic.com/external_hosted/picturefill/picturefill.min.js"></script>
<script src="asd/js/materialize.js"></script>
<script src="asd/js/init.js"></script>
  
<?php
    include("footer.php");
?>
