<?php
date_default_timezone_set("America/Los_Angeles");


class employee {
    var $name;
    var $day_sched;
    var $hour_sched;

    const arr_times_av = array('08:00:am','08:30:am','09:00:am','09:30:am', '10:00:am','10:30:am','11:00:am','11:30:am','12:00:pm','12:30:pm','01:00:pm','01:30:pm','02:00:pm','02:30:pm','03:00:pm',
    '03:30:pm','04:00:pm','04:30:pm','05:00:pm','05:30:pm', '06:00:pm','07:00:pm'); // Might need to include breaks and lunch breaks;

    // 1. Constructer must input the query 
    // 2. iterate and check if any dates are taken from this arra
    // 3. Remove values based on 1,2.
    // 4.  if current date == date_app - > remove based on time as well
    // 5. Remove any passed dates


    function __construct( $name, $day_s, $hour_s, $date_app){
        $this->name = $name;
        $this->day_sched = $day_s;
        $this->hour_sched = $hour_s;
     }
     function returnDate(){return date("m/d/o");}
     function returnTime(){return date("h:i:a");}
     
     function getEmpl() {return $this->name;}
     function getDaySched() {return $this->day_sched;}
     function getHourSched() {return $this->hour_sched;}

     function returnCorrectArray() {
         // Return array of dates available
         // Examine the array pushed into this
     }



}



