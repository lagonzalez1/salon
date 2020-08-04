 <?php
include('server_connect.php');
include('employee_model.php');
date_default_timezone_set("America/Los_Angeles");
$current_time = date("h:i a");


/* Example Employee: 
Start Time: 9:00 am
[Lunch from 01:00 pm, 30 min -> 1:30 pm] 
Last appointment : 05:30 pm [End Shift at 6:00pm]
*/

/*
 45 minute interval MUST match END times and START Times;
 ALSO: LUNCH BREAKS
 This interval might have an exeption because 45 minutes will cover lunch
 We would just remove at the start time

 S: 01:45 pm 
 E: 30min or 45min 1hr(might need to alter code)

*/

$date_number = date('w');
 if(isset($_POST['date']) || isset($_POST['empl']) ){
    
    $conflict_array = (array)null;
    $emptyArr = array('No Times Available');
 	$ee_empl = $_POST['empl'];
 	$ee_dat = $_POST['date'];
    $current_date = date("m/d/o");
    global $current_time;
    switch($ee_empl){
        case 'Stacy':
            $stacy = ['09:00 am', '07:00 pm']; // Work schedule
            $day_off = [0,7];
            $obj = new employee($ee_empl,$ee_dat,$current_time,$day_off,$date_number );
            $obj->setTimeFrame($stacy);
            $obj->setLunchBreak('01:00 pm','01:30 pm',30);
            
        break;
        case 'Sam':
            $sam = ['07:30 am', '04:30 pm'];
            $day_off = [0,7];
            $obj = new employee($ee_empl,$ee_dat,$current_time,$day_off,$date_number );
            $obj->setTimeFrame($sam);
            $obj->setLunchBreak('12:00 pm','01:00 pm', 1);
            
        break;
        case 'Mary':
            $mary = ['08:00 am', '06:00 pm'];
            $day_off = [0,7];
            $obj = new employee($ee_empl,$ee_dat,$current_time,$day_off,$date_number );
            $obj->setTimeFrame($mary);
            $obj->setLunchBreak('11:30 am','12:00 pm', 30);
            
        break;
        case 'Emily':
            $emily = ['08:00 am', '06:00 pm'];
            $day_off = [0,7];
            $obj = new employee($ee_empl,$ee_dat,$current_time,$day_off,$date_number );
            $obj->setTimeFrame($emily);
            $obj->setLunchBreak('01:00 pm','01:30 pm',30);
            
        break;
        case 'Karen':
            $karen = ['08:00 am', '06:00 pm']; // Start time , Last appointment 
            $day_off = [0,2];
            $obj = new employee($ee_empl,$ee_dat,$current_time,$day_off,$date_number );
            $obj->setTimeFrame($karen);
            $obj->setLunchBreak('01:00 pm','01:30 pm',30);
            
        break;
    }
 	$stmt = "SELECT * FROM `client_upgrade` WHERE Per_stylist='$ee_empl' AND App_Date='$ee_dat';";
 	if($result = mysqli_query($connection, $stmt)) {
 		if(mysqli_num_rows($result) > 0){
 			while($row = mysqli_fetch_assoc($result)){
 				$conflict_t = $row['App_Time'];
                array_push($conflict_array,$conflict_t);
                continue;
 			}
 		}else{
 			// No Affected rows
             // Everything is open for this Date and Person.
            switch($obj->appIsToday()){
                case 0:
                    // Passed last hour on same day
                    echo (json_encode($obj->correctBasedOnCurrentDate() ));
                    exit();
                    break;
                case 1:
                    // Today Appointment toCorrect
                    echo(json_encode($emptyArr));
                    exit();
                    break;
                case 2:
                    // Future date
                    echo (json_encode($obj->correctArrayTimeFrame() ));
                    exit();
                break;
                case 3:
                    // Future date
                    echo (json_encode(['Completely Booked!']));
                    exit();
                    break;
            }
         }
         // Add to examine Array
         $obj->setConflictArray($conflict_array);
         switch($obj->appIsToday()){
            case 0:
                // Passed last hour on same day
                echo (json_encode($obj->correctBasedOnCurrentDate() ));
                exit();
                break;
            case 1:
                // Today Appointment toCorrect
                echo(json_encode(['No Appoinments Available for today']));
                exit();
                break;
            case 2:
                // Future date
                echo (json_encode($obj->correctArrayTimeFrame() ));
                exit();
                break;
            case 3:
                // Future date
                echo (json_encode(['Completely Booked!']));
                exit();
                break;
        }
 	}else{
         // Query Error
 		echo json_encode(['Query Error']);
 		exit();
     }
     
 	echo ( json_encode(['q']));
 	exit();

 }


 



