<?php
date_default_timezone_set("America/Los_Angeles");


class employee {
    var $empl;
    var $app_date;
    public $conflict_hours = array(); // Array of conflict hours, current appoinmtnets 
    public $current_time;
    public $arr_times_av = array('07:00 am','07:30 am','08:00 am','08:30 am','09:00 am','09:30 am', '10:00 am','10:30 am','11:00 am','11:30 am','12:00 pm','12:30 pm','01:00 pm','01:30 pm','02:00 pm','02:30 pm','03:00 pm',
    '03:30 pm','04:00 pm','04:30 pm','05:00 pm','05:30 pm','06:00 pm','06:30 pm','07:00 pm'); // Might need to include breaks and lunch breaks;
    public $time_frame = array();
    public $day_off = array(); // 0 sunday -> 6 saturday
    public $date_num;

    /*
    1. OBJ -> EmployeeName, AppoinmentDate, Conflict Hours(DB Return), CurrentTime, EmployeeTimeFrame, EmployeeDaysOff, DateBasedNumberic
    2. 



    */


    function __construct($name,$date_app, $conflict_hours, $current_time, $empl_timeframe, $days_off, $day_num){
        $this->empl = $name;
        $this->app_date = $date_app;
        $this->time_frame = $empl_timeframe;
        $this->conflict_hours = $conflict_hours;
        $this->current_time = $current_time;
        $this->day_off = $days_off;
        $this->date_num = $day_num;

     }


     function returnDate(){return date("m/d/o");}
     function returnTime(){return date("h:i:a");}
     
     function getEmpl() {return $this->empl;}
     function getDaySched() {return $this->day_sched;}
     function getHourSched() {return $this->hour_sched;}

     function correctArrayTimeFrame() {
         if ($key = array_search($this->date_num, $this->day_off)){
             // Current Date is day off
             $var = array('Day off for employee, try another date');
             return $var;
         }

         // Check if day off
         

         for($i =0; $i < count($this->arr_times_av);$i++){
             if(strtotime($this->arr_times_av[$i]) < strtotime($this->day_off[0]) ){
                 // Times less than start time
                 unset($this->arr_times_av[$i]);

             }
             if(strtotime($this->arr_times_av[$i]) < strtotime($this->day_off[0]) ){
                 // Greater than
                 unset($this->arr_times_av[$i]);
             }

            }
         return array_values($this->arr_times_av);
     }


     function correctBasedOnCurrentDate() {
        $corrected = correctArrayTimeFrame();
        if($this->)





     }

     function returnCorrectArray() {
         // Return array of dates available
         // Examine the array pushed into this
     }






}



