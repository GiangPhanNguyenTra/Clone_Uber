<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormVehicleUpdateRequest extends FormRequest
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
            'license_plates' => 'required|unique:tbl_vehicles,license_plates,'.$this->license_plates.',license_plates|regex:/^[A-Za-z0-9]{8,9}$/',
            'brand' => 'required',
            'color' => 'required',
            'model_code' => 'required',
        ];
    }
}
