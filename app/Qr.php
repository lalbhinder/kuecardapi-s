<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qr extends Model
{
    //
    protected $fillable=[
        'user_id','qr_code','scan_counter','appointment_counter','held_appointment_counter','conversation_counter',
    ];
}
