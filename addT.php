<?php
session_start();
	include('processes/process.php');

	$header="Add";
	$header2="Add a time";
	include('header.php');
	$connect=connectDB();
	if(isset($_POST['add'])){
		$t1=$_POST['time'];
		$time=$t1." ".$_POST['tod'];
			$add=addTime($connect,$time);
			if($add){
			?><p style="position:relative;left: 15%;">Added successfully</p>
			<?php
			}
			else{
			?><p style="position:relative;left: 15%;">Failed to add"</p>
			<?php
			}
	 
	}

?>
<div style="position: relative;width: 80%;bottom: -2%; left: 16%;">


<form method="POST">

			Time<br>
			<input style="width:7.5%;" type="text" name="time" value="hh:mm"/>
			<div  style="width:7.5%;">
			<select name="tod">
				<option value="am">am</option>
				<option value="pm">pm</option>
			</select></div>
					<button class="btn waves-effect waves-light blue lighten-2 white-text" type="submit" name="add" value="Add Record"/>Add Record</button>


				<button class="btn waves-effect waves-light blue lighten-2 white-text" type="reset" name="clear" value="Clear"/>Clear</button></td>
			
	
					<button class="btn waves-effect waves-light blue lighten-2 white-text" href="option.php">Back</button></form>
</div>
