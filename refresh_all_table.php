<?php

include('server_connect.php');


if(isset($_POST['initial_launch'])){
	$stmt = "SELECT * FROM `client_upgrade` ORDER BY `Per_stylist` ASC; ";
	$arr_value = (array)null;

	if($result = mysqli_query($connection , $stmt)){
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				array_push($arr_value, $row);
			}
		}

		echo json_encode($arr_value);
	}else {
		echo 'Result: Error';
		exit();
	}

}



