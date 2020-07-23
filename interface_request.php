<?php


include('server_connect.php');
// Hello added for commit
// Hello added again for commit

date_default_timezone_set("America/Los_Angeles");
$current_time = date("H:i:s");
$current_date = date("m/d/o");

if ( !isset($_POST['client-name']) || !isset($_POST['clicked']) ){
	echo "Error Post fail";
	exit();
} 
$name = $_POST['client-name'];
$email = $_POST['client-email'];
$phone = $_POST['client-phone'];
$client_carrier = $_POST['carrier-id'];
$employee = "General";
$time = 'Walk in:'.$current_time.'';
$check_in = 0;
$status = 0;

  if ( empty($client_name) || empty($client_email) || empty($client_phone) || empty($current_date) || empty($current_time) ) {
    echo "Error Values Are Empty";
    exit();
  } else {

	  	$sql = "INSERT INTO `client_upgrade` (`id`,`Email`,`Name`,`Phone`,`Per_stylist`,`App_Time`,`App_Date`) VALUES (NULL,'$email','$name','$phone','$employee','$time','$current_date','$status'); ";
	  	$sqlResult = mysqli_query($connection, $sql);

		if ($sqlResult) {
			session_start();
			header("Location: user_interface_main.php");
			mysqli_close($connection);
		}else{

      if( check_repeating($client_email) ){
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
  	$check_stm = "SELECT * FROM `client_information` WHERE Email = '$email';";
    $result = mysqli_query($connection, $check_stm);
    if($result){
      $row = mysqli_fetch_assoc($result);
      return true;
    }else {
      return false;
    }
}


