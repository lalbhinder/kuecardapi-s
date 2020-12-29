<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use PDF;
use App\User;
use App\Service;
use App\c;
use Illuminate\Http\Request;
use File;
use Storage;
use Mail;
use Illuminate\Support\Facades\Auth;
use App\Setting;
use App\Web_common;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    public function forgetpassword(Request $request)
    {
        $email=$request->email;
        $user=User::where('email',$email)->first();
        if(!is_null($user))
        {
            $hashed_random_password = str_random(8);
            $uss=User::where('email',$email)->update(['password'=>Hash::make($hashed_random_password),
            ]);
            $to = $request->email;
            $subject = "Password Reset";
            $message = "<html>
            <head>
            <title>HTML email</title>
            </head>
            <body>
            <h2>Your New Password!</h2>
            <h1 style=color:#f50000>$hashed_random_password</h1>
            </body>
            </html>";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: bilal.sheikh@appcrates.com' . "\r\n";

            mail($to, $subject, $message, $headers);
            return response()->json(['status'=>"200",'description'=> "forget password",'message'=>"success",'data'=>'email send successfully']);
        }
        else
        {
            return response()->json(['status'=>"400",'description'=> "forget password",'message'=>"error",'data'=>'no such user exist']);
        }
    }

    public function logins(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $messages = array('email.required' => 'Please enter email',
                        'password.required' => 'Please enter password',
                        );
        $rules = array('email' => 'required|email',
                        'password' => 'required',
                    );
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails())
        {
            return redirect('/')->withErrors($validator)->withInput();
        }
        $data=array ( 'email' => $email,'password' => $password );
        if (Auth::attempt($data))
        {
            return redirect('/dashboard');
        }
        else
        {
            Session::flash ( 'message', "Invalid Credentials , Please try again." );
            return redirect()->back();
        }
    }

    public function change_password()
    {
        return view('change_password_view');
    }
    public function sendPasswordVar(Request $request)
    {
        // echo'zb'; die;
        $data=$request->all();
        $oldpassword = $data['oldPassowrd'];
        $newpassword = $data['newPassowrd'];
        $confermpassword = $data['confermPassowrd'];
        $user = Auth::User();
        if($newpassword == $confermpassword)
        {
            $current_password = $user->password;
            if (Hash::check($oldpassword, $current_password))
            {
                $newpassword = Hash::make($newpassword);
                $user_id = $user->id;
                $data=array("password"=> $newpassword);
                $newpassword = Web_common::newpassword($user_id,$data,"users");
                return  redirect('/');
            }
            else
            {
                return  redirect()->back()->with('message', 'Old Password is Incorect..!');
            }
        }
        else
        {
          return  redirect()->back()->with('message', 'Your Password In Not Match..!');
        }
     }

    public function get_logout()
    {
        Auth::logout();
        return redirect()->intended('/');
    }

    public function email_send(Request $request)
    {
        $email_send=User::where('email',$request->email)->first();
        if(is_null($email_send))
        {
            return response()->json('null');
        }
        else
        {
            $hashed_random_password = str_random(8);
            $email_submit=User::where('id',$email_send->id)->update(['password'=>Hash::make($hashed_random_password),
            ]);

            $to = $request->email;
            $subject = "Password Reset";
            $message = "<html>
            <head>
            <title>HTML email</title>
            </head>
            <body>
            <h2>Your New Password!</h2>
            <h1 style=color:#f50000>$hashed_random_password</h1>
            </body>
            </html>";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: bilal.sheikh@appcrates.com' . "\r\n";
            mail($to, $subject, $message, $headers);
            return response()->json('send');
        }
    }

    public function send_mail($text,$email)
    {
        $data = array('text'=>$text, "name" => "hahahaha");
        $to=$email;
        Mail::to($to)->send(new ReplyMail($data));
        echo "Your Msg have been send to user via email";
    }

/******************************* User *************************************/

}
