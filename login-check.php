<?php

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("woodenbox_contents") or die(mysql_error());

$logcheck = mysql_query("

SELECT * FROM users WHERE username='$username'

");

$nrow = mysql_num_rows($logcheck);

if($nrow!=0) {
	while($rows = mysql_fetch_assoc($logcheck)) {
		$dbusername = $rows['username'];
		$dbpassword = $rows['password'];
	}
	if($username==$dbusername&&$password==$dbpassword) {
		header("Location: http://localhost/woodenbox/messages.php");
		$_SESSION['username']=$username;
} else {
	header("Location: http://localhost/woodenbox/index2.php");
}

} else {
	header("Location: http://localhost/woodenbox/index2.php");
}
?>