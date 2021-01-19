<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DatePeriod;
use DateTime;
use DateInterval;

class EventController extends Controller
{
    function index(){
        $eventscreated = $this->initialize_calendar();
        return view("webapp", compact("eventscreated"));
    }
    
    function event_creation(Request $request){
        //Validation
        $request->validate([
            "event_date_from" => "required",
            "event_date_to" => "required",
            "event" => "required",
            "days_week" => "array|required"
        ]);
        
        $startdate = $request->event_date_from;
        $enddate = $request->event_date_to;
        
        if($startdate > $enddate){
            return back()->withErrors("The end date should be greater than the start date.");
        }
        
        //reset the table
        $records = \App\Event::get();
        if(!$records->isEmpty()){
            foreach($records as $record){
                $record->delete();
            }
        }
        
        //I separated it as this serves as a different functionality and for cleanliness of code.
        $events = $this->getDates($startdate, $enddate, $request->days_week);
        
        if(count($events) > 0){
            foreach($events as $dateselected){
                $addrecord = new \App\Event;
                $addrecord->event_date = $dateselected;
                $addrecord->description = $request->event;
                $addrecord->save();
            }
        }
        
        return back()->withSuccess("Event Successfully Saved")->withInput();
    }
    
    function getDates($startdate, $enddate, $days_of_week){
        //From the DatePeriod a class to generate a set of date range. I only added the needed dates depending on the user selection of the days of the week as a basis for saving on the events table.
        
        $enddate = new DateTime($enddate);
        $enddate = $enddate->modify("+1 day");
        
        $dates = array();
        $daterange = new DatePeriod(new DateTime($startdate),new DateInterval('P1D'),$enddate);
        
        foreach($daterange as $key=>$value){
            foreach($days_of_week as $day){
                if($value->format('l') == $day){
                   $dates[] = $value->format("Y-m-d");
                }
            }
        }
        
        return $dates;
    }
    
    public static function initialize_calendar(){
        //What I did here is to convert the data from the events table to the event sources object needed to initialize the full calendar.
        
        $event_array[] = array();
        $schedules = \App\Event::get();
           if(!empty($schedules)){
               foreach($schedules as $schedule){
                   $event_array[] = array(
                       'id' => uniqid(),
                       'title' => $schedule->description,
                       'start' => date('Y-m-d', strtotime($schedule->event_date)),
                       'end' => date('Y-m-d', strtotime($schedule->event_date)),
                       'color' => "lightblue",
                       "textEscape"=> 'false' ,
                       'textColor' => 'black',
                   );
               }
               return $get_schedule = json_encode($event_array);
           }
    }
}
