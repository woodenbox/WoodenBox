<?php
$q = $_GET['q'];

$con = mysqli_connect('localhost','gloria','1234','woodenbox_contents');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"woodenbox_contents");
echo $q;
$sql="SELECT * FROM fee_payment WHERE sy = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
<th>Age</th>
<th>Hometown</th>
<th>Job</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['first_name'] . "</td>";
    echo "<td>" . $row['ar'] . "</td>";
    echo "<td>" . $row['last_name'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
