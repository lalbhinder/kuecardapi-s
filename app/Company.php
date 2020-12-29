<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable=[
        'company_name','company_website','company_address','manager_code','employee_code',
    ];
    // public function user()
    // {
    //     return $this->hasmany(User::class);
    // }

}
