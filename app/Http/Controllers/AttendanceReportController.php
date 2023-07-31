<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AttendanceReportController extends Controller
{
    public static function time($id, $date)
    {
        $time = DB::table('user_attendances')
            ->where('user_id', $id)
            ->where(DB::raw('date(created_at)'), $date)
            ->select('created_at')->get();
        // dd($time);
        return value($time);
    }

    public static function inTime($id, $date)
    {
        $in = DB::table('user_attendances')
            ->where('user_id', $id)
            ->where(DB::raw('date(created_at)'), $date)
            ->MIN('created_at');

        return value($in);
    }

    public static function outTime($id, $date, $in)
    {
        $out = DB::table('user_attendances')
            ->where('user_id', $id)
            ->where(DB::raw('date(created_at)'), $date)
            ->where('created_at', '>', $in ?? '')
            ->MAX('created_at');

        return $out;
    }

    public function monthly()
    {
        // $users = User::select('id', 'first_name', 'middle_name', 'last_name')->get();
        $users = DB::table('users as u')
            ->leftJoin('model_has_roles as mhr', 'u.id', 'mhr.model_id')
            ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
            ->where('status', 1)
            ->whereNotIn('r.name', ['Super Admin', 'DIRECTOR', 'PRINCIPAL', 'OWNER', 'STUDENT'])
            ->select('u.id', 'u.first_name', 'u.middle_name', 'u.last_name', 'r.name as role_name')
            ->get();

        // $date = date('Y-m-d', strtotime('2022-06-01'));
        $date = date('Y-m-d', strtotime(now()));
        $days = Carbon::create($date)->daysInMonth;
        $d = Carbon::create($date)->day;
        $m = Carbon::create($date)->month;
        $y = Carbon::create($date)->year;

        $daysData = [];
        for ($i = 1; $i <= $days; $i++) {
            $daysData[$i] = $i;
        }

        // dd($days);

        foreach ($users as $user) {
            $mDate = Carbon::create($y.'-'.$m.'-'.$d)->toDateString();

            $data = (object) [
                'user_id' => $user->id,
                'user_name' => $user->first_name.' '.$user->middle_name.' '.$user->last_name,
                'role' => $user->role_name,
            ];
            $assigned[] = $data;
        }

        return view('attendance.monthly', ['users' => $assigned ?? '', 'days' => $days, 'y' => $y, 'm' => $m]);
    }
}
