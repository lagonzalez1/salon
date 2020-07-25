<?php

include('server_connect.php');

if(!isset($_GET['all_app'])){
	$no = "NO";
	exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Company Name</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>   
  	<link href = "https://code.jquery.com/ui/1.10.4/themes/cupertino/jquery-ui.css" rel = "stylesheet">
  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.css" />
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.min.js"></script>    
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://kit.fontawesome.com/fd1affcb0c.js" crossorigin="anonymous"></script>

</head>
<body>

	<hr class="hr">

<div class = main_table id = "s_0">
	<table class="table table-hover table-bordered table">
	  <thead class="thead-light">
	    <tr>
	      <th scope="col">#</th>
        <th scope="col">Stylist</th>
	      <th scope="col">Name</th>
	      <th scope="col">Phone Number</th>
        <th scope="col">Time</th>
        <th scope="col">Date</th>
        <th scope="col">Actions</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  	$long_string = '';
	$stmt = "SELECT * FROM `client_upgrade` ORDER BY `Per_stylist` ASC; ";
	if($result = mysqli_query($connection, $stmt)){
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_asso($result)){
				$id = $row['id'];
				$name = $row['Name'];
				$email = $row['Email'];
				$phone = $row['Phone'];
				$style = $row['Per_stylist'];
				$date = $row['App_Date'];
				$time = $row['App_Time'];

				$long_string .= '<tr>
			<td></td>
			<td><strong>'.htmlentities($style).'</strong></td>
			<td>'.htmlentities($name).'</td>
			<td>'.htmlentities($phone).'</td>
			<td>'.htmlentities($time).'</td>
			<td>'.htmlentities($date).'</td>
			<td>
			</tr>';
			}
		}else{
			$long_string .= '<td>Empty List</td>';
		}
		}
	  	echo $long_string;

	  	?>

	  </tbody>
</table>
</div>

<hr class="hr">
	


</body>

</html>