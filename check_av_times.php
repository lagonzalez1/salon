 <?php


include('server_connect.php');
include('employee_model.php');
date_default_timezone_set("America/Los_Angeles");
$current_time = date("h:i a");

//1. OBJ -> EmployeeName, AppoinmentDate, CurrentTime, EmployeeDaysOff, DateBasedNumberic
/*
<option value="None">Perferred stylist</option>
<option value="Stacy">Stacy Carrol</option>
<option value="Sam">Sam Jr</option>
<option value="Mary">Mary Jane</option>
<option value="Emily">Emily Valdovinos</option>
<option value="Karen">Karen Mayne</option>

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
            $stacy = ['09:00 am', '07:00 pm'];
            $day_off = [0,7];
            $obj = new employee($ee_empl,$ee_dat,$current_time,$day_off,$date_number );
            $obj->setTimeFrame($stacy);
        break;
        case 'Sam':
            $sam = ['07:30 am', '04:30 pm'];
            $day_off = [0,7];
            $obj = new employee($ee_empl,$ee_dat,$current_time,$day_off,$date_number );
            $obj->setTimeFrame($sam);
        break;
        case 'Mary':
            $mary = ['08:00 am', '06:00 pm'];
            $day_off = [0,7];
            $obj = new employee($ee_empl,$ee_dat,$current_time,$day_off,$date_number );
            $obj->setTimeFrame($mary);
        break;
        case 'Emily':
            $emily = ['08:00 am', '06:00 pm'];
            $day_off = [0,7];
            $obj = new employee($ee_empl,$ee_dat,$current_time,$day_off,$date_number );
            $obj->setTimeFrame($emily);
        break;
        case 'Karen':
            $karen = ['08:00 am', '06:00 pm'];
            $day_off = [0,2];
            $obj = new employee($ee_empl,$ee_dat,$current_time,$day_off,$date_number );
            $obj->setTimeFrame($karen);
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
                echo(json_encode(['Appointments Have Passed']));
                exit();
            break;
            case 2:
                // Future date
                echo (json_encode($obj->correctArrayTimeFrame() ));
                exit();
            break;
        }
 	}else{
         // Query Error
 		echo json_encode(['']);
 		exit();
     }
     
 	echo ( json_encode(['q']));
 	exit();

 }


 



