<?php

$user = $_SESSION['username'];

$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("private_messages") or die(mysql_error());

$view_msg = mysql_query("

SELECT * FROM private_messages WHERE to_user='$user'

");

$row = mysql_num_rows($view_msg);

if($row!=0) {
	echo "
	
} else {

}


?>