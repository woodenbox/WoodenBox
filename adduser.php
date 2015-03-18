<?php
	session_start();
	include('processes/process.php');
	$header="Users";
	$header2="Add user";
	include('header.php');

	$connect=connectDB();

	if(isset($_POST['submit'])){
		extract($_POST);
		if($_POST['password1']==$_POST['password2']){
			if($_POST['access_control']>0 && $_POST['access_control']<3){
				addUser($connect, $first_name, $last_name, $username, $password1, $access_control);
				echo "<script>alert('Successfully Added');</script>";
				header('Location: option.php');
			}else{
				echo "<script>alert('Please enter 1 or 2 in Access Control');</script>";
			}
		}else{
			echo "<script>alert('Passwords did not match');</script>";
		}
	}

	$header="Users";
	$header2="Add user";
?>



<div style="position: relative;width: 80%;bottom: -2%; left: 16%;">
<form method="POST">
	<div class="row">
	<input style="width:20%;" type="text" name="first_name" placeholder="First Name" pattern="[A-Za-z ]+"  title="Only letters and spaces are accepted." required/>
	<input style="width:20%;" type="text" name="last_name" placeholder="Last Name" pattern="[A-Za-z ]+"  title="Only letters and spaces are accepted." required/>
	<input style="width:20%;" type="text" name="username" placeholder="Username" pattern="[A-Za-z0-9]{4,}"  title="Must be at least 4 characters of letters or numbers are accepted." required/>
	

</div>
	<input style="width:20%;" type="password" name="password1" placeholder="Password" pattern="[A-Za-z0-9]{6,10}"  title="Must contain 6-10 characters of letters or numbers" required/>
	<input style="width:20%;" type="password" name="password2" placeholder="Confirm Password" pattern="[A-Za-z0-9]{6,10}"  title="Must contain 6-10 characters of letters or numbers" required/></br>
	<input style="width:20%;" type="number" name="access_control" placeholder="Access Control" pattern="[1-2]{1}" title="1 - Regular user 2 - Administrator" required/><br>
	<button class="btn waves-effect waves-light blue lighten-2 white-text" type="submit" name="submit" value="Save">Save</button></br>
	<button class="btn waves-effect waves-light blue lighten-2 white-text" type="submit" name="cancel" value="Cancel" onclick="location.href='option.php';">Cancel</button
</form>
</div>
<?php
	include('footer.php');
?>