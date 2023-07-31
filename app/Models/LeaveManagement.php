<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveManagement extends Model
{
    use HasFactory;

    // Fillable
    protected $fillable = [
        'user_id',
        'leave_from',
        'leave_to',
        'message',
        'created_by',
        'updated_by',
        'status',
        'created_at',
        'updated_at',
    ];

    // Timestamp
    public $timestamps = false;
}
