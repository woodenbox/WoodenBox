<?php

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);


$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("woodenbox_contents") or die(mysql_error());



$subject1 = $_REQUEST['subject'];
$to_user1 = $_REQUEST['to'];
$user = $_SESSION['username'];



$submit = $_POST['submit'];
$to_user = $_POST['to_user'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$date = date("Y/m/d");

$to_user = mysql_real_escape_string($to_user);
$subject = mysql_real_escape_string($subject);
$message = mysql_real_escape_string($message);



if($submit) {
	
	if(!$to_user) {
		echo "<b>Please enter a user to send the message</b>";
	}
	
	if(!$subject) {
		echo "<b>Please enter a subject!</b>";
	}
	
	if(!$message) {
		echo "<b>Please enter a message!</b>";
	}
	
if($to_user&&$subject&&$message) {
	
	$query = mysql_query("
	
		INSERT INTO private_messages VALUES('','$user','$to_user','$subject','$message','$date','0');
		
	");
	
	
	echo "<b>Your message was successfully sent!";
	
} else {
	echo "<b>Please put all information in </b>!";
}

}



echo "
<form action='' method='POST'>
<table>
<tr>
<td>To:</td>
<td><input type='text' name='to_user'  value='$to_user1' /></td>
</tr>
<tr>
<td>Subject:</td>
<td><input type='text' name='subject' value='$subject1' /></td>
</tr>
<tr>
<td>Message:</td>
<td><textarea name='message' cols='50' rows='10'></textarea></td>
</tr>
<tr>
<td colspan='2'><input type='submit' name='submit' value='Send Message' /></td>
</tr>
</table>
</form>
";



?>