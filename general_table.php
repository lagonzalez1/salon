<?php


include('server_connect.php');

if(isset($_POST['initial_launch'])){
	$stmt = "SELECT * FROM `client_upgrade` ORDER BY `App_Time` ASC; ";
	$long_string = '';
	$it = 0;
	if($result = mysqli_query($connection, $stmt)){
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				if($row['Per_stylist'] == 'General'){
					// return html to second table
					$color_cordination = "table-primary";
					$id = $row['id'];
					$name = $row['Name'];
					$email = $row['Email'];
					$phone = $row['Phone'];
					$style = $row['Per_stylist'];
					$date = $row['App_Date'];
					$time = $row['App_Time'];

					$long_string .= '<tr class='.$color_cordination.'>
			<td>'.$it++.'</td>
			<td><strong>'.htmlentities($style).'</strong></td>
			<td>'.htmlentities($name).'</td>
			<td>'.htmlentities($phone).'</td>
			<td>'.htmlentities($time).'</td>
			<td>'.htmlentities($date).'</td>
			<td>
			<input type = "submit" class = "check btn btn-success btn-sm" id ='.$id.' name = "check" value = "Check-in">
			<input type = "submit" value ="Send Email" name = "email_send" id = '.$id.' class = "email_send btn btn-info btn-sm">
			<input type="submit" value="Remove" name ="remove" id ='.$id.' class ="remove btn btn-danger btn-sm">
			<input type="submit" value="Move Time" name="Time" id='.$id.' class = "btn btn-warning btn-sm">
			</td>
			</tr>';

				}
			}
		}

	}


}


echo 'Restricted';
exit();

/*(
		<th scope="col">#</th>
        <th scope="col">Stylist</th>
        <th scope="col">Name</th>
        <th scope="col">Phone Number</th>
        <th scope="col">Time</th>
        <th scope="col">Date</th>
        <th scope="col">Actions</th>


*/