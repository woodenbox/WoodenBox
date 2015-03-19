<?php
	session_start();
	include('processes/process.php');
	$connect=connectDB();
	$result=viewGrade($connect);
	$header = "Student List";
	$header2 =  "Currently Enrolled Students";
	include('header.php');
?>

<head>
	<title>Search Students</title>
</head>
<div style="position: relative;width: 80%;bottom: 4%; left: 16%;">
<div class="row">
  <form class="col s12 m7"  method="POST">
    <div class="row">
      <div class="input-field col s6">
        <input id="search" type="text" pattern="[A-Za-z0-9 ]+" name="search" class="validate tooltipped" data-position="top" data-delay="50" data-tooltip="Search for a Student">
        <label for="search"><i class="mdi-action-search "></i>Search</label>
     
     </div>
     <button data-position="right" data-delay="50" data-tooltip="Search!" class="btn-floating btn-large tooltipped waves-effect waves-light white blue-text text-lighten 2 mdi-action-search" style="font-size:200%;;" type="submit" name="submit"/>
  </form>
</div>
        



</form>
</div>
<div style="padding-left:290px;padding-right:100px;margin-top:-80px;">
	<?php
		while($row=mysqli_fetch_assoc($result)){
		
echo $row['grade_levels'];
	?>
	<div class="showme" data-panelid="<?php echo str_replace(' ', '', $row['grade_levels']);?>"></div>
		<div id="<?php echo str_replace(' ', '', $row['grade_levels']);?>">
	
	
	<table>
			<tr>
				<th>Last name</th>
				<th>First name</th>
				<th>Age</th>
				<th>Grade</th>
				<th>Academic Status</th>
			</tr>
			<?php 
			$getTuitionFees=getFeeScheduleOptions2($connect, $row['grade_levels']);
			while($row=mysqli_fetch_assoc($getTuitionFees)){
			?>
			<tr>
				<td><?=$row['last_name']?></td>
				<td><?=$row['first_name']?></td>
				<td><?=$row['age']?></td>
				<td><?=$row['grade']?></td>
				<td><?=$row['academicstatus']?></td>	
			</tr>
			
			
			<?php
			}
			?>
		</table>
</div>		
	<?php
	}
	?>

</div>
<script src="jquery-2.1.3.min.js"></script>
<script>

	$(function(){
		$(".clickableRow").click(function() {
            window.document.location = $(this).attr("href");
      });
		$(".showme").on('click', function(){
       var panelId = $(this).attr('data-panelid');
       $('#'+panelId).slideToggle();
    });
	});

</script>

<?php
	include('footer.php');
?>
