<?php

include('server_connect.php');
date_default_timezone_set("America/Los_Angeles");
$current_date = date("m/d/o");

if(isset($_POST['initial_launch'])){
	$stmt = "SELECT * FROM `client_upgrade` ORDER BY `Per_stylist` ASC, `App_Time` ASC; ";
	$arr_value = (array)null;
	$long_string = '';
	if($result = mysqli_query($connection , $stmt)){
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				// Keys To check
				// Per_stylist: No Prefrence
				// App_Time: Walk in
				$color_cordination = null;
				$id = $row['id'];
				$name = $row['Name'];
				$email = $row['Email'];
				$phone = $row['Phone'];
				$style = $row['Per_stylist'];
				$date = $row['App_Date'];
				$time = $row['App_Time'];
				$status = $row['Status'];

				if($style == 'General'){
					// Handle General Table somwhere else;
					continue;
				}
				// Only viewing appointments today
				if($current_date !== $date ){
						continue;
				}
				$st_color = null;
				$status_title = null;
				switch ($status) {
					case 0:
						$st_color = "text-danger";
						$status_title = "Not Checked in";
						break;
					case 1:
						$st_color = "text-success";
						$status_title = "Checked in";
						break;
					
					default:
						$st_color = "text-danger";
						$status_title = "Not Checked in";
						break;
				}
				switch ($style) {
					case 'Emily':
						$color_cordination = "table-danger"; // red;
						break;
					case 'Sam':
						$color_cordination = "table-success";
						break;
					case 'Mary':
						$color_cordination = "table-warning";
						break;
					case 'Karen':
						$color_cordination = "table-info";
						break;
					case 'Stacy':
						$color_cordination = "table-primary";
						break;
					default:
						$style = "No Prefrence";
						$color_cordination = "table-active";
						break;
				}
				$long_string .= '<tr class = '.$color_cordination.'>
			<td></td>
			<td><strong>'.htmlentities($style).'</strong></td>
			<td>'.htmlentities($name).'</td>
			<td>'.htmlentities($phone).'</td>
			<td>'.htmlentities($time).'</td>
			<td>'.htmlentities($date).'</td>
			<td class="'.$st_color.'">'.htmlentities($status_title).'</td>
			<td>
			<input type = "submit" class = "check btn btn-success btn-sm" id ='.$id.' name = "check" value = "Check-in">
			<input type = "submit" value ="Send Email" name = "email_send" id = '.$id.' class = "email_send btn btn-info btn-sm">
			<input type="submit" value="Remove" name ="remove" id ='.$id.' class ="remove btn btn-danger btn-sm">
			<input type="submit" value="Move Time" name="Time" id='.$id.' class = "btn btn-warning btn-sm">
			</td>
			</tr>';
			}
		}else {
			$long_string .=' <tr>
                <td>Empty list</td>
                </tr></tbody></table>';
		}
	}else {
		echo 'Result: Error';
		exit();
	}
echo $long_string;
exit();

}

if(isset($_POST['all_app_view'])){

	$stmt = "SELECT * FROM `client_upgrade` ORDER BY `Per_stylist` ASC; ";
	$arr_value = (array)null;
	$long_string = '';
	if($result = mysqli_query($connection , $stmt)){
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				// Keys To check
				// Per_stylist: No Prefrence
				// App_Time: Walk in
				$color_cordination = null;
				$id = $row['id'];
				$name = $row['Name'];
				$email = $row['Email'];
				$phone = $row['Phone'];
				$style = $row['Per_stylist'];
				$date = $row['App_Date'];
				$time = $row['App_Time'];
				

				if($style == 'General'){
					// Handle General Table somwhere else;
					continue;
				}
				$st_color = null;
			
				switch ($style) {
					case 'Emily':
						$color_cordination = "table-danger"; // red;
						break;
					case 'Sam':
						$color_cordination = "table-success";
						break;
					case 'Mary':
						$color_cordination = "table-warning";
						break;
					case 'Karen':
						$color_cordination = "table-info";
						break;
					case 'Stacy':
						$color_cordination = "table-primary";
						break;
					default:
						$style = "No Prefrence";
						$color_cordination = "table-active";
						break;
				}
				$long_string .= '<tr class = '.$color_cordination.'>
			<td></td>
			<td><strong>'.htmlentities($style).'</strong></td>
			<td>'.htmlentities($name).'</td>
			<td>'.htmlentities($phone).'</td>
			<td>'.htmlentities($email).'</td>
			<td>'.htmlentities($time).'</td>
			<td>'.htmlentities($date).'</td>
			</tr>';
			}
		}else {
			$long_string .=' <tr>
                <td>Empty list</td>
                </tr></tbody></table>';
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
