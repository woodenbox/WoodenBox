<?php

$user = $_SESSION['username'];

$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("woodenbox_contents") or die(mysql_error());

$view_msg = mysql_query("

SELECT * FROM private_messages WHERE to_user='$user'

");

$row = mysql_num_rows($view_msg);

if($row!=0) {
	echo "
		<table>
		<tr>
		";
			while($rows = mysql_fetch_assoc($view_msg)) {
				echo "<td>";
				echo "".$from = $rows['from_user']."";
				echo "</td>";
				$id = $rows['id'];
				$to_user = $rows['to_user']; 
				echo "<td>";
				echo "From:";
				echo "</td>:";
				echo "</tr>";
				echo "<tr>";
				echo "<td>";
				echo "Subject:";
				echo "</td>";
				echo "<td>";
				echo "".$subject = $rows['subject']."";
				echo "</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>";
				echo "Message:";
				echo "</td>";
				echo "<td>";
				echo "".$message = $rows['message']."";
				echo "</td>";
				echo "</tr>";
				
}
	echo "<tr>";
	echo "<td colspan='2'><a href='messages.php?id=compose&mid=$id&subject=RE:$subject&to=$from'>Reply Message</a></td>";
	echo "</tr>";
	echo "</table>";
	
	
	if($to_user==$user) {
		$up = mysql_query("
		
		UPDATE private_messages SET read='1' WHERE id='$id'
		
		");
	
	
} else {
	echo "";
}

}
?>