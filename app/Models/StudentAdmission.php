<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentAdmission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'registration_id',
        'academic_session_id',
        'student_quota_id',
        'admission_class_id',
        'admission_section_id',
        'current_class_id',
        'current_section_id',
        'local_guardian_profile_id',
        'relationship',
        'admission_status',
        'created_by_id',
        'updated_by_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(StudentClass::class, 'current_class_id', 'id');
    }
}
