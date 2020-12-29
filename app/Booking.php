<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillable=[
        'customer_id','day_id','user_id','slot_id','date','booking_status',
    ];
}
