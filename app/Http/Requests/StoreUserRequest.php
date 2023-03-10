<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth()->user()->can('user_create');
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
            'status' => 'required|boolean',
            'email' => 'nullable|email',

            // User information
            'joining_date' => 'required|date',
            'allocated_casual_leave' => 'required|integer',
            'allocated_sick_leave' => 'required|integer',
            'pf_number' => 'nullable|integer',
            'esi_number' => 'nullable|integer',
            'bank_account_number' => 'nullable|integer',
            'ifsc_code' => 'nullable',
            'un_number' => 'nullable|integer',
            'pan_number' => 'nullable',
            'travel_allowance' => 'nullable|integer',
            'gross_salary' => 'nullable|integer',
            'basic_salary' => 'nullable|integer',
            'grade_salary' => 'nullable|integer',
            'pf' => 'required',
        ];
    }
}
