<?php

date_default_timezone_set("America/Los_Angeles");

class employee {
    var $empl;
    public $appointment_date;
    public $conflict_hours = array(); // Array of conflict hours, current appoinmtnets 
    public $current_time;
    public $arr_times_av = array('07:00 am','07:30 am','08:00 am','08:30 am','09:00 am','09:30 am', '10:00 am','10:30 am','11:00 am','11:30 am','12:00 pm','12:30 pm','01:00 pm','01:30 pm','02:00 pm','02:30 pm','03:00 pm',
    '03:30 pm','04:00 pm','04:30 pm','05:00 pm','05:30 pm','06:00 pm','06:30 pm','07:00 pm'); // Might need to include breaks and lunch breaks;
    public $diff_interval = array('07:00 am', '07:45 am', '08:30 am', '09:15 am', '10:00 am', '10:45 am','11:30 am','12:15 pm','01:00 pm','01:45','02:30 pm','03:15 pm','04:00 pm','04:45 pm','05:30 pm','06:15 pm','07:00 pm','07:45 pm');
    public $time_frame = array();
    public $day_off = array(); // 0 sunday -> 6 saturday
    public $date_num;
    public $lunch_start;
    public $lunch_end;
    public $howMany;
    public $boolDiffInterval = false;
    /*
    1. OBJ -> EmployeeName, AppoinmentDate, CurrentTime, EmployeeDaysOff, DateBasedNumberic
    2. 
    */
    function __construct($name, $date_app, $current_time, $days_off, $day_num, $boolDif){
        $this->empl = $name;
        $this->appointment_date = $date_app;
        $this->current_time = $current_time;
        $this->day_off = $days_off;
        $this->date_num = $day_num;
        $this->boolDiffInterval = $boolDif;
         
        // If this is false, Appointment is for another date
        // If true, Appointment is for today and we need to remove times passed;

     }

     public function setConflictArray($c_array) {$this->conflict_hours = $c_array;}
     public function setTimeFrame($timeFrame){$this->time_frame = $timeFrame;}

     // Set lunch time for Emp
     public function setLunchBreak($time, $end, $duration) {
         $this->lunch_start = $time; 
         $this->lunch_end = $end;
         $this->howMany = $duration;
         

        // Asign new Array to old array based on Employee choice
        if($this->boolDiffInterval){
            // Per 30 minute appointments
            if($this->howMany === 30){
                $key = array_search($this->lunch_start,$this->diff_interval, true);
                if($key !== false){
                    unset($this->diff_interval[$key]);
                    // For some reason you cannot array_values() here
                }
            }
            if($this->howMany === 1){
                $key = array_search($this->lunch_start,$this->diff_interval, true);
                if($key !== false){
                    unset($this->diff_interval[$key]);
                    unset($this->diff_interval[$key + 1]);
                    // For some reason you cannot array_values() here
                }
            }
        }else {
            // Regular time frame
            // Per 30 minute appointments
            if($this->howMany === 30){
                $key = array_search($this->lunch_start,$this->arr_times_av, true);
                if($key !== false){
                    unset($this->arr_times_av[$key]);
                    // For some reason you cannot array_values() here
                }
            }
            if($this->howMany === 1){
                $key = array_search($this->lunch_start,$this->arr_times_av, true);
                if($key !== false){
                    unset($this->arr_times_av[$key]);
                    unset($this->arr_times_av[$key + 1]);
                    // For some reason you cannot array_values() here
                }
            }

        }
    }

     function returnDate(){return date("m/d/o");}
     function returnTime(){return date("h:i:a");}
     
     function getEmpl() {return $this->empl;}
     function getDaySched() {return $this->day_sched;}
     function getHourSched() {return $this->hour_sched;}

     public function correctArrayTimeFrame() {
        if ($key = array_search($this->date_num, $this->day_off)){
            // Current Date is day off
            $var = array('Day off for employee, try another date');
            return $var;
        }
        
        $arr_copy = $this->arr_times_av;
        
        if($this->boolDiffInterval){
            // Assign Different Array based on 45 min intervals
            $arr_copy = $this->diff_interval;
        }

       $copyArr = array_values($arr_copy);
       $bad_times = (array)null;
       
       // Find bad times according to the time frame, Start End
        for($i =0; $i < count($copyArr);$i++){
            if(strtotime($copyArr[$i]) < strtotime($this->time_frame[0]) ){
                // Times less than start time
               array_push($bad_times,$copyArr[$i]);
               continue;

            }
            if(strtotime($copyArr[$i]) > strtotime($this->time_frame[1]) ){
                // Greater than
                array_push($bad_times,$copyArr[$i]);
                continue;
            }

        }
            // Iterate and search for all bad times array
           for ($i=0; $i < count($bad_times) ;$i++){
               $key = array_search($bad_times[$i],$copyArr);
               if($key !== false){
                   unset($copyArr[$key]);
               }
           }
        return $this->returnCorrectFinalArray($copyArr);
    }

    // Check if current time is greater than the last item in array
    public function checkIfPassed(){
        $ll = $this->correctBasedOnCurrentDate();
        $ss = $this->current_time;
        $checker = strtotime(end($ll));
        // Check if array is empty -> Will return false
        if(!$checker){ return 0; }
        return (strtotime($ss) > strtotime(end($ll)) );
    }

    public function appIsToday(){
        // Check if current time is passed current appointment times
        if( ($this->returnDate() == $this->appointment_date) && $this->checkIfPassed() ){
            return 1; // CURRENT TIME > ALL TIMES Empty Array
        }
        if($this->returnDate() == $this->appointment_date){
            return 0;// Still within
        }
        if($this->returnDate() != $this->appointment_date){
            return 2; 
        }  
        if( ($this->returnDate() == $this->appointment_date) && $this->checkIfPassed() == 0 ){
            return 3; // Appointments are booked!
        }     
    }

    // This is only called if its the current date
    // This calles two functions
    // We are removing values up untill the current time
    function correctBasedOnCurrentDate() {
            // We have to remove based on time;
        $counter = 0;
        // Return array from class Based on time frame
        $corrected = $this->correctArrayTimeFrame();
        for($i= 0; $i < count($corrected);$i++){
                //echo $corrected[$i];    
            if(strtotime($corrected[$i]) < strtotime($this->current_time)){
                //echo $corrected[$i];
                $counter ++;
                continue;
            }     
        }
        $vv = array_slice($corrected, $counter); // remove up untill the < current time
        if(count($vv) == 0){
            return ['No times Available'];
        }
        
        // Remove for lunch break;
        return array_values($vv);
    }

     // Returns Array with all confilcted ours out. (Based off DB) (conflict_hours) is Array
     // Also before we hit this function we removed all appointmets outside of time frame.
    function returnCorrectFinalArray($array_corrected) {
         // Check array of conflicted hours
         // If greater than 0 we remove
        array_values($array_corrected);
         if(count($this->conflict_hours) > 0){
            for($i =0 ; $i < count($this->conflict_hours);$i++){
                $key = array_search($this->conflict_hours[$i], $array_corrected);
                if($key !== false){
                    unset($array_corrected[$key]);
                    continue;
                }
            }
            return array_values($array_corrected);
         }else {
             // No conflicts based on DB
             return array_values($array_corrected);
         }
         
    }




}



