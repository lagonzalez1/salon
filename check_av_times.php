 <?php


include('server_connect.php');
date_default_timezone_set("America/Los_Angeles");


$arr_times_av = array(
	'09:00:am', '09:30:am', '10:00:am','10:30:am','11:00:am','11:30:am','12:00:pm','12:30:pm','01:00:pm','01:30:pm','02:00:pm','02:30:pm', '03:00:pm',
    '03:30:pm','04:00:pm', '04:30:pm','05:00:pm', 
	'05:30:pm', '06:00:pm', '06:30:pm');


$arr_time_am = array('09:00:am', '09:30:am', '10:00:am','10:30:am','11:00:am','11:30:am');
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
                
 				if ($key = array_search($conflict_t, $arr_times_av) ){
 					unset($arr_times_av[$key]);
 					continue;
 				}
 			}
 		}else{
 			// No Affected rows
 			// Everything is open for this Date and Person.
 			echo ( json_encode(array_values($arr_times_av)) );
 			exit();
 		}


 	}else{
 		echo $result;
 		exit();
 	}

 	echo ( json_encode(array_values($arr_times_av)) );
 	exit();

 }


 function remove_past_times($current_time) {
 	$current_date = date("m/d/o");



 }



 /*

$arr_times_av = array(
	'09:00:am', '09:30:am', '10:00:am','10:30:am', '12:00:pm', '12:30:pm','01:00:pm', '01:30:pm','02:00:pm','02:30:pm', '03:00:pm', '03:30:pm','04:00:pm', '04:30:pm','05:00:pm', 
	'05:30:pm', '06:00:pm', '06:30:pm');
	
	
function remove_non(){
$current_date = date("m/d/o");
$current_time = date("h:i:a");
global $arr_times_av;

$arr = explode(":",$current_time);
$hour = $arr[0];
$minute_tt = $arr[1];
$am_pm = $arr[2];


for($i = 0 ; $i < count($arr_times_av); $i++){
    
    if($hour === $secH = explode(":",$arr_times_av[$i])[0] ){
        if($am_pm === $ap = explode(":",$arr_times_av[$i])[2] ){
            
            $tt = explode(":", $arr_times_av[$i])[1];
            if($minute_tt < $tt){
                // Return the key
                return $i;
            }else{
                // Return key ++;
                $count = count($arr_times_av);
                $ii_val = $i + 1;
                if($count > $ii_val){
                    return $count - 1;
                }else{
                    return $i + 1;
                }
                
                
            }
        
        }
    }
}

return 0;
}



echo remove_non();






 */
