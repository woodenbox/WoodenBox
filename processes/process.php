<?php
	function connectDB(){
		include('dbconfig.php');
		$connect = mysqli_connect($host, $user, $pass, $db);
		return $connect;
	}
	//	$lname=stripslashes($lname);
	// $lname=htmlspecialchars($lname);
//=============================================================================================================================================//
	function checkUserDB($connect, $username, $password){
		$sql = "select * from users where username='$username' AND password= md5('$password')";
		$result = mysqli_query($connect,$sql);
		return $result;
	}

	function getFandLnameDB($connect, $user_id){
		$sql = "select first_name, last_name from users where user_id = '$user_id'";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function getPreviousCashFlow($connect){
		$sql ="SELECT DISTINCT year, month from fee_payment ORDER BY id DESC";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function getCashFlow($connect, $month, $year){
		$sql = "SELECT * FROM fee_payment WHERE month='$month' AND year=$year AND state = 0";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function getCashFlowIndex($connect, $month, $year){
		$sql = "SELECT * FROM fee_payment WHERE month='$month' AND year=$year ORDER BY payment_date";
		$result = mysqli_query($connect, $sql);
		return $result;		
	}

	function editCashFlow($connect, $id){
		$sql="SELECT * FROM fee_payment WHERE id=$id";
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function restoreCashFlow($connect, $id){
		$sql="UPDATE `fee_payment` SET `state`=0 WHERE `id`=$id";
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function deleteCashFlow($connect, $id){
		$sql = "UPDATE `fee_payment` SET `state` = 1 WHERE id=$id";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function updateCashFlow($connect, $id, $ar, $cash, $dr, $cr, $tuition, $remark){
		$sql="UPDATE fee_payment SET ar=$ar, cash=$cash, dr='$dr', cr='$cr', tuition='$tuition', remark='$remark' WHERE id=$id";
		$result=mysqli_query($connect, $sql);
		return $result;
	}

/*	function viewCashFlowPage($connect, $page, $rows, $month, $year){
		$start=($page-1)*$rows;
		$sql="SELECT * FROM fee_payment WHERE month='$month' AND year=$year LIMIT $start,$rows";
		$result=mysqli_query($connect,$sql);
		return $result;
	}*/
//=============================================================================================================================================//
	function addStudentDB($connect, $first_name, $last_name, $middle_name, $age, $grade, $fromTime, $toTime, $academicstatus, $paymentmode, $uniform, $peuniform, $imagelocation, $last_accessed){
		$sql="insert into students  (first_name, last_name, middle_name, age, grade, fromTime, toTime, academicstatus, paymentmode, uniform, peuniform, imagelocation, last_accessed) values('$first_name', '$last_name', '$middle_name', '$age', '$grade', '$fromTime', '$toTime', '$academicstatus', '$paymentmode', '$uniform', '$peuniform', '$imagelocation', '$last_accessed')";
		$result=mysqli_query($connect,$sql);
		return $result;
	}

	function reEnrollStudent($connect, $id, $first_name, $last_name, $middle_name, $age, $grade, $fromTime, $toTime, $academicstatus, $paymentmode){
		$sql="UPDATE `students` SET `first_name` = '$first_name', `last_name` = '$last_name', `middle_name` = '$middle_name', `age` = $age, `grade` = '$grade', `fromTime` = '$fromTime', `toTime` = '$toTime', `academicstatus` = '$academicstatus', `paymentmode` = '$paymentmode' WHERE `student_id` = $id";
		$result=mysqli_query($connect,$sql);
		return $result;
	}
	
	function updateStudent($connect, $id, $first_name, $last_name, $middle_name, $age){
		$sql = "UPDATE `students` SET `first_name` = '$first_name', `last_name` = '$last_name', `middle_name` = '$middle_name', `age` = $age WHERE `student_id` = $id";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function getFeeSchedule($connect, $grade, $fee_type){
		$sql="SELECT * FROM fee_schedule WHERE grade = '$grade' AND fee_type = '$fee_type'";
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function getFeeScheduleOptions($connect, $grade){
		$sql="SELECT * FROM `fee_schedule` WHERE `grade`='$grade'";
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function getMonthlyFeeSchedule($connect, $grade){
		$sql="SELECT * FROM fee_schedule WHERE grade='$grade' AND item!='Monthly Fee' AND fee_type='Monthly'";
		$result=mysqli_query($connect, $sql);
/*		if (!$result) {
    printf("Error: %s\n", mysqli_error($connect));
    exit();
}*/
		return $result;
	}

/*	function getFeeSchedulePrint($connect, $grade, $fee_type){
		$sql="SELECT * FROM fee_schedule WHERE grade = '$grade' AND fee_type = '$fee_type'";
		$result=mysqli_query($connect, $sql);
		return $result;
	}*/

	function getFeeSchedulePrint($connect, $paymentmode, $grade){
		$sql="SELECT * FROM fee_schedule WHERE fee_type='$paymentmode' AND grade='$grade'";
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function getTotalOrig($connect, $id){
		$sql="SELECT SUM(original_price) as origi FROM fee_balance WHERE student_id = $id AND waive = 0";
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function getARPrint($connect, $id){
		$sql="SELECT ar FROM fee_payment WHERE student_id=$id";
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function getARTotalPrint($connect, $id){
		$sql="SELECT SUM(cash) as total FROM fee_payment WHERE student_id=$id";
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function getSumTuitionPrint($connect, $id){
		$sql="SELECT SUM(balance+penalty_balance) AS fee FROM fee_balance WHERE student_id=$id AND `waive`=0";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function getSY($connect){
		$sql="SELECT * FROM school_year";
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function getTotalCashFlow($connect, $month, $year){
		$sql="SELECT SUM(cash) AS cash FROM `fee_payment` WHERE `month`='$month' AND `year`=$year AND `state`=0";
		$result=mysqli_query($connect, $sql);
		return $result; 
	}

	function getStudentBalancePrint($connect, $id){
		$datengaun = date("Y-m-30")/*date('Y-m-d', strtotime('2015-11-30'))*/;
		$sql = "SELECT * FROM fee_balance WHERE student_id = $id AND balance > 0 AND due_date <='$datengaun' AND `waive`=0 OR student_id=$id AND penalty_balance > 0 AND due_date <='$datengaun' AND `waive`=0 OR student_id = $id AND balance > 0 AND due_date IS NULL AND `waive`=0 OR student_id =$id AND penalty_balance > 0 AND due_date IS NULL AND `waive`=0 ";
		$result = mysqli_query($connect, $sql);
		return $result;
		
		//$sql = "SELECT * FROM fee_balance WHERE student_id = '$id' AND balance > 0 AND due_date <='$datengaun' OR student_id='$id' AND penalty_balance > 0 AND due_date <='$datengaun' OR student_id='$id' AND due_date IS NULL";
	}

	function getTotalBalancePrint($connect, $id){
		$datengaun = date("Y-m-30")/*date('Y-m-d', strtotime('2015-11-30'))*/;
		$sql = "SELECT SUM(balance + penalty_balance) AS total FROM fee_balance WHERE student_id=$id AND due_date <= '$datengaun' AND waive = 0 OR student_id=$id AND due_date IS NULL AND waive = 0";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function addBalanceDB($connect, $id, $item, $balance, $due_date){
		if($due_date==null){
			$sql="INSERT into fee_balance (student_id, item, balance, due_date, original_price) values ($id, '$item', $balance, null, $balance)";
		} else {
			$sql="INSERT into fee_balance (student_id, item, balance, due_date, original_price) values ($id, '$item', $balance, '$due_date', $balance)";
		}
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function getFeeDB($connect, $fee_type){
		$sql="SELECT * FROM fee_schedule WHERE fee_type = '$fee_type'";
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function getOthers($connect){
		$sql="SELECT * FROM options_others";
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function addOthers($connect, $id){
		$sql="SELECT * FROM options_others WHERE id=$id";
		$result=mysqli_query($connect, $sql);
		return $result;
	}
/*
	function payBalanceDB($connect, $last_name, $first_name, $payment_date, $cash, $dr, $cr, $tuition, $remark, $student_id){
		$sql="INSERT into fee_payment (last_name, first_name,  payment_date, cash, dr, cr, tuition, remark, student_id) values  ('$last_name', '$first_name', '$payment_date', $cash, '$dr', '$cr', $tuition, '$remark', $student_id)";
		//$sql="INSERT into balance (student_id, balance, paid, due_date) values ($id, $balance, $paid, $due_date)";
		$result=mysqli_query($connect, $sql);
		return $result;
	}
*/
//=============================================================================================================================================//
	function getGradesDB($connect){
		$sql = "SELECT grade_levels FROM options_grades";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function getTimeDB($connect){
		$sql = "SELECT time from options_times";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function getAcademicStatusDB($connect){
		$sql="SELECT status from options_academic_status";
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function getPaymentModeDB($connect){
		$sql="SELECT DISTINCT `fee_type` as mode FROM `fee_schedule`";
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function insertTuition($connect,$grade, $fee_type, $item, $tuition_fee, $due_date){
		if($due_date==null)
			$sql="INSERT INTO `fee_schedule` (`grade`, `fee_type`, `item`, `fee`, `due_date`) VALUES ('$grade', '$fee_type', '$item', $tuition_fee, null)";
		else
			$sql="INSERT INTO `fee_schedule` (`grade`, `fee_type`, `item`, `fee`, `due_date`) VALUES ('$grade', '$fee_type', '$item', $tuition_fee, '$due_date')";
		
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function selectPenaltyValue($connect){
		$sql="SELECT * FROM `penalty`";
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function updatePenaltyValue($connect, $penalty){
		$sql="UPDATE `penalty` SET `penalty`=$penalty";
		$result=mysqli_query($connect, $sql);
		return $result;
	}
//=============================================================================================================================================//
	function viewStudents($connect, $srt, $sortby){
		$sql="SELECT students.state AS state, students.last_name AS last_name, students.first_name AS first_name, students.age AS age, students.student_id AS student_id, students.grade AS grade, students.academicstatus AS academicstatus, students.last_accessed AS last_accessed, SUM(case when waive = 0 then fee_balance.balance else 0 end) AS total_balance FROM fee_balance INNER JOIN students ON fee_balance.student_id = students.student_id GROUP BY students.student_id ORDER BY students.$srt $sortby ";
		$result=mysqli_query($connect,$sql);
		return $result;
	}
/*	function viewStudentsPage($connect, $page, $rows){
		$start=($page-1)*$rows;
		$sql="SELECT * FROM students ORDER BY student_id DESC LIMIT $start,$rows";
		$result=mysqli_query($connect,$sql);
		return $result;
	}*/

	function viewStudentAccount($connect, $id){
		$sql = "select * from students where student_id = '$id'";
		$result = mysqli_query($connect,$sql);
		return $result;
	}

	function restoreStudent($connect, $id){
		$sql="UPDATE `students` SET `state`=0 WHERE `student_id` = $id";
		$return = mysqli_query($connect, $sql);
		return $result;	}

	function getPenalty($connect, $id){
		$sql = "SELECT penalty_balance, penalty_count, due_date, balance, id, waive FROM fee_balance WHERE student_id='$id' AND balance > 0 OR student_id='$id' AND penalty_balance > 0";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

function add($date_str, $months)
{
 $date = new DateTime($date_str);
 $start_day = $date->format('j');

 $date->modify("+{$months} month");
 $end_day = $date->format('j');

 if ($start_day != $end_day)
 $date->modify('last day of last month');

 return $date;
}

	function updatePenalty($connect, $id, $penalty_count, $penalty, $due_date){
		$sql = "UPDATE fee_balance SET due_date='$due_date', penalty_balance=$penalty, penalty_count=$penalty_count WHERE id='$id'";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function getMonthlyFee($connect, $id){
		$sql="SELECT * FROM `fee_balance` WHERE `student_id`=$id AND `item`='Downpayment' OR `student_id`=$id AND `item` LIKE '%Uniform%' OR `student_id`=$id AND `item`='Miscellaneous'";
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function getMonths($connect, $id){
		$sql="SELECT * FROM `fee_balance` WHERE `student_id`=$id AND `item`!='Downpayment' OR `student_id`=$id AND `item`!='Miscellaneous'"; 
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function getStudentBalance($connect, $id){
		$sql = "SELECT * FROM fee_balance WHERE student_id = '$id' AND balance > 0 OR student_id='$id' AND penalty_balance > 0";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	//student_id = '$id' AND balance > 0 AND due_date <='$datengaun' OR student_id='$id' AND penalty_balance > 0  AND due_date <='$datengaun' OR student_id='$id' AND penalty_balance > 0  AND due_date IS NULL OR student_id = '$id' AND balance > 0 AND due_date IS NULL

	function getStudentBalancePayment($connect, $id){
		$sql = "SELECT * FROM fee_balance WHERE student_id = '$id' AND balance > 0 AND waive = 0 OR student_id='$id' AND penalty_balance > 0 AND waive = 0";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function getBalance($connect, $id){
		$sql = "SELECT * from fee_balance WHERE id = '$id'";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function balancePayment($connect, $last_name, $first_name, $payment_date, $cash, $id, $month, $year, $arnumber, $dr, $cr, $remark){
		$sql = "INSERT INTO fee_payment (last_name, first_name, payment_date, cash, tuition, student_id, month, year, ar, dr, cr, remark) VALUES ('$last_name', '$first_name', '$payment_date', $cash, $cash, $id, '$month', $year, $arnumber, '$dr', '$cr', '$remark')";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function balanceClear($connect, $id, $balance){
		$sql = "UPDATE fee_balance SET balance = $balance WHERE id='$id'";
		$result = mysqli_query($connect, $sql);
		return $result;	
	}

	function penaltyClear($connect, $id, $balance){
		$sql = "UPDATE fee_balance SET penalty_balance=$balance WHERE id='$id'";
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function getARNumber($connect){
		$sql = "SELECT MAX(ar) AS ar FROM fee_payment";
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function deleteStudent($connect, $id){
		$sql="UPDATE `fee_balance` SET `waive`=1 WHERE `student_id` = $id";
		mysqli_query($connect, $sql);

		$sql="UPDATE `students` SET `state`=1 WHERE `student_id` = $id";
		$return = mysqli_query($connect, $sql);
		return $result;
	}

	function updateLastAccessed($connect, $last_accessed, $id){
		$sql = "UPDATE students SET last_accessed = '$last_accessed' WHERE student_id = $id";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function getAcademicStatus($connect, $id){
		$sql = "SELECT id, grade_level, quarter, average FROM tabs_academicstatus WHERE student_id = $id";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function getAcademicStat($connect, $id){
		$sql = "SELECT `grade_level`, `quarter`, `average` FROM `tabs_academicstatus` WHERE `id` = $id";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function updateAcademicStatus($connect, $id, $grade_level, $quarter, $average){
		$sql = "UPDATE `tabs_academicstatus` SET `grade_level` = $grade_level, `quarter` = '$quarter', `average` = $average WHERE `id` = $id";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function deleteAcademicStatus($connect, $id){
		$sql = "DELETE FROM `tabs_academicstatus` WHERE `id` = $id";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function insertAcademicStatus($connect, $id, $grade_level, $quarter, $average){
		$sql = "INSERT INTO tabs_academicstatus (student_id, grade_level, quarter, average) VALUES ($id, $grade_level, '$quarter', $average)";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function getOtherRecords($connect, $id){
		$sql = "SELECT `id`, `date`, `sent_to`, `reason` FROM `tabs_other_records` WHERE `student_id` = $id";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function getOtherRecord($connect, $id){
		$sql = "SELECT `date`, `sent_to`, `reason` FROM `tabs_other_records` WHERE `id` = $id";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function updateOtherRecords($connect, $id, $date, $sent_to, $reason){
		$sql = "UPDATE `tabs_other_records` SET `date` = '$date', `sent_to` = '$sent_to', `reason` = '$reason' WHERE `id` = $id";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function deleteOtherRecords($connect, $id){
		$sql = "DELETE FROM `tabs_other_records` WHERE `id` = $id";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function insertOtherRecords($connect, $id, $date, $sent_to, $reason){
		$sql = "INSERT INTO tabs_other_records (`student_id`, `date`, `sent_to`, `reason`) VALUES ($id, '$date', '$sent_to', '$reason')";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function updateTuitioFee($connect,$id, $tuition_fee, $due_date){
		if($due_date==null)
			$sql="UPDATE `fee_schedule` SET `fee`=$tuition_fee, `due_date`=null WHERE `fee_id`=$id";
		else
			$sql="UPDATE `fee_schedule` SET `fee`=$tuition_fee, `due_date`='$due_date' WHERE `fee_id`=$id";
		$result=mysqli_query($connect, $sql);
		return $result;
	}
	
	function updateStudentBalance($connect, $id, $item, $balance, $due_date, $penalty_balance, $penalty_count){
		if($due_date==null)
			$sql = "UPDATE `fee_balance` SET `item` = '$item', `balance` = $balance, `due_date` = null, `penalty_balance` = $penalty_balance, `penalty_count` = $penalty_count WHERE `id` = $id";
		else
			$sql = "UPDATE `fee_balance` SET `item` = '$item', `balance` = $balance, `due_date` = '$due_date', `penalty_balance` = $penalty_balance, `penalty_count` = $penalty_count WHERE `id` = $id";

		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function deleteStudentBalance($connect, $id, $waive){
		$sql = "UPDATE `fee_balance` SET `waive` = $waive WHERE `id` = $id";
		$result = mysqli_query($connect, $sql);
		return $result;
	}
//=============================================================================================================================================//	
	function searchStudents($connect, $search){
		$sql="select * from students WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR grade LIKE '%$search%' ORDER BY student_id DESC";
		$result=mysqli_query($connect,$sql);
		return $result;
	}
	function searchStudentsPage($connect, $page, $rows, $search){
		$start=($page-1)*$rows;
		$sql="SELECT * FROM students WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%' ORDER BY student_id DESC LIMIT $start,$rows";
		$result=mysqli_query($connect,$sql);
		return $result;
	}
//=============================================================================================================================================//
function viewTime($connect){
	$sql="SELECT * FROM options_times";
	$result=mysqli_query($connect, $sql);
	return $result;
}


function getTime($connect, $id){
$sql="Select * from options_times where id='$id'";
$result=mysqli_query($connect, $sql);
return $result;
}

function viewMode($connect){
	$sql="SELECT * FROM options_payment_modes";
	$result=mysqli_query($connect, $sql);
	return $result;
}

function getMode($connect, $id){
$sql="Select * from options_payment_modes where id='$id'";
$result=mysqli_query($connect, $sql);
return $result;
}

function viewGrade($connect){
	$sql="SELECT DISTINCT `grade` as grade_levels FROM `fee_schedule`";
	$result=mysqli_query($connect, $sql);
	return $result;
}

function getGrade($connect, $id){
$sql="Select * from fee_schedule where grade='$id'";
$result=mysqli_query($connect, $sql);
return $result;
}

function editTuitionFee($connect, $id){
	$sql="SELECT * FROM `fee_schedule` WHERE `fee_id`=$id";
	$result=mysqli_query($connect, $sql);
	return $result;
}

function viewStatus($connect){
	$sql="SELECT * FROM options_academic_status";
	$result=mysqli_query($connect, $sql);
	return $result;
}

function getStatus($connect, $id){
$sql="Select * from options_academic_status where id='$id'";
$result=mysqli_query($connect, $sql);
return $result;
}


function addTime($connect,$time){
	$sql="insert into options_times values('','$time')";
	$result=mysqli_query($connect, $sql);
	return $result;
}

function addMode($connect,$mode){
	$sql="insert into options_payment_modes values('','$mode')";
	$result=mysqli_query($connect, $sql);
	return $result;
}

function addGrade($connect,$grade){
	$sql="insert into options_grades values('','$grade')";
	$result=mysqli_query($connect, $sql);
	return $result;
}

function addStatus($connect,$status){
	$sql="insert into options_academic_status values('','$status')";
	$result=mysqli_query($connect, $sql);
	return $result;
}
function delTime($connect,$id){
	$sql="DELETE FROM options_times WHERE id=$id";
	$result=mysqli_query($connect, $sql);
	return $result;
}

function delMode($connect,$id){
	$sql="DELETE FROM options_payment_modes WHERE id=$id";
	$result=mysqli_query($connect, $sql);
	return $result;
}


function delStatus($connect,$id){
	$sql="DELETE FROM options_academic_status WHERE id=$id";
	$result=mysqli_query($connect, $sql);
	return $result;
}

function delGrade($connect,$id){
	$sql="DELETE FROM options_grades WHERE id=$id";
	$result=mysqli_query($connect, $sql);
	return $result;
}

function changeyear($connect, $from, $to){
		$sql="UPDATE `school_year` SET `from`=$from, `to`=$to";
		$result = mysqli_query($connect, $sql);
		return $result;
	}

	function getSchoolYears($connect){
		$sql="SELECT * FROM `options_school_year`";
		$result=mysqli_query($connect, $sql);
		return $result;
	}

	function getCurrentSY($connect){
		$sql="SELECT * FROM `school_year`";
		$result=mysqli_query($connect, $sql);
		return $result;
	}

function updateTime($connect, $id, $time){
		$sql = "UPDATE options_times SET time='$time' WHERE id='$id'";
		$result = mysqli_query($connect, $sql);
		return $result;
}

function updateMode($connect, $id, $mode){
		$sql = "UPDATE options_payment_modes SET mode='$mode' WHERE id='$id'";
		$result = mysqli_query($connect, $sql);
		return $result;
}

function updateStatus($connect, $id, $status){
		$sql = "UPDATE options_academic_status SET status='$status' WHERE id='$id'";
		$result = mysqli_query($connect, $sql);
		return $result;
}

function updateGrades($connect, $id, $grade){
		$sql = "UPDATE options_grades SET grade='$grade' WHERE id='$id'";
		$result = mysqli_query($connect, $sql);
		return $result;
}

function getUsers($connect){
	$sql="SELECT `user_id`, `username`, `first_name`, `last_name`, `access_control` FROM `users`";
	$result=mysqli_query($connect, $sql);
	return $result;
}

function editUser($connect, $id){
	$sql="SELECT `username`, `first_name`, `last_name`, `access_control`, `password` FROM `users` WHERE `user_id` = $id";
	$result=mysqli_query($connect, $sql);
	return $result;
}

function updateUser($connect, $id, $username, $password, $access_control){
	$sql="UPDATE `users` SET `username` = '$username', `password` = MD5('$password'), `access_control` = $access_control WHERE `user_id` = $id";
	$result=mysqli_query($connect, $sql);
	return $result;
}

function deleteUser($connect, $id){
	$sql="DELETE FROM users WHERE user_id = $id";
	$result=mysqli_query($connect, $sql);
	return $result;
}

function addUser($connect, $first_name, $last_name, $username, $password, $access_control){
	$sql="INSERT INTO `users` (`first_name`, `last_name`, `username`, `password`, `access_control`) VALUES ('$first_name', '$last_name', '$username', MD5('$password'), $access_control)";
	$result=mysqli_query($connect, $sql);
	return $result;
}

function backupDB(){
		exec('woodback.bat');
	}
		function database_restore(){
			$filename = 'backup.sql';
			$connect = connectDB();
			$templine = '';
			$lines = file($filename);
			foreach ($lines as $line){
				if (substr($line, 0, 2) == '--' || $line == '')
					continue;
				$templine .= $line;
				if (substr(trim($line), -1, 1) == ';'){
					mysqli_query($connect,$templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error() . '<br /><br />');
					$templine = '';
				}
			}
		}
?>