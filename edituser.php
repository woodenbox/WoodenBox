<?php
	session_start();
	include('processes/process.php');
	$headerr="Users";
	$headerr2="Edit Users";
	include('header.php');

	$connect=connectDB();
	$editUser=mysqli_fetch_assoc(editUser($connect, $_GET['id']));

	if(isset($_POST['submit'])){
		extract($_POST);
		if($_POST['password1']==$_POST['password2']){
			if($_POST['access_control']>0 && $_POST['access_control']<3){
				updateUser($connect, $_GET['id'], $username, $password1, $access_control);
				echo "<script>alert('Successfully Edited');</script>";
				header('Location: option.php');
			}else{
				echo "<script>alert('Please enter 1 or 2 in Access Control');</script>";
			}
		}else{
			echo "<script>alert('Passwords did not match');</script>";
		}
	}

	if(isset($_POST['removeme'])){
		deleteUser($connect, $_GET['id']);
		header('Location: option.php');
	}
?>



<div style="position: relative;width: 80%;bottom: -2%; left: 16%;">
<form method="POST">
	<input style="width:20%;" type="text" name="first_name" placeholder="First Name"  value="<?=$editUser['first_name']?>" disabled/>
	<input style="width:20%;" type="text" name="last_name" placeholder="First Name" value="<?=$editUser['last_name']?>" disabled/>
	<input style="width:20%;" type="text" name="username" placeholder="Username" pattern="[A-Za-z0-9 ]+"  title="Only letters, numbers, and spaces are accepted." value="<?=$editUser['username']?>"/></br>
	<input style="width:20%;" type="password" name="password1" placeholder="Password" pattern="[A-Za-z0-9 ]+" title="Only letters, numbers, and spaces are accepted." value="<?=$editUser['password']?>" onfocus="this.value = '';" required/>
	<input style="width:20%;" type="password" name="password2" placeholder="Confirm Password" pattern="[A-Za-z0-9 ]+" title="Only letters, numbers, and spaces are accepted." value="<?=$editUser['password']?>" onfocus="this.value = '';" required/></br>
		<input style="width:20%;" type="number" name="access_control" placeholder="Access Control" pattern="[1-2]{1}" value="<?=$editUser['access_control']?>" title="1 - Regular user 2 - Administrator" onfocus="this.value = '';" required/></br>
		<button class="btn waves-effect waves-light blue lighten-2 white-text" type="submit" name="submit" value="Save">Save</button>
		<button class="btn waves-effect waves-light blue lighten-2 white-text" type="submit" name="removeme" value="Delete">Delete</button>
		<button class="btn waves-effect waves-light blue lighten-2 white-text" type="submit" name="cancel" value="Cancel" onclick="location.href='option.php';">Cancel</button></br>
</form>
</div>
<?php
	include('footer.php');
?>