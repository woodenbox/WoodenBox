<?php

$user = $_SESSION['username'];


	
$view_msg=viewmsg($connect);


	function viewmsg($connect){
		$user = $_SESSION['username'];
		$sql="SELECT * FROM private_messages WHERE to_user='$user'";
		$return=mysqli_query($connect,$sql);
		return $return;
	}

			while($rows = mysqli_fetch_assoc($view_msg)) {
				$id = $rows['id'];
				$to_user = $rows['to_user']; 
				?>

<div style="padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bototm: 5px;">

<?php
			
				
				?><h6 class="black-text"><b><?=$from = $rows['from_user']?></b>
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<i style="font-size:12px;"><?=$date = $rows['date']?></i></h6>
				<?php
				
				

				
				echo "".$message = $rows['message']."<br>";
			?>
				<a href='compose.inc.php' class="blue-text">Reply Message</a>
		



		
				<div class="divider"></div>
				</div><?php
	
	if($to_user==$user) {
		$up = mysql_query("
		
		UPDATE haha SET read='1' WHERE id='$id'
		
		");
	
	
} else {
	echo "";
}

}
?>