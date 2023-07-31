<?php

namespace App\Http\Controllers;

use App\Models\UserAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth()->user()->can('attendance_create')) {
            $users = DB::table('users as u')
                ->leftJoin('model_has_roles as mhr', 'u.id', 'mhr.model_id')
                ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
                ->where('status', 1)
                ->whereNotIn('r.name', ['Super Admin', 'DIRECTOR', 'PRINCIPAL', 'OWNER', 'STUDENT'])
                ->select('u.id', 'u.first_name', 'u.middle_name', 'u.last_name', 'r.name as role_name')
                ->get();

            $date = date('Y-m-d', strtotime(now()));

            foreach ($users as $user) {

                $in = DB::table('user_attendances as ua')
                    ->where('user_id', $user->id)
                    ->where(DB::raw('date(created_at)'), $date)
                    ->MIN('created_at');

                $out = DB::table('user_attendances as ua')
                    ->where('user_id', $user->id)
                    ->where(DB::raw('date(created_at)'), $date)
                    ->where('created_at', '>', $in ?? '')
                    ->MAX('created_at');

                $data = (object) [
                    'user_id' => $user->id,
                    'user_name' => $user->first_name.' '.$user->middle_name.' '.$user->last_name,
                    'role' => $user->role_name,
                    'in' => $in ?? '',
                    'out' => $out ?? '',
                ];
                $assigned[] = $data;
            }

            return view('attendance.index', ['users' => $assigned ?? '', 'date' => $date]);
        } else {
            return abort(403, "You don't have permission!");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth()->user()->can('attendance_create')) {
            $timestamp = now();
            $attendance = new UserAttendance();
            $attendance->user_id = $request->id;
            $attendance->created_at = $timestamp;
            $attendance->created_by = Auth::user()->id;
            $attendance->timestamps = false;
            $attendance->save();

            return response()->json(['datetime' => $timestamp]);
        } else {
            return abort(403, "You don't have permission!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort(404);
    }

    public static function time($id, $date)
    {
        $time = DB::table('user_attendances')
            ->where('user_id', $id)
            ->where(DB::raw('date(created_at)'), $date)
            ->select('created_at')->get();

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

    public function daily(Request $request)
    {
        if (Auth()->user()->can('attendance_access')) {
            $date = date('Y-m-d', strtotime($request->date));
            $days = Carbon::create($date)->daysInMonth;
            $d = Carbon::create($date)->day;
            $m = Carbon::create($date)->month;
            $y = Carbon::create($date)->year;
            if ($request->date != '') {
                $users = DB::table('users as u')
                    ->leftJoin('model_has_roles as mhr', 'u.id', 'mhr.model_id')
                    ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
                    ->where('status', 1)
                    ->whereNotIn('r.name', ['Super Admin', 'DIRECTOR', 'PRINCIPAL', 'OWNER', 'STUDENT'])
                    ->select('u.id', 'u.first_name', 'u.middle_name', 'u.last_name', 'r.name as role_name')
                    ->get();

                foreach ($users as $user) {

                    $in = DB::table('user_attendances as ua')
                        ->where('user_id', $user->id)
                        ->where(DB::raw('date(created_at)'), $date)
                        ->MIN('created_at');

                    $out = DB::table('user_attendances as ua')
                        ->where('user_id', $user->id)
                        ->where(DB::raw('date(created_at)'), $date)
                        ->where('created_at', '>', $in ?? '')
                        ->MAX('created_at');

                    $data = (object) [
                        'user_id' => $user->id,
                        'user_name' => $user->first_name.' '.$user->middle_name.' '.$user->last_name,
                        'role' => $user->role_name,
                        'in' => $in ?? '',
                        'out' => $out ?? '',
                    ];
                    $assigned[] = $data;
                }

                return view('attendance.daily', ['users' => $assigned ?? '', 'date' => $request->date ?? '']);
            } else {
                return view('attendance.daily', ['users' => $assigned ?? '', 'date' => $request->date ?? ''])->with(['ststus' => 'warning', 'message' => 'Please sellect date!']);
            }
        } else {
            return abort(404);
        }
    }

    public function monthly(Request $request)
    {
        if (Auth()->user()->can('attendance_access')) {
            if ($request->date != '') {
                // $date = date('Y-m-d', strtotime('2022-06-01'));
                $date = date('Y-m-d', strtotime($request->date));
                $days = Carbon::create($date)->daysInMonth;
                $d = Carbon::create($date)->day;
                $m = Carbon::create($date)->month;
                $y = Carbon::create($date)->year;

                // $users = User::select('id', 'first_name', 'middle_name', 'last_name')->get();
                $users = DB::table('users as u')
                    ->leftJoin('model_has_roles as mhr', 'u.id', 'mhr.model_id')
                    ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
                    ->where('status', 1)
                    ->whereNotIn('r.name', ['Super Admin', 'DIRECTOR', 'PRINCIPAL', 'OWNER', 'STUDENT'])
                    ->select('u.id', 'u.first_name', 'u.middle_name', 'u.last_name', 'r.name as role_name')
                    ->get();

                foreach ($users as $user) {
                    $mDate = Carbon::create($y.'-'.$m.'-'.$d)->toDateString();

                    $data = (object) [
                        'user_id' => $user->id,
                        'user_name' => $user->first_name.' '.$user->middle_name.' '.$user->last_name,
                        'role' => $user->role_name,
                    ];
                    $assigned[] = $data;
                }

                return view('attendance.monthly', ['users' => $assigned ?? '', 'days' => $days, 'y' => $y, 'm' => $m, 'date' => $date ?? '']);
            } else {
                return view('attendance.monthly', ['users' => $assigned ?? '', 'days' => $days ?? '', 'y' => $y ?? '', 'm' => $m ?? '', 'date' => $date ?? ''])->with(['ststus' => 'warning', 'message' => 'Please sellect date!']);
            }
        } else {
            return abort(404);
        }
    }
}
