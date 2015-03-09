<?php
	session_start();
	include('header.php');
	include('processes/process.php');
	$connect = connectDB();

	if(isset($_POST['submit'])){
		extract($_POST);
		insertOtherRecords($connect, $_GET['id'], $grade_level, $quarter, $average);
		header('Location: viewstudent.php?id='.$_GET['id']);
	}

	if(isset($_POST['return'])){
		header('Location: viewstudent.php?id='.$_GET['id']);
	}
?>

<form method="POST">
	<label>Date</label><input type="date" name="grade_level"/></br>
	<label>Sent To</label><input type="text" name="quarter" pattern="[A-Za-z0-9]+"/></br>
	<label>Reason</label><input type="text" name="average" pattern="[A-Za-z0-9]+"/></br>

	<input type="submit" name="submit" value="Save"></br>
	<input type="submit" name="return" value="Cancel">
</form>

 <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a>

  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
 <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a>

  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Modal Header</h4>
      <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
      <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Agree</a>
    </div>
  </div>
    </div>
    <div class="modal-footer">
      <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Agree</a>
    </div>
  </div>

<?php
	include('footer.php');
?>