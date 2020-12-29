<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateType extends Model
{
    //
    protected $fillable=[
        'template','parent_id',
    ];

     // template mutator
    // public function setNameAttribute($name){
    //     $this->attributes['name'] = strtolower($name);
    // }

    //template Accessor
    // public function getNameAttribute($name){
    //     return  strtolower($name);
    // }
}
