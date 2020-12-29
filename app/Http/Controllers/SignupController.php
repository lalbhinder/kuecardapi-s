<?php

namespace App\Http\Controllers;

use App\Company;
use App\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use App\User;
use Illuminate\Support\Facades\Validator;
Use DB;
Use Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Hash as FacadesHash;
use phpseclib\Crypt\Hash as CryptHash;

use function GuzzleHttp\Promise\all;

// use Psy\Util\Str;
class SignupController extends Controller
{
    public function CreateCompany(Request $request ,$length=15,$count=20)
    {
        // $validator = Validator::make($request->all(),
        // [
        //     'email' => 'max:255|email|required',
        //     'password' => 'required|string|',
        // ]);
        // if ($validator->fails())
        // {
        //     if ($validator->fails())
        //     {
        //         return response()->json(['message' => $validator->errors()->first(), 'status' => false], 500);
        //     }
        // }
        // // $request['password'] = Hash::make($request->password);
        // $companies=new Company();
        // $companies->email=$request->email;
        // $companies->password=Hash::make($request->password);
        // $companies->company_name=$request->company_name;
        // $companies->website=$request->website;
        // $companies->Adress=$request->Adress;
        // $companies->status=$request->status;
        // $string_manager='0123456789!@#$%^&abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&';
        // $num_manager = substr(str_shuffle(str_repeat($string_manager, 15)), 0, $length);
        // $string_employee='0123456789!@#$%^&abcdefghijklmnopq56789rstuvwxyz!@#$%^&ABCDEFGHIJKLMNOPQRSTUVWXYZefghijklmnop';
        // $num_employee = substr(str_shuffle(str_repeat($string_employee, 20)), 0, $count);
        // $companies->employee_code= $num_employee;
        // $companies->owner_code= $num_manager;
        // return $request->all();
        // $companies ->save();
        // return response()->json(['status'=>200, 'message'=>'Company save successfully']);
    }

    // User Sign Up Api
    public function SignUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|',
            'user_code'=>'required'
        ]);
        if ($validator->fails()){
            return response()->json(['message' => $validator->errors()->first(), 'status' => 100], 500);
        }
        if($request->has('email'))
        {
            $check_email=User::where('email',$request->email)->first();
            if($check_email)
            {
                return response()->json(['status'=>100,'message'=>'Email Already Exists!!Please enter a unique one']);
            }
        }
        $company_check=Company::where('manager_code',$request->user_code)->orwhere('employee_code',$request->user_code)->first();

        if($company_check['manager_code'] == $request->user_code){
            $user_role='manager';
        }
        elseif($company_check['employee_code'] == $request->user_code){
            $user_role='employee';
        }
        // query:need to confirm whether a user could only be a manager or an employee or both role could be assigned?
        else{
            return response()->json(['status'=>100,'message'=>'Please enter a valid code']);
        }
        $users=new User();
        $users->email=$request->email;
        $users->user_code=$request->user_code;
        $users->user_role = $user_role;
        $users->company_id = $company_check['id'];
        $users ->save();
        $user_id=$users->id;
        return response()->json(['status'=>200, 'message'=>'User Registered successfully','id'=>$user_id,'company_id'=>$users->company_id]);
    }
    // getting company data in the fields for upcoming screen
    public function ConfirmCompany(Request $request)
    {
        $company=Company::Select('company_name','company_website','company_address')->where('id',$request->company_id)->first();
        if($company){
            return response()->json(['status'=>200,'message'=>'Company Listed Created Successfully','company'=>$company]);
        }
        else{
            return response()->json(['status'=>100,'message'=>'Company ID Does not Exists']);
        }
    }
    // updating fields against an email
    public function UpdateUserRecord(Request $request)
    {
        $users=User::find($request->user_id);
        if($users){
            $filename='';
            if($request->hasfile('image'))
                {
                    $users['user_image']=$request->file('image');
                    $filename = str_replace(' ', '', time().$users['user_image']->getClientOriginalName());
                    $location = app()->basePath('public/assets/images/users');
                    $users['user_image']->move($location,$filename);
                    $users['user_image']=$filename;
                }
                $data = array(
                    'password' =>Hash::make($request->password),
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'title' => $request->title,
                    'phone_no' => $request->phone_no,
                    'user_image'=>$filename
                );
        $user=User::where('id', $request->user_id)
                ->update($data);
                if($user){
                    // $confirm=User::where('id',$request->user_id)->where('password',$request->password);
                    // return $confirm;
                    if (Auth::attempt(['id' => $request->user_id, 'password' => $request->password]))
                    {
                        $token = Auth::User()->createToken('Laravel Password Grant Client')->accessToken;
                        // $response = ['token' => $token];
                        $users=
                        [
                            'user'=> $data,
                            'token'=> $token,
                        ];
                        return response()->json(['status'=>200,'message'=>'Updated Successfully' ,'data'=> $users ]);
                    }
                }

            }
            else{
                return response()->json(['status'=>100, 'message'=>'User ID does not Exists']);
            }

        // return response()->json(['status'=>200, 'message'=>'User updated successfully']);
        // }


    }
    public function GuestSignUp(Request $request)
    {
        if($request->has('first_name'))
        {
            $check_name=Guest::where('first_name',$request->first_name)->first();
            if($check_name)
            {
                return response()->json(['status'=>100,'message'=>'Name Already Exists!!Please enter a unique one']);
            }
        }
        $guest=new Guest();
        $guest->first_name=$request->first_name;
        $guest->last_name=$request->last_name;
        $guest->email=$request->email;
        $guest->phone=$request->phone;

        // return $guest;
        $guest->save();
        return response()->json(['status'=>200,'message'=>'Guest Inserted successfully','data'=>$guest]);
    }
    public function email(Request $request)
    {
        $password = Str::random(8);
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($password);
        $user->update();
        Mail::to($user->email)->send(new ResetPassword());
        return json_encode([
            'status' => '200',
            'msg' => 'email sent'
        ]);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/home');
    }

}
