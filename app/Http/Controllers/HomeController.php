<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    public function home()
    {
        $employee_birthdays = DB::table('users as u')
            ->leftJoin('model_has_roles as mhr', 'u.id', 'mhr.model_id')
            ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
            ->where(DB::raw('month(date_of_birth)'), DB::raw('month(now())'))
            ->where(DB::raw('day(date_of_birth)'), DB::raw('day(now())'))
            ->where('u.status', 1)
            ->whereNotIn('r.name', ['STUDENT'])
            ->select('u.id', 'u.title', 'u.first_name', 'u.middle_name', 'u.last_name', 'r.name as role_name', 'u.date_of_birth', DB::raw('year(date_of_birth) as year'))
            ->get();
        $student_birthdays = DB::table('users as u')
            ->leftJoin('model_has_roles as mhr', 'u.id', 'mhr.model_id')
            ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
            ->where(DB::raw('month(date_of_birth)'), DB::raw('month(now())'))
            ->where(DB::raw('day(date_of_birth)'), DB::raw('day(now())'))
            ->where('u.status', 1)
            ->whereIn('r.name', ['STUDENT'])
            ->select('u.id', 'u.title', 'u.first_name', 'u.middle_name', 'u.last_name', 'r.name as role_name', 'u.date_of_birth', DB::raw('year(date_of_birth) as year'))
            ->get();

        $attendance_staff_total = DB::table('users as u')
            ->leftJoin('model_has_roles as mhr', 'u.id', 'mhr.model_id')
            ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
            ->where('u.status', 1)
            ->where('r.name', 'not like', '%STUDENT%')
            ->where('r.name', 'not like', '%TEACHER%')
            ->select(DB::raw('COUNT(*) as count'))
            ->get();
        $attendance_staff_present = DB::table('users as u')
            ->leftJoin('model_has_roles as mhr', 'u.id', 'mhr.model_id')
            ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
            ->leftJoin('user_attendances as ua', 'u.id', 'ua.user_id')
            ->where('r.name', 'not like', '%STUDENT%')
            ->where('r.name', 'not like', '%TEACHER%')
            ->where('u.status', 1)
            ->where(DB::raw('date(ua.created_at)'), DB::raw('date(now())'))
            ->select(DB::raw('COUNT(*) as count'))
            ->get();

        $attendance_teacher_total = DB::table('users as u')
            ->leftJoin('model_has_roles as mhr', 'u.id', 'mhr.model_id')
            ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
            ->where('u.status', 1)
            ->where('r.name', 'like', '%TEACHER%')
            ->select(DB::raw('COUNT(*) as count'))
            ->get();
        $attendance_teacher_present = DB::table('users as u')
            ->leftJoin('model_has_roles as mhr', 'u.id', 'mhr.model_id')
            ->leftJoin('user_attendances as ua', 'u.id', 'ua.user_id')
            ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
            ->where('u.status', 1)
            ->where('r.name', 'like', '%TEACHER%')
            ->where(DB::raw('date(ua.created_at)'), DB::raw('date(now())'))
            ->select(DB::raw('COUNT(*) as count'))
            ->get();

        // $attendance_details = DB::table('roles as r')
        //     ->leftJoin('model_has_roles as mhr', 'r.id', 'mhr.role_id')
        //     ->leftJoin('users as u', 'mhr.model_id', 'u.id')
        //     ->leftJoin('user_attendances as ua', 'u.id', 'ua.user_id')
        //     ->where('u.status', 0)
        //     ->select('r.name', DB::raw("count(ua.created_at)"))
        //     ->groupBy('r.name')
        //     ->get();

        function countPresentAbsent($role)
        {
            $users = DB::table('users as u')
                ->leftJoin('model_has_roles as mhr', 'u.id', 'mhr.model_id')
                ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
                ->where('u.status', 1)
                ->where('r.name', $role)
                ->select(DB::raw('COUNT(*) as count'))
                ->get();
            $present = DB::table('users as u')
                ->leftJoin('model_has_roles as mhr', 'u.id', 'mhr.model_id')
                ->leftJoin('user_attendances as ua', 'u.id', 'ua.user_id')
                ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
                ->where('u.status', 1)
                ->where('r.name', $role)
                ->where(DB::raw('date(ua.created_at)'), DB::raw('date(now())'))
                ->select(DB::raw('count(distinct ua.user_id)as count'))
                ->get();

            return json_encode(['role' => $role, 'total' => $users[0]->count, 'present' => $present[0]->count]);
        }

        // $roles = Role::all()->pluck('name');
        $roles = DB::table('roles as r')
            ->join('model_has_roles as mhr', 'r.id', 'mhr.role_id')
            ->join('users as u', 'mhr.model_id', 'u.id')
            ->whereNotIn('r.name', ['Super Admin', 'DIRECTOR', 'PRINCIPAL', 'Owner', 'STUDENT'])
            ->where('u.status', 1)
            ->groupBy('r.name')
            ->pluck('r.name');
        $array = [];
        foreach ($roles as $role) {
            $array[] = countPresentAbsent($role);
        }

        return view('index')->with([
            'employee_birthdays' => $employee_birthdays,
            'student_birthdays' => $student_birthdays,
            'attendance_staff_total' => $attendance_staff_total[0]->count,
            'attendance_staff_present' => $attendance_staff_present[0]->count,
            'attendance_teacher_total' => $attendance_teacher_total[0]->count,
            'attendance_teacher_present' => $attendance_teacher_present[0]->count,
            'attendance_details' => $array,
        ]);
    }
}
