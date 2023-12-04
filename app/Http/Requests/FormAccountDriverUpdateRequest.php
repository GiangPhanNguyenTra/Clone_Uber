<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormAccountDriverUpdateRequest extends FormRequest
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
            'phone' => 'required|numeric|digits:10|unique:tbl_drivers,phone,'.$this->phone.',phone',
            'gender' => 'required',
            'img-upload' => '|image|mimes:jpeg,png,jpg,gif,svg'
        ];
    }
}
