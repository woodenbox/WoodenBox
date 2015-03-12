<?php
	session_start();
	include('processes/process.php');
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
?>

<form method="POST">
	<input type="text" name="first_name" placeholder="First Name" pattern="[A-Za-z ]+"  title="Only letters and spaces are accepted." required/></br>
	<input type="text" name="last_name" placeholder="Last Name" pattern="[A-Za-z ]+"  title="Only letters and spaces are accepted." required/></br>
	<input type="text" name="username" placeholder="Username" pattern="[A-Za-z0-9 ]+"  title="Only letters, numbers, and spaces are accepted." required/></br>
	<input type="password" name="password1" placeholder="Password" pattern="[A-Za-z0-9 ]+"  title="Only letters, numbers, and spaces are accepted." required/></br>
	<input type="password" name="password2" placeholder="Password" pattern="[A-Za-z0-9 ]+"  title="Only letters, numbers, and spaces are accepted." required/></br>
	<input type="number" name="access_control" placeholder="Access Control" pattern="[1-2]{1}" title="1 - Regular user 2 - Administrator" required/>
	<input type="submit" name="submit" value="Save"></br>
	<input type="submit" name="cancel" value="Cancel" onclick="location.href='option.php';"></br>
</form>

<?php
	include('footer.php');
?>