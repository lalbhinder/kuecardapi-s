<?php

namespace App\Http\Controllers;

use App\Qr;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;

class QrController extends Controller
{
    //
    public function Qr(Request $request,$length=80)
    {
        // $qr_code_string=QrCode::size(10)->generate('MyNotePaper');
        $user_id=Auth::user()->id;
        if($user_id==$request->user_id){
        $qr_code_string='0123456uvwdefhixyzABCDuvABCDwABCDxyz7hi89!@#$%^&*abc'.time().'defABCDghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVABCDWXYZ!@#$%^&*'.time().$user_id;
        $num = substr(str_shuffle(str_repeat($qr_code_string,80)), 0, $length);
        $check_user=User::where('id',$request->user_id)->first();
            if($check_user)
            {
                //  echo 'abc'; die;
                $show_qr=Qr::where('user_id',$request->user_id)->select('qr')->first();
                if (!empty($show_qr)){
                return response()->json(['status'=>200,'message'=>'Qr code exists against this user','qr'=>$show_qr->qr]);
                }
                else{
                    $qr=new Qr();
                    $qr->user_id= $check_user['id'];
                    $qr->qr=$num;
                    $qr->save();
                    return response()->json(['status'=>200,'message'=>'Qr code generated successfully','qr'=>$qr]);
                }
            }
            else{
                return response()->json(['status'=>100,'message'=>'User Id does not exists']);
            }
        }
        else{

            return response()->json(['status'=>100,'message'=>'plz enter a user_id']);
        }

    }
}
