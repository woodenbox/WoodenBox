
  <a class="waves-effect waves-light btn modal-trigger green" href="#modal3">Make Payment</a>

 
  <div id="modal3" class="modal">
    <div class="modal-content">
<form method="POST">
	<label><?=$viewStudent['first_name']?> </label><label><?=$viewStudent['last_name']?></label></br>
<table name="first_name">
	<thead>
		<tr >
			<th></th>
			<th style="position: relative;left:-250px;">Item/Balance</th>
			
			<th style="position: relative;left:-350px;">Due Date</th>
			<th style="position: relative;left:-300px;">Penalty</th>
		</tr>
	</thead>

<?php	
	$table=getStudentBalancePayment($connect, $_SESSION['studentfee']);
	while($row=mysqli_fetch_assoc($table)){
?>

		<input type="checkbox"  name="check_list[]" value="<?=$row['id']?>" id="test5"/>
		  <label for="test5"><?=$row['item']?></label><br>
			
			<td><label for="test5"><?=$row['item']?></label><br><?=$row['balance']?></td>
			<td style="position: relative;left:-80px;"><?=$row['due_date']?></td>
			<td style="position: relative;left:-100px;"><?=$row['penalty_balance']?></td>
		</tr>	
<?php	
	}
?>
	</table>
	<input type="number" min="0" placeholder="Enter Amount" name="amount" pattern="[0-9]+([.][0-9]+)?" step="0.01" required/></br>
	<input type="number" min="0" placeholder="AR Number" name="arnumber" value="<?=$getARNumber['ar']+1?>" pattern="[0-9]+" required/></br>
	<input type="text" placeholder="D.R." name="dr"/></br>
	<input type="text" placeholder="C.R." name="cr"/></br>
	<input type="text" placeholder="Remarks" name="remark" required/></br>
	<button class="btn waves-effect waves-light green" type="submit" name="456" value="Make Payment" >Make Payment</button>
	<button class="btn waves-effect waves-light green" type="button" name="cancel" value="Cancel" onclick="location.href = 'viewstudent.php?id=<?=$_SESSION['studentfee']?>';">Cancel</button>
</form>


    </div>
   
  </div>