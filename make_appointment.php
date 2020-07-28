<?php

include('server_connect.php');
date_default_timezone_set("America/Los_Angeles");

if( isset($_POST['clicked']) ){
	$name = $_POST['name'];
	$email = $_POST['email']; 
	$phone = $_POST['phone'];
	$time = $_POST['time']; 
	$date = $_POST['date'];
	$employee = $_POST['empl'];
	$null = NULL;
	$status = 0;

	if(empty($name) || empty($employee) || empty($date) || empty($time) || empty($email) || empty($phone) ){
		echo "Empty, name, empl , date, time";
		exit();
	}


	if(check_dead_time($time,$employee,$date)){
		header('Location: main.php?lost_spot=true');
		exit();
	}


	$sql = "INSERT INTO `client_upgrade` (`id`,`Email`,`Name`,`Phone`,`Per_stylist`,`App_Time`,`App_Date`,`Status`) VALUES (NULL,'$email','$name','$phone','$employee','$time','$date','$status'); ";

	if( $sql_result = mysqli_query($connection,$sql) ){
		session_start();
		echo "Success";
		header("Location: app_made_confirmation.php");
		$_SESSION['name'] = $name;
		$_SESSION['time'] = $time;
		$_SESSION['date'] = $date;
		$_SESSION['empl'] = $employee;
		exit();

	}else if(!$sql_result){
		echo mysqli_error($connection);
		echo "Error: Insert";
		header("Location: main.php?duplicate=true");
		echo $sql_result;
		exit();
	}else{
		echo $sql_result;
		exit();
	}
}



function check_dead_time($time,$empl,$date){
	global $connection;
	$stmt = "SELECT * FROM `client_upgrade` WHERE Per_stylist = '$empl' AND App_Date = '$date' AND App_Time = '$time'; ";
	$result = mysqli_query($connection, $stmt);
	if(mysqli_num_rows($result) > 0){
		// Someone must of gotten an app as soon as entered
		// App Exist already for a specific time
		// Row Exist
		return true;
	}else{
		// Nothing showed up ok
		return false;
	}


}

header("Location: error_restricted.html");
exit();


