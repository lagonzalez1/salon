<?php

include('server_connect.php');
date_default_timezone_set("America/Los_Angeles");


if(isset($_POST['clicked'])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$time = $_POST['time'];
	$date = $_POST['date'];
	$employee = $_POST['empl'];
	$null = NULL;

	$sql = "INSERT INTO `client_upgrade`(`id`, `Email`, `Name`, `Phone`, `Per_stylist`, `App_Time`, `App_Date`) VALUES (NULL,'$email','$name','$phone','$employee','$time','$date'); ";
	if($sql_result = mysqli_query($connection, $sql)){
		session_start();
		echo "Success";
		$_SESSION['name'] = $name;
		$_SESSION['time'] = $time;
		$_SESSION['date'] = $date;
		$_SESSION['empl'] = $employee;
		header("Location: app_made_confirmation.php");
		exit();

	}else if(!$sql_result){
		echo $sql_result;
		exit();
	}




}

header("Location: error_restricted.php");


