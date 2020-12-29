<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Support\Facades\DB;
use App\Qr;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function Counter(Request $request)
    {
        $qr=Qr::where('user_id',$request->user_id)->first();
        $booking=Booking::where('user_id',$request->user_id)->first();
        if($qr&&$booking)
        {
            // for scan counter
            $qr_counter=$qr['scan_counter']+1;
            $qr_counter_update=DB::table('qrs')->where('user_id',$request->user_id)
            ->update(['scan_counter'=>$qr_counter]);  
            // for booking counter
            $get_booking=Booking::get();
            $booking_counter=count($get_booking);
            $booking_counter_update=DB::table('qrs')->where('user_id',$request->user_id)
            ->update(['appointment_counter'=>$booking_counter]); 
            //  
            $data=[
               'qr_counter'=> $qr_counter,
               'booking_counter'=> $booking_counter, 
            ];
            return response()->json(['status'=>200,'data'=>$data]);
        }
        else{
        return response()->json(['status'=>100,'message'=>'user id does not exists']);
        }     
    }
}

