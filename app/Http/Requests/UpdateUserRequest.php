<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth()->user()->can('user_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'role' => 'required',
            'title' => 'required',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'contact_number' => 'required|integer',
            'contact_number2' => 'nullable|integer',
            'address_line1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pin_code' => 'required|integer',
            'country' => 'required',
            'transport_id' => 'required|integer',
            'aadhaar_number' => 'nullable|integer',
            'blood_group' => 'required',
            'mother_tongue' => 'required',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required',
            'gender' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'remarks' => 'nullable',
            'termination_date' => 'nullable',
            'status' => 'required|boolean',
            'email' => 'nullable|email',
        ];
    }
}
