<?php

include('server_connect.php');

if(isset($_POST['initial_launch'])){
	$stmt = "SELECT * FROM `client_upgrade` ORDER BY `Per_stylist` ASC; ";
	$arr_value = (array)null;
	$long_string = '';
	if($result = mysqli_query($connection , $stmt)){
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				$id = $row['id'];
				$name = $row['Name'];
				$email = $row['Email'];
				$phone = $row['Phone'];
				$style = $row['Per_stylist'];
				$date = $row['App_Date'];
				$time = $row['App_Time'];
				$long_string .= '<tr>
		
			<td></td>
			<td>'.htmlentities($name).'</td>
			<td>'.htmlentities($phone).'</td>
			<td>'.htmlentities($time).'</td>
			<td>'.htmlentities($style).'</td>
			<td>'.htmlentities($date).'</td>
			<td>
			<input type = "submit" class = "check btn btn-success btn-sm" id ='.$id.' name = "check" value = "Check-in">
			<input type = "submit" value ="Send Email" name = "email_send" id = '.$id.' class = "email_send btn btn-info btn-sm">
			<input type="submit" value="Remove" name ="remove" id ='.$id.' class ="remove btn btn-danger btn-sm">
			</td>
			</tr>';
			}
		}
	}else {
		echo 'Result: Error';
		exit();
	}
echo $long_string;
exit();

}

echo "Restricted";
header("Location: error_restricted.html");
exit();
