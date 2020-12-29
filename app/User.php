<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    //
    protected $fillable=[
        'company_id','email','user_code','password','first_name','last_name','title','phone_no','user_image',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //Password Mutator
    public function setPasswordAttribute($password){
        $this->attributes['password'] = Hash::make($password);
    }
    public function slots()
    {
        return $this->hasMany(Slot::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }


}
