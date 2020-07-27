 <?php


include('server_connect.php');
date_default_timezone_set("America/Los_Angeles");


$arr_times_av = array(
	'09:00:am', '09:30:am', '10:00:am','10:30:am','11:00:am','11:30:am','12:00:pm','12:30:pm','01:00:pm','01:30:pm','02:00:pm','02:30:pm','03:00:pm',
    '03:30:pm','04:00:pm', '04:30:pm','05:00:pm', 
	'05:30:pm', '06:00:pm');


$current_time = date("h:i:a");

 if(isset($_POST['date']) || isset($_POST['empl']) ){
 	$return_arr = (array)null;
 	$ee_empl = $_POST['empl'];
 	$ee_dat = $_POST['date'];
 	$current_date = date("m/d/o");
 	$stmt = "SELECT * FROM `client_upgrade` WHERE Per_stylist='$ee_empl' AND App_Date='$ee_dat';";

 	if($result = mysqli_query($connection, $stmt)) {
 		if(mysqli_num_rows($result) > 0){
 			while($row = mysqli_fetch_assoc($result)){
 				$conflict_t = $row['App_Time'];
        // Remove from array
 				if ($key = array_search($conflict_t, $arr_times_av) ){
 					unset($arr_times_av[$key]);
 					continue;
 				}
 			}
 		}else{
 			// No Affected rows
 			// Everything is open for this Date and Person.
 			echo ( json_encode(remove_past_times($arr_times_av, $ee_dat) ) );
 			exit();
 		}
 	}else{
 		echo $result;
 		exit();
 	}

 	echo ( json_encode(remove_past_times($arr_times_av, $ee_dat) ));
 	exit();

 }


 function remove_past_times($array, $app_date) {
    $var_set_array = array_values($array);
 	  $current_date = date("m/d/o");
    global $current_time;

    // Make sure remove past time only affectst current day
    if($current_date != $app_date ){
        return array_values($var_set_array);
    }

    $arr_time = explode(":",$current_time);
    $hour = $arr_time[0];
    $minute_tt = $arr_time[1];
    $am_pm = $arr_time[2];
    $keys = (array)null;

    for ($i = 0 ; $i < count($var_set_array); $i++){
        // Check current hour with hours in array
        if($hour === $app_hour = explode(":", $var_set_array[$i])[0] ){
            // Check current am-pm to array values, 
            // This will call twice
            if($am_pm === $app_am_pm = explode(":", $var_set_array[$i])[2] ){
            
                if($minute_tt < 30){
                   if($arr_min = explode(":", $var_set_array[$i])[1]  == 00){
                        array_push($keys, $i);
                   }else{
                       continue;
                   }       
                }else if($minute_tt > 30){
                   
                   if($arr_min = explode(":", $var_set_array[$i])[1]  == 30){
                       array_push($keys, $i);
                   }
                   
               }
            }
        }
    }

    if(count($keys) == 0 ){
       return array_values($var_set_array);
    }

    $var_remove = $keys[0];

    for ($i=0; $i < $var_remove; $i++){
        unset($var_set_array[$i]);
    }

    return array_values($var_set_array);
 }




