<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\StudentAdmission;
use App\Models\StudentClass;
use App\Models\StudentQuota;
use App\Models\StudentRegistration;
use App\Models\StudentSection;
use App\Models\TransportRoute;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Yajra\DataTables\DataTableAbstract
     */
    public function index(Request $request)
    {
        if (! auth()->user()->can('student_access')) {
            return abort(403, "You don't have permission!");
        }

        if (! $request->ajax()) {
            return view('student.index');
        }

        $users = User::query()
            ->leftJoin('model_has_roles as mhr', 'users.id', 'mhr.model_id')
            ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
            ->leftJoin('student_admissions as sa', 'users.id', 'sa.user_id')
            ->leftJoin('student_classes as sc', 'sa.current_class_id', 'sc.id')
            ->leftJoin('student_sections as ss', 'sa.current_section_id', 'ss.id')
            ->leftJoin('transport_routes as tr', 'users.transport_id', 'tr.id')
            ->leftJoin('transport_vehicles as tv', 'tr.vehicle_id', 'tv.id')
            ->leftJoin('transport_types as tt', 'tv.transport_type_id', 'tt.id')
            ->leftJoin('users as ucn', 'users.created_by', 'ucn.id')
            ->leftJoin('users as uun', 'users.updated_by', 'uun.id')
            ->whereIn('r.name', ['STUDENT'])
            ->select('users.id', 'users.title', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.contact_number', 'users.contact_number2', 'users.address_line1', 'users.city', 'users.state', 'users.pin_code', 'users.country', 'tr.route_name as transport_id', 'users.aadhaar_number', 'users.mother_tongue', DB::raw('date(users.date_of_birth) as date_of_birth'), 'users.place_of_birth', 'users.gender', 'users.father_name', 'users.mother_name', 'users.remarks', 'users.termination_date', 'users.status', 'sa.admission_status', 'users.email', 'users.email_alternate', 'users.created_at', 'users.updated_at', 'r.name as role_name', 'tr.route_name', 'sc.name as class_name', 'ss.name as section_name', DB::raw("concat(ucn.first_name, ' ', ucn.middle_name, ' ', ucn.last_name) as created_by_name"), DB::raw("concat(uun.first_name, ' ', uun.middle_name, ' ', uun.last_name) as updated_by_name"))
            ->get();
        $datatables = DataTables($users)
            ->editColumn('id', '{{$id}}')
            ->addColumn('full_name', function ($user) {
                return str_replace('  ', ' ', $user->first_name.' '.$user->middle_name.' '.$user->last_name);
            })
            ->addColumn('contact_number', '{{$contact_number}}, {{$contact_number2}}')
            ->addColumn('address', '{{$address_line1}} {{$city}} {{$state}} {{$country}} {{$pin_code}}')
            ->editColumn('gender', function ($user) {
                if ($user->gender == 'M') {
                    return 'Male';
                }
                if ($user->gender == 'F') {
                    return 'Female';
                }
                if ($user->gender == 'O') {
                    return 'Other';
                }
            })
            ->editColumn('created_by', '{{$created_by_name}} {{$created_at}}')
            ->editColumn('updated_by', '{{$updated_by_name}} {{$updated_at}}')
            ->editColumn('status', function ($user) {
                if ($user->status == 0) {
                    return 'Inactive';
                }
                if ($user->status == 1) {
                    return 'Active';
                }
            })
            ->addColumn('action', function ($users) {
                $status = '';
                if (auth()->user()->can('student_show')) {
                    $status .= '<a href='.URL::current().'/'.$users->id.' class="btn btn-xs btn-primary">View</a>';
                }

                return $status;
            })
            ->rawColumns(['status', 'action'])
            ->setRowClass(function ($user) {
                if ($user->admission_status == 0) {
                    return 'bg-warning';
                }
            });

        $genders = ['Male', 'Female', 'Other'];
        $allClass = StudentClass::distinct('name')->pluck('name');
        $allSection = StudentSection::distinct('name')->pluck('name');
        $status = ['Active', 'Inactive'];

        $datatables->with([
            'allGenders' => $genders,
            'allClasses' => $allClass,
            'allSections' => $allSection,
            'allStatus' => $status,
        ]);

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (! auth()->user()->can('student_create')) {
            return abort(403, "You don't have permission!");
        }

        if (! StudentAdmission::where('registration_id', $request->registration)->first()) {
            if (StudentRegistration::findOrFail($request->registration)) {
                $registration = StudentRegistration::findOrFail($request->registration);
                $local_guardians = DB::table('users as u')
                    ->leftJoin('model_has_roles as mhr', 'u.id', 'mhr.model_id')
                    ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
                    ->whereNotIn('r.name', ['STUDENT', 'Super Admin'])
                    ->select('u.id', 'u.title', 'u.first_name', 'u.middle_name', 'u.last_name')
                    ->get();
                $routes = TransportRoute::all();
                $quotas = StudentQuota::all();
                $acadamic_sessions = AcademicSession::all();
                $classes = StudentClass::all();
                $sections = StudentSection::all();

                return view('student.create')->with(['local_guardians' => $local_guardians, 'routes' => $routes, 'quotas' => $quotas, 'acadamic_sessions' => $acadamic_sessions, 'classes' => $classes, 'sections' => $sections, 'registration' => $registration]);
            }
        } else {
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! auth()->user()->can('student_create')) {
            return abort(403, "You don't have permission!");
        }

        $request->validate([
            'title' => 'required',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'contact_number' => 'required|integer',
            'contact_number2' => 'nullable|integer',
            'address_line1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pin_code' => 'required|integer',
            'country' => 'required',
            'transport_id' => 'required|integer',
            'aadhaar_number' => 'nullable|integer',
            'blood_group' => 'required',
            'mother_tongue' => 'required',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required',
            'gender' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'remarks' => 'nullable',
            'termination_date' => 'nullable',
            'status' => 'required|boolean',
            'email' => 'nullable|email',
            'registration_number' => 'required|integer',
            'acadamic_session' => 'required|integer',
            'quota' => 'required|integer',
            'class' => 'required|integer',
            'section' => 'required|integer',
            'local_guardian' => 'nullable|integer',
            'relationship' => 'nullable',
        ]);

        if (User::where('first_name', $request->first_name)
            ->where('contact_number', $request->contact_number)
            ->exists()
        ) {
            return abort(403, 'Student already exists!');
        } elseif (User::where('email', $request->email)->exists() && $request->email != '') {
            return abort(403, 'Email id already exists');
        } else {
            // Create student profile
            $student = User::create([
                'title' => strtoupper($request->title),
                'first_name' => strtoupper($request->first_name),
                'middle_name' => strtoupper($request->middle_name),
                'last_name' => strtoupper($request->last_name),
                'contact_number' => strtoupper($request->contact_number),
                'contact_number2' => strtoupper($request->contact_number2),
                'address_line1' => strtoupper($request->address_line1),
                'city' => strtoupper($request->city),
                'state' => strtoupper($request->state),
                'pin_code' => strtoupper($request->pin_code),
                'country' => strtoupper($request->country),
                'transport_id' => strtoupper($request->transport_id),
                'aadhaar_number' => strtoupper($request->aadhaar_number),
                'blood_group' => strtoupper($request->blood_group),
                'mother_tongue' => strtoupper($request->mother_tongue),
                'date_of_birth' => $request->date_of_birth,
                'place_of_birth' => strtoupper($request->place_of_birth),
                'gender' => strtoupper($request->gender),
                'father_name' => strtoupper($request->father_name),
                'mother_name' => strtoupper($request->mother_name),
                'remarks' => strtoupper($request->remarks),
                'termination_date' => $request->termination_date,
                'status' => strtoupper($request->status),
                'email' => strtolower($request->email),
                'password' => '12345678',
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ])->syncRoles('STUDENT');

            // Create student admission
            $admission = StudentAdmission::create([
                'user_id' => $student->id,
                'registration_id' => $request->registration_number,
                'academic_session_id' => $request->acadamic_session,
                'student_quota_id' => $request->quota,
                'admission_class_id' => $request->class,
                'admission_section_id' => $request->section,
                'current_class_id' => $request->class,
                'current_section_id' => $request->section,
                'local_guardian_profile_id' => $request->local_guardian,
                'relationship' => $request->relationship,
                'admission_status' => 1,
                'created_by_id' => auth()->user()->id,
                'updated_by_id' => auth()->user()->id,
            ]);

            // Generate School Email
            $student_email = User::findOrFail($student->id);
            $student_email->email_alternate = strtolower($student_email->id.'@srcspatna.com');
            $student_email->save();

            return view('student.index')->with(['status' => 'success', 'message' => 'Student ID: '.$student->id.' created']);
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
        if (! auth()->user()->can('student_show')) {
            return abort(403, "You don't have permission!");
        }

        if (User::find($id) && User::find($id)->hasRole('STUDENT')) {
            // Select user
            $user = User::leftJoin('model_has_roles as mhr', 'users.id', 'mhr.model_id')
                ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
                ->leftJoin('student_admissions as sa', 'users.id', 'sa.user_id')
                ->leftJoin('student_registrations as sr', 'sa.registration_id', 'sr.id')
                ->leftJoin('users as lgp', 'sa.local_guardian_profile_id', 'lgp.id')
                ->leftJoin('student_classes as sc', 'sa.current_class_id', 'sc.id')
                ->leftJoin('student_sections as ss', 'sa.current_section_id', 'ss.id')
                ->leftJoin('transport_routes as tr', 'users.transport_id', 'tr.id')
                ->leftJoin('transport_vehicles as tv', 'tr.vehicle_id', 'tv.id')
                ->leftJoin('transport_types as tt', 'tv.transport_type_id', 'tt.id')
                ->where('users.id', $id)
                ->select('users.id', 'users.title', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.gender', 'users.contact_number', 'users.contact_number2', 'users.address_line1', 'users.city', 'users.state', 'users.pin_code', 'users.country', 'users.media_id','tr.route_name as transport', 'users.aadhaar_number', 'users.blood_group', 'users.mother_tongue', 'users.date_of_birth', 'users.place_of_birth', 'users.gender', 'users.father_name', 'users.mother_name', 'users.remarks', 'users.termination_date', 'users.status', 'users.email', 'users.email_alternate', 'users.created_at', 'users.updated_at', 'sa.id as admission_id', 'sa.registration_id', 'sa.academic_session_id', 'sa.student_quota_id', 'sa.admission_class_id', 'sa.admission_section_id', 'sa.current_class_id', 'sa.current_section_id', 'sa.local_guardian_profile_id', 'sa.relationship', 'sa.admission_status', 'r.name as role_name', DB::raw("concat(lgp.id, ' | ', lgp.title, ' ',lgp.first_name, ' ',lgp.middle_name, ' ',lgp.last_name) as local_guardian_name"), 'tr.route_name as transport_route_name', 'sc.name as class_name', 'ss.name as section_name')
                ->get();

                $image = \App\Models\Media::find($user[0]->media_id);
            // User guardian details
            $local_guardians = User::leftJoin('model_has_roles as mhr', 'users.id', 'mhr.model_id')
                ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
                ->whereNotIn('r.name', ['STUDENT', 'Super Admin'])
                ->select('users.id', 'users.title', 'users.first_name', 'users.middle_name', 'users.last_name')
                ->get();

            $routes = TransportRoute::all();
            $quotas = StudentQuota::all();
            $acadamicSessions = AcademicSession::all();
            $classes = StudentClass::all();
            $sections = StudentSection::all();

            return view('student.show')->with(['user' => $user[0], 'image'=>$image, 'local_guardians' => $local_guardians, 'routes' => $routes, 'quotas' => $quotas, 'acadamic_sessions' => $acadamicSessions, 'classes' => $classes, 'sections' => $sections]);
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! auth()->user()->can('student_edit')) {
            return abort(403, "You don't have permission!");
        }

        return redirect(route('index'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! auth()->user()->can('student_edit')) {
            return abort(403, "You don't have permission!");
        }

        $request->validate([
            'title' => 'required',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'contact_number' => 'required|integer',
            'contact_number2' => 'nullable|integer',
            'address_line1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pin_code' => 'required|integer',
            'country' => 'required',
            'transport_id' => 'required|integer',
            'aadhaar_number' => 'nullable|integer',
            'blood_group' => 'required',
            'mother_tongue' => 'required',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required',
            'gender' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'remarks' => 'nullable',
            'termination_date' => 'nullable',
            'status' => 'required|boolean',
            'email' => 'nullable|email',
        ]);

        $student = User::findOrFail($id);
        $student->title = strtoupper($request->title);
        $student->first_name = strtoupper($request->first_name);
        $student->middle_name = strtoupper($request->middle_name);
        $student->last_name = strtoupper($request->last_name);
        $student->contact_number = strtoupper($request->contact_number);
        $student->contact_number2 = strtoupper($request->contact_number2);
        $student->address_line1 = strtoupper($request->address_line1);
        $student->city = strtoupper($request->city);
        $student->state = strtoupper($request->state);
        $student->pin_code = strtoupper($request->pin_code);
        $student->country = strtoupper($request->country);
        $student->transport_id = strtoupper($request->transport_id);
        $student->aadhaar_number = strtoupper($request->aadhaar_number);
        $student->blood_group = strtoupper($request->blood_group);
        $student->mother_tongue = strtoupper($request->mother_tongue);
        $student->date_of_birth = $request->date_of_birth;
        $student->place_of_birth = strtoupper($request->place_of_birth);
        $student->gender = strtoupper($request->gender);
        $student->father_name = strtoupper($request->father_name);
        $student->mother_name = strtoupper($request->mother_name);
        $student->remarks = strtoupper($request->remarks);
        $student->termination_date = $request->termination_date;
        $student->status = strtoupper($request->status);
        $student->email = strtolower($request->email);
        $student->password = '12345678';
        $student->updated_by = auth()->user()->id;
        $student->save();

        return Redirect::route('student.show', $id)->with(['status' => 'success', 'message' => 'Success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort(403, "You don't have permission!");
    }

    public function changeClassSectionEdit()
    {
        $student_classes = StudentClass::get();
        $student_sections = StudentSection::get();

        return view('student.change_class_section')->with(['student_classes' => $student_classes, 'student_sections' => $student_sections]);
    }

    public function changeClassSectionUpdate(Request $request)
    {
        if (! auth()->user()->can('admission_edit')) {
            return abort(403, "you don't have permission!");
        }

        $request->validate([
            'from_class' => 'required|integer',
            'from_section' => 'required|integer',
            'to_class' => 'required|integer',
            'to_section' => 'required|integer',
            'id_is' => 'required|array',
        ]);

        StudentAdmission::whereIn('id', $request->id_is)
            ->update(
                [
                    'current_class_id' => $request->to_class,
                    'current_section_id' => $request->to_section,
                    'updated_by_id' => auth()->user()->id,
                ]
            );

        return Redirect::route('student.change.class.section.edit');
    }

    public function getStudentsAjaxCall(Request $request)
    {
        if (! auth()->user()->can('admission_edit')) {
            return abort(403, "you don't have permission!");
        }

        if (! $request->ajax()) {
            return abort(403, 'Ajax cll required!');
        }

        $class = $request->class;
        $section = $request->section;
        $students = DB::table('student_admissions as sa')
            ->leftJoin('users as u', 'sa.user_id', 'u.id')
            ->leftJoin('student_classes as sc', 'sa.current_class_id', 'sc.id')
            ->leftJoin('student_sections as ss', 'current_section_id', 'ss.id')
            ->where('sc.id', $class)
            ->where('ss.id', $section)
            ->where('u.status', 1)
            ->where('sa.admission_status', 1)
            ->select('u.id', 'sa.id as admission_id', 'u.first_name', 'u.middle_name', 'u.last_name', 'u.father_name')
            ->get();

        return Response(json_encode($students));
    }

    public function classStudents(Request $request)
    {
        if (! auth()->user()->can('student_access')) {
            return abort(403, "you don't have permission!");
        }

        if (! $request->ajax()) {
            return view('student.class_students');
        }

        $students = DB::table('student_admissions as sa')
            ->leftJoin('users as u', 'sa.user_id', 'u.id')
            ->leftJoin('student_classes as sc', 'sa.current_class_id', 'sc.id')
            ->leftJoin('student_sections as ss', 'current_section_id', 'ss.id')
            ->where('u.status', 1)
            ->where('sa.admission_status', 1)
            ->select('u.id', 'u.first_name', 'u.middle_name', 'u.last_name', 'gender', 'sc.name as class_name', 'ss.name as section_name', 'u.father_name', 'u.mother_name', 'u.remarks', 'u.contact_number', 'u.contact_number2', 'u.email_alternate')
            ->get();
        $datatables = DataTables::of($students)
            ->addColumn('name', '{{$first_name}} {{$middle_name}} {{$last_name}}')
            ->editColumn('student_class', '{{$class_name}} {{$section_name}}')
            ->editColumn('contact_number', '{{$contact_number}}, {{$contact_number2}}')
            ->addColumn('password', function ($data) {
                return ucfirst(str_replace(' ', '', strtolower($data->first_name).'@'.substr($data->contact_number, 0, 5)));
            })
            ->editColumn('gender', function ($users) {
                if ($users->gender == 'M') {
                    return 'Male';
                }
                if ($users->gender == 'F') {
                    return 'Female';
                }
                if ($users->gender == 'O') {
                    return 'Other';
                }
            })
            ->addIndexColumn();
        $allClass = StudentClass::distinct('name')->pluck('name');
        $allSection = StudentSection::distinct('name')->pluck('name');
        $datatables->with([
            'allClasses' => $allClass,
            'allSections' => $allSection,
        ]);

        return $datatables->make(true);
    }

    public function getClassStudentsStrengthAjaxCall(Request $request)
    {
        if (! auth()->user()->can('student_access')) {
            return abort(403, "you don't have permission!");
        }

        if (! $request->ajax()) {
            return view('student.class_students_strength');
        }

        $without = '__';
        $classes = StudentClass::whereNotIn('name', ['__NONE'])->get();
        $sections = StudentSection::whereNotIn('name', ['__REMOVE', '__NOT-ASSIGNED'])->get();
        $sections_id = DB::select("select id from student_sections where name not like('%/__%') escape '/'");

        foreach ($classes as $cass) {
            $data = (object) [
                'class_name' => $cass->name,
                'harmony' => StudentAdmission::where('admission_status', 1)->where('current_class_id', $cass->id)->where('current_section_id', 2)->count(),
                'empathy' => StudentAdmission::where('admission_status', 1)->where('current_class_id', $cass->id)->where('current_section_id', 1)->count(),
                'integrity' => StudentAdmission::where('admission_status', 1)->where('current_class_id', $cass->id)->where('current_section_id', 3)->count(),
                'courage' => StudentAdmission::where('admission_status', 1)->where('current_class_id', $cass->id)->where('current_section_id', 4)->count(),
                'class_strength' => StudentAdmission::where('admission_status', 1)->where('current_class_id', $cass->id)->whereNotIn('current_section_id', [5, 6])->count(),
            ];
            $strength[] = $data;
        }

        $datatables = DataTables($strength)
            ->with('total', function () {
                return StudentAdmission::where('admission_status', 1)->whereNotIn('current_section_id', [5, 6])->count();
            });

        return $datatables->make(true);
    }
}
