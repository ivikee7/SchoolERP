<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'appointment_id';

    protected $fillable = [
        'appointment_name',
        'appointment_clint_name',
        'appointment_status',
        'appointment_remark',
        'appointment_start',
        'appointment_end',
        'appointment_created_by',
        'appointment_updated_by',
    ];

    const CREATED_AT = 'appointment_created_at';
    const UPDATED_AT = 'appointment_updated_at';
}
