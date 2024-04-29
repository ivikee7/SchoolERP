<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentRegistration extends Model
{
    use HasFactory, SoftDeletes;

    // Primary Key
    protected $primaryKey = 'id';

    // Fillable
    protected $fillable = [
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'gender',
        'father_name',
        'father_qualification',
        'father_occupation',
        'father_contact_number',
        'mother_name',
        'mother_qualification',
        'mother_occupation',
        'mother_contact_number',
        'address_line1',
        'city',
        'state',
        'pin_code',
        'registration_class_id',
        'last_attended_school',
        'last_attended_class_id',
        'payment_mode',
        'created_by',
        'updated_by',
    ];
}
