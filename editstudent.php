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
      </div>
 


  </form>
</div>

            <div class="input-field col s3" style="">
        <input id="age" type="text" name="age" pattern="[A-Za-z ]+" class="validate" value="<?=$viewStudent['age']?>"required>
        <label for="age">Age</label>
      </div>
 </div>



    	<div style="position: relative; top: 400px;">
    	<table name="options_others">
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
    			 <div class="input-field col s4 m12"  style="position:relative;bottom:510px;left:570px;">
                                             <input id="enter_amount" type="text" class="validate" name="howmany[]" pattern="[0-9]" style="width:12%;"  >
                                                    <label for="enter_amount">Enter Amount</label>


                     </div>
    				
    			<?php	
    		}
    		?>










    
    	</table>
		</div>
   



    	<script src="jquery-2.1.3.min.js"></script>
    	<script>
        </script>
<button class="btn waves-effect waves-light green" type="submit" name="submit" value="Save">Save</button>
<button class="btn waves-effect waves-light green" type="submit" name="cancel" value="Cancel">Cancel</button>
</form>

<?php
include("footer.php");
?>
</div>
  <script src="http://www.gstatic.com/external_hosted/picturefill/picturefill.min.js"></script>
  <script src="asd/js/materialize.js"></script>
  <script src="asd/js/init.js"></script>
  
  