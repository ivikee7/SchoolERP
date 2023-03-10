<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    use HasFactory;

    // fillable
    protected $fillable = [
        'user_id',
        'joining_date',
        'termination_date',
        'allocated_casual_leave',
        'allocated_sick_leave',
        'pf_number',
        'esi_number',
        'bank_account_number',
        'ifsc_code',
        'un_number',
        'pan_number',
        'travel_allowance',
        'gross_salary',
        'basic_salary',
        'grade_salary',
        'salary_review_date',
        'pf',
        'created_by',
        'updated_by',
    ];
}
