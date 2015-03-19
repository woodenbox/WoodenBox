<?php

	/*
This script is use to upload any Excel file into database.
Here, you can browse your Excel file and upload it into 
your database.

Download Link: http://www.discussdesk.com/import-excel-file-data-in-mysql-database-using-PHP.htm

Website URL: http://www.discussdesk.com
*/
session_start();
include('../processes/process.php');
$connect=connectDB();
$uploadedStatus = 0;

if ( isset($_POST["submit"]) ) {
if ( isset($_FILES["file"])) {
//if there was an error uploading the file
if ($_FILES["file"]["error"] > 0) {
echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
}
else {
if (file_exists($_FILES["file"]["name"])) {
unlink($_FILES["file"]["name"]);
}
$storagename = "discussdesk.xlsx";
move_uploaded_file($_FILES["file"]["tmp_name"],  $storagename);
$uploadedStatus = 1;
}
} else {
echo "No file selected <br />";
}
}

$header="Add Student";
$header2="Import an excel file"
?>



<html>

<head>
<title>Demo - Import Excel file data in mysql database using PHP, Upload Excel file data in database</title>
<meta name="description" content="This tutorial will learn how to import excel sheet data in mysql database using php. Here, first upload an excel sheet into your server and then click to import it into database. All column of excel sheet will store into your corrosponding database table."/>
<meta name="keywords" content="import excel file data in mysql, upload ecxel file in mysql, upload data, code to import excel data in mysql database, php, Mysql, Ajax, Jquery, Javascript, download, upload, upload excel file,mysql"/>


  <link href="../asd/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../asd/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../asd/css/pagination.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../asd/css/prism.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <script src="jquery-2.1.3.min.js"></script>
<link rel="shortcut icon" href="box.ico">
</head>


  <div class="section no-pad-bot blue lighten-1 hide-on-small-only" id="index-banner" style="position: relative;width: 100%;height: 186px; left: 0%;">
        <div class="container nav-wrapper">
		
	<!-- Welcome <?php echo $getUserRow['first_name'] ." ". $getUserRow['last_name']?> !-->


          <h2 style="padding-left:2%;" class="header center-on-small-only white-text hide-on-small-only">	<?=$header?></h1>
          <div class='row '>
            <h5 style="padding-left:2%;" class ="header light blue-text text-lighten-4 hide-on-small-only">  <?=$header2?>




            	   <div style="float:right;">
  
 <h4 style="position: relative;width: 100%;top: 0; left: 0%;">

 <a class="dropdown-button" href="#!" data-activates="dropdown2" style="position: relative;width: 100%;top: 0; left: 0%;"> <i class="mdi-communication-message white-text waves-effect waves-blue"></i></a>
 
  <a class="dropdown-button" href="#!" data-activates="dropdown1" style="position: relative;width: 100%;top: 0; left: 0%;"> <i class="mdi-action-account-box white-text waves-effect waves-blue"></i></a></h4>
 <ul id='dropdown1' class='dropdown-content'>
			<li>  <a href="../logout.php">Log Out</a></li>
			<?php if($_SESSION['access_control']>1){ ?><li>  <a href="option.php">Options</a></li><?php } ?>
  </ul>
  
   <ul id='dropdown2' class='dropdown-content'>

<li>
<a href="../compose.inc.php">Compose</a>
</li>

<div style="padding:5px;font-size:75%;">
<?php include('../read.inc.php'); ?>
</div>  
<li>
<a href="../inbox.inc.php">Read all messages</a>
</li>
<div class="divider"></div>







  </ul>
	  
	 
	 
	 
	</div>
 </h4>


 </div>
          </div>
		  </div>	


<div class="container"><a href="#" data-activates="nav-mobile" class="button-collapse top-nav full" style="position: fixed;"></a></div>
      <ul id="nav-mobile" class="side-nav fixed">

     <li class="logo" style="padding-left:25px;padding-top:40px;"><image src="asdg.png" style="position:relative;width:85%;" onclick="toast('Huehue', 400)" style="background-size:100%;"></li>
     <div class="section"></div>  
     <div class="divider valign" style="width: 90%;position:relative;left:5%;"></div>
  
<b>

<li <?php if(curPageName()=='index.php') echo "class=\"blue lighten-1 waves-effect waves-white\""; else echo "class=\"waves-effect waves-white\""; ?> style="padding-top:15px;padding-bottom:15px; width:100%;">  <a  <?php if(curPageName()=='index.php') echo "class=\"white-text waves-effect waves-green\"";?> style="font-size:80%;" href="../index.php"><i class="mdi-communication-business"></i>&nbspCash Reports<?echo"\t";?></a></li>
<li <?php if(curPageName()=='studentaccounts.php') echo "class=\"blue lighten-1 waves-effect waves-white\""; else echo "class=\"waves-effect waves-white\""; ?> style="padding-top:15px;padding-bottom:15px; width:100%;"> <a  style="font-size:80%;" href="../studentaccounts.php"<?php if(curPageName()=='studentaccounts.php') echo "class=\"white-text waves-effect waves-green\"";?> ><i class="mdi-action-account-child"></i>&nbspStudent Accounts<?echo"\t";?></a></li>
 



<li <?php if(curPageName()=='search.php') echo "class=\"blue lighten-1 waves-effect waves-white\""; else echo "class=\"waves-effect waves-white\""; ?> style="padding-top:15px;padding-bottom:15px;width:100%;"> <a style="font-size:80%;" href="../search.php"<?php if(curPageName()=='search.php') echo "class=\"white-text waves-effect waves-green\"";?> ><i class="mdi-action-view-list"></i>&nbspStudent List<?echo"\t";?></a></li>

<li <?php if(curPageName()=='addstudent.php') echo "class=\"blue lighten-1 waves-effect waves-white\""; else echo "class=\"waves-effect waves-white\";" ?> style="padding-top:15px;padding-bottom:15px; width:100%;"> <a style="font-size:80%;" href="../addstudent.php"<?php if(curPageName()=='addstudent.php') echo "class=\"white-text waves-effect waves-green\"";?> ><i class="mdi-social-person-add"></i>&nbspAdd Student<?echo"\t";?></a></li>


  </ul> 
</b>

















<div style="position: relative;width: 80%;bottom: -4%; left: -18%;">

<table width="600">

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">

<tr>

<td width="50%" style="font:bold 12px tahoma, arial, sans-serif; text-align:right; border-bottom:1px solid #eee; padding:5px 10px 5px 0px; border-right:1px solid #eee;">Select file</td>

<td width="50%" style="border-bottom:1px solid #eee; padding:5px;"><input type="file" name="file" id="file" /></td>

</tr>





<tr>

<td style="font:bold 12px tahoma, arial, sans-serif; text-align:right; padding:5px 10px 5px 0px; border-right:1px solid #eee;">Submit</td>

<td width="50%" style=" padding:5px;"><input type="submit" name="submit" /></td>

</tr>

</table>

<?php if($uploadedStatus==1){

echo "<table style='position:relative; left:5%; top:5%;' align='center'><tr><td  ><center><b>File Uploaded<b/> </center></td></tr>";

echo "<tr><td ><center> <b>Do you want to upload the data <a href='index.php'>Yes</a> <a href='../addstudents.php'>No</a> </b></center></td></tr></table>";

}?>



</form>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38304687-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>



    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../asd/js/materialize.js"></script>
  <script src="../asd/js/init.js"></script>