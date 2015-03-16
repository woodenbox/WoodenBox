<?php

$user = $_SESSION['username'];
$connect = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("woodenbox_contents") or die(mysql_error());
 
$view_msg = mysql_query("

SELECT * FROM private_messages WHERE to_user='$user'

");

$asd = mysql_num_rows($view_msg);

if($asd!=0) {





			while($rows = mysql_fetch_assoc($view_msg)) {
				$id = $rows['id'];
				$to_user = $rows['to_user']; 
				?>
<div style="padding-right: 5px;padding-left: 5px;padding-top: 5px;padding-bototm: 5px;">

<?php
			
				
				?><h6 class="black-text"><b><?=$from = $rows['from_user']?></b>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <i style="font-size:12px;"><?=$date = $rows['date']?></i></h6>
				<?php
				
				

				
				echo "".$message = $rows['message']."<br>";
			?>
				<a href='#messages' class="blue-text modal-trigger">Reply Message</a>
				  <div id="messages" class="modal">
    <div class="modal-content">

	
	<?php include('msg/compose.inc.php');?>
	
	
	
    </div>
   
  </div>
				<div class="divider"></div>
				</div>
				<?php
}
	

	
	
	
	if($to_user==$user) {
		$up = mysql_query("
		
		UPDATE private_messages SET read='1' WHERE id='$id'
		
		");
	
	
} else {
	echo "";
}

}
?>