<?php
	/*
This script is use to upload any Excel file into database.
Here, you can browse your Excel file and upload it into 
your database.

Download Link: http://www.discussdesk.com/import-excel-file-data-in-mysql-database-using-PHP.htm

Website URL: http://www.discussdesk.com
*/
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Demo - Import Excel file data in mysql database using PHP, Upload Excel file data in database</title>
<meta name="description" content="This tutorial will learn how to import excel sheet data in mysql database using php. Here, first upload an excel sheet into your server and then click to import it into database. All column of excel sheet will store into your corrosponding database table."/>
<meta name="keywords" content="import excel file data in mysql, upload ecxel file in mysql, upload data, code to import excel data in mysql database, php, Mysql, Ajax, Jquery, Javascript, download, upload, upload excel file,mysql"/>
</head>
<body>

<?php
/************************ YOUR DATABASE CONNECTION START HERE   ****************************/

define ("DB_HOST", "localhost"); // set database host
define ("DB_USER", "gloria"); // set database user
define ("DB_PASS","1234"); // set database password
define ("DB_NAME","excel"); // set database name

$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");

$databasetable = "students";

/************************ YOUR DATABASE CONNECTION END HERE  ****************************/


set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
include 'PHPExcel/IOFactory.php';

// This is the file path to be uploaded.
$inputFileName = 'StudentExcelRecord.xlsx'; 

try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}


$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet


for($i=2;$i<=$arrayCount;$i++){
$student_id = trim($allDataInSheet[$i]["A"]);
$first_name = trim($allDataInSheet[$i]["B"]);
$last_name = trim($allDataInSheet[$i]["C"]);
$middle_name = trim($allDataInSheet[$i]["D"]);
$age = trim($allDataInSheet[$i]["E"]);
$grade = trim($allDataInSheet[$i]["F"]);
$fromTime = trim($allDataInSheet[$i]["G"]);
$toTime = trim($allDataInSheet[$i]["H"]);
$academicstatus = trim($allDataInSheet[$i]["I"]);
$paymentmode = trim($allDataInSheet[$i]["J"]);

$query = "SELECT first_name,last_name FROM students WHERE first_name = '$first_name' AND last_name = '$last_name'";
$sql = mysql_query($query);
$recResult = mysql_fetch_array($sql);
$existName = $recResult["first_name"];
if($existName=="") {
$insertTable= mysql_query("insert into students (student_id, first_name, last_name, middle_name, age, grade, fromTime, toTime, academicstatus,paymentmode) values('$student_id', '$first_name', '$last_name', '$middle_name', '$age', '$grade', '$fromTime', '$toTime', '$academicstatus', '$paymentmode');");
$msg = 'Record has been added. <div style="Padding:20px 0 0 0;"><a href="">Go Back to tutorial</a></div>';
} else {
$msg = 'Record already exist. <div style="Padding:20px 0 0 0;"><a href="">Go Back to tutorial</a></div>';
}
}
echo "<div style='font: bold 18px arial,verdana;padding: 45px 0 0 500px;'>".$msg."</div>";
 

?>
<body>
</html>