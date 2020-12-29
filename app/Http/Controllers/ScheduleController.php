<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Booking;
use App\Guest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Day;
use App\Company;
use App\User;
use Illuminate\Support\Carbon;
use App\Slot;
use Illuminate\Support\Facades\DB;
class ScheduleController extends Controller
{
    //
    public function GetDays()
    {
        $days=Day::all();
        return response()->json(['status'=>200,'message'=>'Day list generated successfully','data'=>$days]);
    }
    public function SetSlots(Request $request)
    {
        $day_id=$request->day_id;
        $user_id=$request->user_id;
        $day_check=Day::where('id',$day_id)->first();
        $user_id=Auth::user()->id;
        $user_check=User::where('id',$user_id)->first();
        if($day_check && $user_check)
        {
            $start_time=$request->start_time;
            $end_time=$request->end_time;
            $checkTime = strtotime($start_time);
            $loginTime = strtotime($end_time);
            $diff = $loginTime- $checkTime;
            $time_difference =  gmdate("H:i:s", $diff);
            // echo 'Time Difference : '. $time_difference;
            for($i=1;$i<=$time_difference;$i++)
            {
                $end = date('H:i:s', strtotime($start_time.'+1 hour'));
                $schedule=new Slot();
                $schedule->user_id=$user_check['id'];
                $schedule->day_id=$day_check['id'];
                $schedule->slot_start_time=$start_time;
                $schedule->slot_end_time=$end;
                $schedule->save();
                $start_time=$end;
            }
            $slots=Slot::where('user_id',$user_id)->get();
            // $data=[
            //     'slots'=>$slots,
            // ];

            return response()->json(['status'=>200,'message'=>'slot set successfully','data'=>$slots]);
        }
        else{
            return response()->json(['status'=>100,'message'=>'User id or day id does not exists']);
        }
    }
    public function ShowSlots(Request $request)
    {
        $user_id= Auth::user()->id;
        if($user_id){
            $results = User::with('slots.day','company')->where('id',$user_id)->first();
            return response()->json(['status'=>200,'message'=>'Slots list generated successfully','data'=>$results]);
        }
        else
        {
            return response()->json(['status' => 100, 'message'=>'User ID Does not Exists']);
        }
    }
    public function BookAppointment(Request $request)
    {
        $guest_id=$request->customer_id;
        $day_id=$request->day_id;
        $slot_id=$request->slot_id;
        $user_id=$request->user_id;
        $user_check=User::where('id',$user_id)->first();
        $guest_check=Guest::where('id',$guest_id)->first();
        $day_check=Day::Select('day_name')->where('id',$day_id)->first();
        $slot_check=Slot::Select('slot_start_time')->where('id',$slot_id)->first();
        $data=[
            'user'=>$user_check,
            'slot'=>$slot_check,
            'guest'=>$guest_check,
            'day'=>$day_check
        ];
        if($day_check&&$slot_check&&$user_check&&$guest_check){
            $booking=new Booking();
            $booking->customer_id=$guest_id;
            $booking->day_id=$day_id;
            $booking->slot_id=$slot_id;
            $booking->user_id=$user_id;
            $booking->date=$request->date;
            $booking->booking_status=$request->booking_status;
            $booking->save();
            return response()->json(['status'=>200,'message'=>'Appointment Booked successfully','data'=>$data,'booking_details'=>$booking]);
        }
        else{
            return response()->json(['status'=>100,'message'=>'Day id,customer_id,slot id or user_id does not exists']);
        }
    }
    public function UpcomingAppointments(Request $request)
    {
        $user_info=Auth::user();
        $guest =Booking::Select('*')
        ->join('guests','guests.id','=','bookings.customer_id')
        ->join('slots','slots.id','=','bookings.slot_id')
        ->where('bookings.date','>=',Carbon::now())
        ->where('bookings.user_id',Auth::user()->id)
        ->get();
        if(count($guest)>0)
        {
            $data=[
                'users'=>$user_info,
                'bookings_detail'=>$guest,
            ];
             return response()->json(['status' => 200, 'message'=>'User upcoming Appointments','data'=>$data]);
        }
        else
        {
            return response()->json(['status' => 100, 'message'=>'No Upcoming Appointments']);
        }
    }
    public function CancelAppointments(Request $request)
    {
        $user_info=Auth::user();
        if($user_info){

            $cancel_appointments= Booking::where('user_id',$user_info->id)->where('booking_status',0)->get();

            if(count($cancel_appointments)>0){
                $data=[
                    'cancel_appointments',$cancel_appointments,
                    'user_info',$user_info,
                ];
                return response()->json(['status' => 200, 'message'=>'User cancel Appointments','data'=>$data]);
            }
            else{
                return response()->json(['status' => 100, 'message'=>'No cancelled appointments']);

            }
        }

    }
}
