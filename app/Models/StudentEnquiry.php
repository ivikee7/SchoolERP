<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentEnquiry extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'date_of_birth',
        'enquiry_class_id',
        'father_name',
        'mother_name',
        'contact_number',
        'contact_number2',
        'address_line1',
        'city',
        'state',
        'pin_code',
        'country',
        'last_attended_school',
        'last_attended_class',
        'source',
        'created_by',
        'updated_by',
    ];
}
