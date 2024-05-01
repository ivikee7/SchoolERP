<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDailyReport extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'user_daily_report_id';

    protected $fillable = [
        'user_daily_report_user_id',
        'user_daily_report_user_report_type_id',
        'user_daily_report_job_description',
        'user_daily_report_start_time',
        'user_daily_report_end_time',
        'user_daily_report_total_time',
        'user_daily_report_created_by',
        'user_daily_report_updated_by',
    ];

    const CREATED_AT = 'user_daily_report_created_at';
    const UPDATED_AT = 'user_daily_report_updated_at';
}
