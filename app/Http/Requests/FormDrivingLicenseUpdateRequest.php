<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormDrivingLicenseUpdateRequest extends FormRequest
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
            'driving_license_id' => 'required|unique:tbl_driving_licenses,driving_license_id,'.$this->driving_license_id.',driving_license_id|regex:/^[A-Za-z0-9]{12}$/',
            'beginning_date_driving_license' => 'required|date|date_format:Y-m-d',
            'date_of_issue_dringving_license' => 'required|date|date_format:Y-m-d|after:beginning_date_driving_license',
            'issued_by_driving_license' => 'required|string'
        ];
    }
}
