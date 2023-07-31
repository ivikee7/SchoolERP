<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class GSuite extends Controller
{
    public function usersCreateIndex(Request $request)
    {
        if (! auth()->user()->can('permission_access')) {
            abort(403, "You don't have permission!");
        }

        if ($request->ajax()) {
            $data = DB::table('users as u')
                ->leftJoin('model_has_roles as mhr', 'u.id', 'mhr.model_id')
                ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
                ->leftJoin('student_admissions as sa', 'u.id', 'sa.user_id')
                ->leftJoin('student_classes as sc', 'sa.current_class_id', 'sc.id')
                ->leftJoin('student_sections as ss', 'sa.current_section_id', 'ss.id')
                ->whereIn('r.name', ['STUDENT'])
                ->when($request->get('ids') != null, function ($query) use ($request) {
                    $query->whereIn('u.id', explode(',', $request->ids));
                })
                ->select('u.id', 'u.title', 'u.first_name', 'u.middle_name', 'u.last_name', 'u.email_alternate', 'u.contact_number', 'u.status as user_status', 'sa.admission_status', 'sc.name as class_name', 'ss.name as section_name')
                ->get();

            return DataTables::of($data)
                ->editColumn('f_name', '{{$first_name}}')
                ->addColumn('l_name', function ($data) {
                    if (! empty($data->last_name) || $data->last_name != '') {
                        return $data->middle_name.' '.$data->last_name;
                    } else {
                        return '.';
                    }
                })
                ->addColumn('student_class', '{{$class_name}} {{$section_name}}')
                ->addColumn('password', function ($data) {
                    return ucfirst(str_replace(' ', '', strtolower($data->first_name).'@'.substr($data->contact_number, 0, 5)));
                })
                ->addColumn('org_unit_path', '/School/Students/{{$class_name}}/{{$section_name}}')
                ->addColumn('recovery_phone', '')
                ->addColumn('change_password_at_next_sign_in', 'FALSE')
                ->addColumn('new_status', function ($data) {
                    if ($data->user_status == 1 && $data->admission_status == 1) {
                        return 'Active';
                    } else {
                        return 'Suspended';
                    }
                })
                ->addColumn('advanced_protection_program_enrollment', 'FALSE')
                ->addColumn('none', '')
//                    ->filter(function ($instance) use ($request) {
//                        if ($request->has('ids') && $request->get('ids') != null) {
//                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
//                                return array_intersect(array($row['id']), explode(',', $request->ids)) ? true : false;
//                            });
//                        }
//                    })
                ->make(true);
        }

        return view('gsuite.bulk.create');
    }

    public function usersUpdateIndex(Request $request)
    {
        if (! auth()->user()->can('permission_access')) {
            abort(403, "You don't have permission!");
        }
        if ($request->ajax()) {
            $data = DB::table('users as u')
                ->leftJoin('model_has_roles as mhr', 'u.id', 'mhr.model_id')
                ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
                ->leftJoin('student_admissions as sa', 'u.id', 'sa.user_id')
                ->leftJoin('student_classes as sc', 'sa.current_class_id', 'sc.id')
                ->leftJoin('student_sections as ss', 'sa.current_section_id', 'ss.id')
                ->whereIn('r.name', ['STUDENT'])
                ->when($request->get('ids') != null, function ($query) use ($request) {
                    $query->whereIn('u.id', explode(',', $request->ids));
                })
                ->select('u.id', 'u.title', 'u.first_name', 'u.middle_name', 'u.last_name', 'u.email_alternate', 'u.contact_number', 'u.status as user_status', 'sa.admission_status', 'sc.name as class_name', 'ss.name as section_name')
                ->get();

            return DataTables::of($data)
                ->editColumn('f_name', '{{$first_name}}')
                ->addColumn('l_name', function ($data) {
                    if (! empty($data->last_name) || $data->last_name != '') {
                        return $data->middle_name.' '.$data->last_name;
                    } else {
                        return '.';
                    }
                })
                ->addColumn('student_class', '{{$class_name}} {{$section_name}}')
                ->addColumn('password', '****')
                ->addColumn('org_unit_path', '/School/Students/{{$class_name}}/{{$section_name}}')
                ->addColumn('recovery_phone', '')
                ->addColumn('change_password_at_next_sign_in', 'FALSE')
                ->addColumn('new_status', function ($data) {
                    if ($data->user_status == 1 && $data->admission_status == 1) {
                        return 'Active';
                    } else {
                        return 'Suspended';
                    }
                })
                ->addColumn('advanced_protection_program_enrollment', 'FALSE')
                ->addColumn('none', '')
//                    ->filter(function ($instance) use ($request) {
//                        if ($request->has('ids') && $request->get('ids') != null) {
//                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
//                                return array_intersect(array($row['id']), explode(',', $request->ids)) ? true : false;
//                            });
//                        }
//                    })
                ->make(true);
        }

        return view('gsuite.bulk.update');
    }

    //    public function usersUpdateIndex(Request $request)
    //    {
    //        if (auth()->user()->can('permission_access')) {
    //
    //            if ($request->ajax() && $request != null) {
    //                return explode(',', $request->ids);
    //            }
    //            return view('gsuite.bulk.update');
    //        } else return abort(403, "You don't have permission!");
    //    }
}
