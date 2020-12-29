<?php

namespace App\Http\Controllers;
use App\User;
use hash;
use Illuminate\Support\Facades\Validator;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    //
    public function Contact(Request $request)
    {
        $user_email= Auth::user()->email;
        // $validator = Validator::make($request->all(), [
        //     'message' => 'required'
        // ]);
        // if ($validator->fails()) {
        //     return response()->json(['message' => $validator->errors()->first(), 'status' => 100], 500);
        // }
        // if($request->has('message'))
        // {
            // $client_message =$request->message;
            $to ='hello@cuecard.com';
            $subject = "New Message From Kuecard Client";
            $message = "
            <html>
            <head>
            <title>HTML email</title>
            </head>
            <body>
            <h1>KueCard Customer Message</h1>
            </body>
            </html>
            ";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= $user_email. "\r\n";
            $sent_email=mail($to,$subject,$message,$headers);
          return response()->json(['status'=>200,'message'=>'Message has been sent successfully.We will contact you back shortly.']);

            // if($sent_email)
            // {
            //     return response()->json(['status'=>200,'message'=>'Message has been sent successfully.We will contact you back shortly.']);
            // }

        // }
    }
}
