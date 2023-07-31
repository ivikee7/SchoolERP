<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAttendance extends Model
{
    use HasFactory;

    // fillable
    protected $fillable = [
        'user_id',
        'created_by',
        'created_at',
    ];

    // Timestamps none
    public $timestamps = false;
}
