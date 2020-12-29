<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    //
    protected $fillable=[

        'day_id','user_id','slot_start_time','slot_end_time','date',
    ];
    public function day()
    {
        return $this->belongsTo(Day::class);
    }

}
