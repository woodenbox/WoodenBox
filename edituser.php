<?php
	session_start();
	include('processes/process.php');
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

<form method="POST">
	<input type="text" name="first_name" placeholder="First Name" value="<?=$editUser['first_name']?>" disabled/></br>
	<input type="text" name="last_name" placeholder="First Name" value="<?=$editUser['last_name']?>" disabled/></br>
	<input type="text" name="username" placeholder="Username" value="<?=$editUser['username']?>"/></br>
	<input type="password" name="password1" placeholder="Password" pattern="[A-Za-z0-9]+" value="<?=$editUser['password']?>" onfocus="this.value = '';" required/></br>
	<input type="password" name="password2" placeholder="Password" pattern="[A-Za-z0-9]+" value="<?=$editUser['password']?>" onfocus="this.value = '';" required/></br>
	<input type="number" name="access_control" placeholder="Access Control" pattern="[1-2]{1}" value="<?=$editUser['access_control']?>" title="1 - Regular user 2 - Administrator" onfocus="this.value = '';" required/>
	<input type="submit" name="submit" value="Save"></br>
	<input type="submit" name="removeme" value="Delete"></br>
	<input type="submit" name="cancel" value="Cancel" onclick="location.href='option.php';"></br>
</form>

<?php
	include('footer.php');
?>