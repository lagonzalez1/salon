<?php


include('server_connect.php');
// Hello added for commit
// Hello added again for commit

date_default_timezone_set("America/Los_Angeles");
$current_time = date("g:i:a");
$current_date = date("m/d/o");

if ( !isset($_POST['client-name']) || !isset($_POST['clicked']) ){
	echo "Error Post fail";
	exit();
} 
$name = $_POST['client-name'];
$email = $_POST['client-email'];
$phone = $_POST['client-phone'];
$employee = "General";
$check_in = 0;
$status = 0;

  if ( empty($name) || empty($email) || empty($phone) || empty($current_date) || empty($current_time) ) {
    echo "Error Values Are Empty";
    exit();
  } else {
	  	$sql = "INSERT INTO `client_upgrade`(`id`,`Email`,`Name`,`Phone`,`Per_stylist`,`App_Time`,`App_Date`,`Status`) VALUES (NULL,'$email','$name','$phone','$employee','$current_time','$current_date','$status'); ";
	  	$sqlResult = mysqli_query($connection, $sql);

		if ($sqlResult) {
			session_start();
			header("Location: user_interface_main.php");
			mysqli_close($connection);
		}else{
      // Hitting this
      if( check_repeating($email) ){
        header("Location: user_interface_main.php?email_match=true");  
        exit();
      }else{
        echo "Location: user_interface_main.php?fatal_err=true";
        echo mysqli_error($connection);
        mysqli_close($connection);
        exit();
		}

  }
}

  // Check if repeating email has occured
  // Returns a Boolean
  // True -> If repeating False otherwise
  function check_repeating($email){
    global $connection;
  	$check_stm = "SELECT * FROM `client_upgrade` WHERE Email = '$email';";
    $result = mysqli_query($connection, $check_stm);
    if($result){
      $row = mysqli_fetch_assoc($result);
      return true;
    }else {
      return false;
    }
  }


