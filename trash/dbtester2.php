<?php
		session_start();
/*	include('header.php');
	include('processes/process.php');
	$connect = connectDB();
*/
/*	print_r($_POST);
		$_SESSION['car'] = $_POST['car'];

	echo $_SESSION['car'];*/

	if(isset($_POST['gradeTable'])){
		$_SESSION['gradeTable'] = $_POST['gradeTable'];
	}

	if(isset($_POST['feetypeTable'])){
		$_SESSION['feetypeTable'] = $_POST['feetypeTable'];
	}
?>