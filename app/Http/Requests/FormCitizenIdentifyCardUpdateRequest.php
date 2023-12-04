<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormCitizenIdentifyCardUpdateRequest extends FormRequest
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
            'citizen_identify_card_id' => 'required|unique:tbl_citizen_identify_cards,citizen_identify_card_id,'.$this->citizen_identify_card_id.',citizen_identify_card_id|regex:/^[A-Za-z0-9]{12}$/',
            'full_name' => 'required',
            'date_of_birth' => 'required|date|date_format:Y-m-d',
            'gender' => 'required',
            'place_of_origin_city' => 'required|not_in:0',
            'place_of_origin_district' => 'required|not_in:0',
            'place_of_origin_ward' => 'required|not_in:0',
            'place_of_residence_city' => 'required|not_in:0',
            'place_of_residence_district' => 'required|not_in:0',
            'place_of_residence_ward' => 'required|not_in:0',
            'street_name' => 'required',
            'date_of_expiry' => 'required|date|date_format:Y-m-d|after:date_of_issue',
            'date_of_issue' => 'required|date|date_format:Y-m-d',
            'issued_by' => 'required|string'
        ];
    }
}
