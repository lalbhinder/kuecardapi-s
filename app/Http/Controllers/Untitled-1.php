<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Day;
use App\User;
use Illuminate\Support\Carbon;
use App\Slot;

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
        if($day_check&&$user_check)
        {
            $status=true;
            $i=1;
            $start_time=$request->start_time;
            $end_time=$request->end_time;
            $a=explode(':',$start_time);
            // for($i=1;$i<=9;$i++)
            while ($status)
            {
                $b=$a[0]+$i;
                $i++;
                $end=$b.$a[1];
                // echo $start_time;
                // echo $end;
                // $schedule=new Slot();
                // $schedule->slot_start_time=$start_time;
                // $schedule->slot_end_time=$end;
                // $schedule->user_id=$user_check['id'];
                // $schedule->day_id=$day_check['id'];
                // $schedule->slot_end_time=$end;
                // $schedule->save();
                if($end_time==$end){
                    echo $status; die;
                    $status=false;
                }
                $start_time=$end;
                echo $start_time;
                echo $end;die;

            }
            // return response()->json(['status'=>200,'message'=>'slot set successfully']);
        }
        // else{
        //     return response()->json(['status'=>100,'message'=>'User id or day id does not exists']);

        // }

    }
}
