<?php

namespace App\Http\Controllers;

use App\Models\LeaveManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class LeaveManagementController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->can('leave_show')) {
            if ($request->ajax()) {
                $leave = DB::table('leave_management as lm')
                    ->leftJoin('users as u', 'lm.user_id', 'u.id')
                    ->leftJoin('model_has_roles as mhr', 'u.id', 'mhr.model_id')
                    ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
                    ->leftJoin('users as ucn', 'lm.created_by', 'ucn.id')
                    ->leftJoin('users as uun', 'lm.updated_by', 'uun.id')
                    ->where('u.id', Auth::user()->id)
                    ->select('lm.id as lm_id', 'lm.leave_from', 'lm.leave_to', 'lm.message', 'lm.status as leave_status', 'lm.created_at', 'lm.updated_at', 'u.first_name', 'u.middle_name', 'u.last_name', 'r.name as role_name', DB::raw("concat(ucn.first_name, ' ', ucn.middle_name, ' ', ucn.last_name) as created_by_name"), DB::raw("concat(uun.first_name, ' ', uun.middle_name, ' ', uun.last_name) as updated_by_name"))
                    ->get();
                $datatables = DataTables::of($leave)
                    ->addColumn('full_name', function ($leave) {
                        return str_replace('  ', ' ', $leave->first_name.' '.$leave->middle_name.' '.$leave->last_name);
                    })
                    ->editColumn('created_by', '{{$created_by_name}} {{$created_at}}')
                    ->editColumn('updated_by', '{{$updated_by_name}} {{$updated_at}}')
                    ->addColumn('leave_status', function ($leave) {
                        if ($leave->leave_status == '') {
                            return 'Pending';
                        }
                        if ($leave->leave_status == 0) {
                            return 'Rejected';
                        }
                        if ($leave->leave_status == 1) {
                            return 'Accepted';
                        }
                    })
                    ->addColumn('action', function ($leave) {
                        if ($leave->leave_status == '') {
                            $distroy = '<a href='.URL::current().'/edit/'.$leave->lm_id.'/destroy'.' class="btn btn-xs btn-danger"><i class="fas fa-times-circle"></i></a>';

                            return $distroy;
                        }
                    })
                    ->rawColumns(['leave_status', 'action'])
                    ->setRowClass(function ($leave) {
                        if ($leave->leave_status == '') {
                        } elseif ($leave->leave_status == 0) {
                            return 'bg-warning';
                        } elseif ($leave->leave_status == 1) {
                            return 'bg-success';
                        }
                    });

                $allStatus = ['Pending', 'Accepted', 'Rejected'];
                $datatables->with([
                    'allStatus' => $allStatus,
                ]);

                return $datatables->make(true);
            }

            return view('leave-management.index');
        } else {
            return abort(403, "You don't have permission!");
        }
    }

    public function create(Request $request)
    {
        if (auth()->user()->can('leave_create')) {
            return view('leave-management.create');
        } else {
            return abort(403, "You don't have permission!");
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->can('leave_create')) {
            $request->validate([
                // User
                'leave_from' => 'required',
                'leave_to' => 'required|after_or_equal:leave_from',
                'message' => 'required',
            ]);

            LeaveManagement::firstOrCreate([
                'user_id' => Auth::user()->id,
                'leave_from' => $request->leave_from,
                'leave_to' => $request->leave_to,
                'created_by' => Auth::user()->id,
            ], [
                'user_id' => Auth::user()->id,
                'leave_from' => $request->leave_from,
                'leave_to' => $request->leave_to,
                'message' => $request->message,
                'created_by' => Auth::user()->id,
                'created_at' => now(),
            ]);

            return redirect(route('user.attendance.leave.management.index'));
        } else {
            return abort(403, "You don't have permission!");
        }
    }

    public function edit(Request $request)
    {
        if (auth()->user()->can('leave_edit')) {
            if ($request->ajax()) {
                $leave = DB::table('leave_management as lm')
                    ->leftJoin('users as u', 'lm.user_id', 'u.id')
                    ->leftJoin('model_has_roles as mhr', 'u.id', 'mhr.model_id')
                    ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
                    ->leftJoin('users as ucn', 'lm.created_by', 'ucn.id')
                    ->leftJoin('users as uun', 'lm.updated_by', 'uun.id')
                    ->select('lm.id as lm_id', 'lm.leave_from', 'lm.leave_to', 'lm.message', 'lm.status as leave_status', 'lm.created_at', 'lm.updated_at', 'u.id as u_id', 'u.first_name', 'u.middle_name', 'u.last_name', 'r.name as role_name', DB::raw("concat(ucn.first_name, ' ', ucn.middle_name, ' ', ucn.last_name) as created_by_name"), DB::raw("concat(uun.first_name, ' ', uun.middle_name, ' ', uun.last_name) as updated_by_name"))
                    ->get();
                $datatables = DataTables::of($leave)
                    ->addColumn('full_name', function ($leave) {
                        return str_replace('  ', ' ', $leave->first_name.' '.$leave->middle_name.' '.$leave->last_name);
                    })
                    ->editColumn('created_by', '{{$created_by_name}} {{$created_at}}')
                    ->editColumn('updated_by', '{{$updated_by_name}} {{$updated_at}}')
                    ->addColumn('leave_status', function ($leave) {
                        if ($leave->leave_status == '') {
                            return 'Pending';
                        }
                        if ($leave->leave_status == 0) {
                            return 'Rejected';
                        }
                        if ($leave->leave_status == 1) {
                            return 'Accepted';
                        }
                    })
                    ->addColumn('action', function ($leave) {
                        if ($leave->leave_status == '') {
                            $accept = '<a href='.URL::current().'/'.$leave->lm_id.'/accept'.' class="btn btn-xs btn-success"><i class="fa-solid fa-circle-check"></i></a>';
                            $reject = '<a href='.URL::current().'/'.$leave->lm_id.'/reject'.' class="btn btn-xs btn-warning"><i class="fa-solid fa-circle-xmark"></i></a>';

                            return $accept.' '.$reject;
                        }
                    })
                    ->rawColumns(['leave_status', 'action'])
                    ->setRowClass(function ($leave) {
                        if ($leave->leave_status == '') {
                        } elseif ($leave->leave_status == 0) {
                            return 'bg-warning';
                        } elseif ($leave->leave_status == 1) {
                            return 'bg-success';
                        }
                    });

                $allRoles = Role::distinct('name')->pluck('name');
                $allStatus = ['Pending', 'Accepted', 'Rejected'];
                $datatables->with([
                    'allRoles' => $allRoles,
                    'allStatus' => $allStatus,
                ]);

                return $datatables->make(true);
            }

            return view('leave-management.leaves');
        } else {
            return abort(403, "You don't have permission!");
        }
    }

    public function accept(Request $request, $id)
    {
        if (auth()->user()->can('leave_update')) {
            $leave = LeaveManagement::findOrFail($id);
            $leave->status = 1;
            $leave->updated_by = Auth()->user()->id;
            $leave->save();

            return redirect(route('user.attendance.leave.management.edit'));
        } else {
            return abort(403, "You don't have permission!");
        }
    }

    public function reject(Request $request, $id)
    {
        if (auth()->user()->can('leave_update')) {
            $leave = LeaveManagement::findOrFail($id);
            $leave->updated_by = Auth()->user()->id;
            $leave->status = 0;
            $leave->save();

            return redirect(route('user.attendance.leave.management.edit'));
        } else {
            return abort(403, "You don't have permission!");
        }
    }

    public function destroy(Request $request, $id)
    {
        if (auth()->user()->can('leave_delete')) {

            $leave = LeaveManagement::where('id', $id)->where('user_id', Auth()->user()->id)->where('status', null);
            $leave->delete();

            return redirect(route('user.attendance.leave.management.index'));
        } else {
            return abort(403, "You don't have permission!");
        }
    }

    public function update(Request $request)
    {
        if (auth()->user()->can('student_access')) {
            if ($request->ajax()) {
            }

            return view('leave-management.index');
        } else {
            return abort(403, "You don't have permission!");
        }
    }

    public function daily(Request $request)
    {
        if (auth()->user()->can('student_access')) {
            if ($request->ajax()) {
            }

            return view('student.index');
        } else {
            return abort(403, "You don't have permission!");
        }
    }

    public function monthly(Request $request)
    {
        if (auth()->user()->can('student_access')) {
            if ($request->ajax()) {
            }

            return view('leave-management.index');
        } else {
            return abort(403, "You don't have permission!");
        }
    }
}
