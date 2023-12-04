<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRegisterDriverRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|max:255|regex:/(.*)@gmail\.com/i|unique:tbl_drivers,email',
            'phone' => 'required|numeric|digits:10|unique:tbl_drivers,phone',
            'gender' => 'required',
            'password' => 'required | confirmed'
        ];
    }
}
