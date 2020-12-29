<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Registerrequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_id'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'company_id'=>'required',
            'tittle'=>'required',
            'mobile_no'=>'required',
            'image'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
        ];
    }
}
