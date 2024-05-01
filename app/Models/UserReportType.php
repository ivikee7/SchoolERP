<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReportType extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'user_report_type_id';

    protected $fillable = [
        'user_report_type_id',
        'user_report_type_name',
        'user_report_type_status',
    ];

    const CREATED_AT = 'user_report_type_created_at';
    const UPDATED_AT = 'user_report_type_updated_at';
}
