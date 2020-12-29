<?php

namespace App\Http\Controllers;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Hash;
use App\User;


class ForgotController extends Controller
{

    public function ForgetPassword(Request $request,$length=8)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => 100], 500);
        }
        if($request->has('email'))
        {
            $check_email=User::where('email',$request->email)->first();
            $this->user_email=$request->email;
            if($check_email)
            {
                $string='0123456rstuvwxyz789GHIJKLMN!@#$%^&*abcdefghijklmnopKrstuvwxyzLMNOPQRSTqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*';
                $num = substr(str_shuffle(str_repeat($string, 8)), 0, $length);
                $new_password=Hash::make($num);
                $update_password= User::where('email',$request->email)
                ->update(['password'=>$new_password]);
                $to = $request->email;
                $subject = "Password Reset email";
                $message = "
                <html>
                <head>
                <title>HTML email</title>
                </head>
                <body>
                <h1>Here is your new Password!</h1>
                <p>".$num."</p>
                </body>
                </html>
                ";
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                // More headers
                $headers .= 'From: <hamza.bashir@appcrates.com>' . "\r\n";
                $sent_email=mail($to,$subject,$message,$headers);
                if($sent_email)
                {
                    return response()->json(['status'=>200,'message'=>'A Password has sent to your email.Login with a new one..']);
                }
                else
                {
                    return response(['status'=>100,'message'=>'wrong password!, Request For a new one..']);
                }
            }
            else
            {
                return response()->json(['status'=>100,'message'=>'Email Does not Exist']);
            }
        }
    }



    // public function change_password(Request $request)
    // {
    //     $input = $request->all();
    //     $userid = Auth::guard('api')->user()->id;
    //     $rules = array(
    //         'old_password' => 'required',
    //         'new_password' => 'required|min:6',
    //         'confirm_password' => 'required|same:new_password',
    //     );
    //     $validator = Validator::make($input, $rules);
    //     if ($validator->fails()) {
    //         $arr = array("status" => 100, "message" => $validator->errors()->first(), "data" => $rules);
    //     } else {
    //         try {
    //             if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {
    //                 $arr = array("status" => 400, "message" => "Check your old password.", "data" => array());
    //             } else if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {
    //                 $arr = array("status" => 400, "message" => "Please enter a password which is not similar then current password.", "data" => array());
    //             } else {
    //                 User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
    //                 $arr = array("status" => 200, "message" => "Password updated successfully.", "data" => array());
    //             }
    //         } catch (\Exception $ex) {
    //             if (isset($ex->errorInfo[2])) {
    //                 $msg = $ex->errorInfo[2];
    //             } else {
    //                 $msg = $ex->getMessage();
    //             }
    //             $arr = array("status" => 400, "message" => $msg, "data" => array());
    //         }
    //     }
    //     return \Response::json($arr);
    // }



}











