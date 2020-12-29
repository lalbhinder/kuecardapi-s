<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use App\User;
use Illuminate\Support\Facades\Validator;
Use DB;
Use Hash;

class LoginController extends Controller
{
    // Login Api Functoin
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|',
            'password'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => 100], 500);
        }
        if($request->has('email'))
        {
            $user = User::where('email', $request->email)->first();
            if ($user)
            {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
                {
                    $token = Auth::User()->createToken('Laravel Password Grant Client')->accessToken;
                    // $response = ['token' => $token];
                    $users=
                    [
                        'user'=> $user,
                        'token'=> $token,
                    ];
                    return response()->json(['status'=>200,'message'=>'login Successfully' ,'data'=> $users ]);
                }
                else
                {
                    return response()->json(['status'=>100,'message'=>'Wrong Credentials']);
                }
            }
            else
            {
                return response()->json(['status'=>100,'message'=>'User Does not Exists']);
            }
        }
    }
    public function logout(Request $request)
    {
        if (Auth::check())
        {
            Auth::user()->token()->revoke();
        }
        return response()->json(['status' => 200, 'message'=>'You are logout Successfully']);
    }

}
