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
				updateStudent($connect, $_GET['id'], $first_name, $last_name, $middle_name, $age);
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
                unlink('uploads/'.$_GET['id']);  
                move_uploaded_file($_FILES["imgfile"]["tmp_name"], "uploads/" . $idd);
                header('Location:viewstudent.php?id='.$idd);
	       } else {
		              echo '<script type="text/javascript"> alert("Invalid file. Please select a file that is jpg or png.");</script>';
                    }
        } else {
                extract($_POST);
                updateStudent($connect, $_GET['id'], $first_name, $last_name, $middle_name, $age);
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
           header('Location:viewstudent.php?id='.$idd);
        }
    }

    if(isset($_POST['cancel'])){
        header('Location: viewstudent.php?id='.$_GET['id']);
    }
	if(isset($_POST['submit'])){
		extract($_POST);
		insertOtherRecords($connect, $_GET['id'], $grade_level, $quarter, $average);
		header('Location: viewstudent.php?id='.$_GET['id']);
	}

	if(isset($_POST['return'])){
		header('Location: viewstudent.php?id='.$_GET['id']);
	}
    $active = 0;
?>



    <?php $header = "Edit" ;?>
    <?php $header2 =  "Edit Student";

    include('header.php');?>





<head>
    <title>Edit Student</title>
	 <link href="asd/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="asd/css/init.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>



value="<?=$viewStudent['first_name']?>
uploads/<?=$_GET['id']?>

    
    
<div style="position: relative;width: 80%;bottom: -2%; left: 16%;">

<div class="row">
<form method="POST" enctype="multipart/form-data" class="col s12">
<div class="row">
    <!-- VVVVVSENSITIVE TONG PART NA TO WAG MO MASYADO GALAWINVVVVV !-->
    <div class="col s3 tooltipped" style="float:right;" data-position="bottom" data-delay="50" data-tooltip="Click to upload a picture">
    <div class="image-upload">
        <label for="file-input">
            <img class="z-depth-1"  src="uploads/<?=$_GET['id']?>"  height="150" width="150"/>
        </label>
        <input style="display: none;" id="file-input"  name="imgfile" type="file"/>
    </div>
    </div>
    <!-- ^^^^^ SENSITIVE TONG PART NA TO WAG MO MASYADO GALAWIN ^^^^^!-->
    <div class="input-field col s3 tooltipped"  data-position="top" data-delay="50" data-tooltip="Student's First Name">
    <input  id="first_name" type="text" name="first_name" pattern="[A-Za-z ]+" value="<?=$viewStudent['first_name']?>" required >
    <label for="first_name" style="font-size:75%;">First Name</label>
    </div>

    <div class="input-field col s3 tooltipped"  data-position="top" data-delay="50" data-tooltip="Student's Middle Name">
    <input id="middle_name" type="text" name="middle_name" pattern="[A-Za-z. ]+" value="<?=$viewStudent['middle_name']?>" required>
    <label for="middle_name" style="font-size:75%;">Middle Name</label>
    </div>

    <div class="input-field col s3 tooltipped"  data-position="top" data-delay="50" data-tooltip="Student's Last Name">
    <input id="last_name" type="text" name="last_name" pattern="[A-Za-z ]+" value="<?=$viewStudent['last_name']?>" required>
    <label for="last_name" style="font-size:75%;">Last Name</label>
    </div>

    <div class="row">
        <div class="input-field col s3 tooltipped"  data-position="top" data-delay="50" data-tooltip="Student's Age">
    <input id="age" type="text" name="age" pattern="[0-9]+" value="<?=$viewStudent['age']?>" required>
    <label for="age" style="font-size:75%;">Age</label>
        </div>
 </div></div></div>



    
  <div class="divider"> </div>
  <br>


    <table>
<tr>
<td style="position:relative; left:7%;">
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
<td style="position:relative; right:1.5%;">
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
    <button class="btn waves-effect waves-light blue lighten-2 white-text" type="submit" name="submit" value="Submit" onclick="return confirm('Please check details before continuing?');">Save</button>
    <button class="btn waves-effect waves-light blue lighten-2 white-text" type="submit" name="cancel" value="Cancel">Cancel</button>


</form>
</div>
<?php
include("footer.php");
?>
</div>
  <script src="http://www.gstatic.com/external_hosted/picturefill/picturefill.min.js"></script>
  <script src="asd/js/materialize.js"></script>
  <script src="asd/js/init.js"></script>
  
  