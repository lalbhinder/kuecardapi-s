<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    //
    protected $fillable=[
        'template_type_id','subject','body',
    ];

}

