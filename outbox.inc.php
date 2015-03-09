<?php



$user = $_SESSION['username'];


$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("woodenbox_contents") or die(mysql_error());

$view_msg = mysql_query("

SELECT * FROM private_messages WHERE from_user='$user'

");

$row = mysql_num_rows($view_msg);
	
	
if($row!=0) {
	echo "<table>";
	echo "<tr>";
	echo "<td>";
	echo "</td>";
	echo "<td>From:</td>";
	echo "<td>Subject:</td>";
	echo "<td>Date:</td>";
	echo "</tr>";
	
   while($row = mysql_fetch_assoc($view_msg)) {
	   $id = $row['id'];
	   echo "<tr>";
	   echo "<td>&nbsp;</td>";
	   echo "<td>".$from = $row['from_user']."</td>";
	   echo "<td><a href='messages.php?id=read2&mid=$id'>".$subject = $rows['subject']."</a></td>";
	   echo "<td>".$date = $row['date']."</td>";
	   echo "</tr>";
	   
   }
   
   
} else {
	echo "<table><tr align='left'><td> </td><td>From:</td><td>Subject:</td><td>Date:</td></tr><tr><th colspan='4'>You didn't send a message</th></tr></table>";
	echo "</table>";
}





?>