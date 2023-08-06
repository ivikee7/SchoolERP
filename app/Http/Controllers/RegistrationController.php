<?php

namespace App\Http\Controllers;

use App\Models\StudentClass;
use App\Models\StudentRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Yajra\DataTables\DataTableAbstract
     */
    public function index(Request $request)
    {
        if (Auth()->user()->can('registration_access')) {
            if ($request->ajax()) {

                $registrations = StudentRegistration::leftJoin('users as ucn', 'student_registrations.created_by', 'ucn.id')
                    ->leftJoin('users as uun', 'student_registrations.updated_by', 'uun.id')
                    ->leftJoin('student_classes as srci', 'student_registrations.registration_class_id', 'srci.id')
                    ->leftJoin('student_classes as laci', 'student_registrations.last_attended_class_id', 'laci.id')
                    ->leftJoin('student_admissions as sa', 'student_registrations.id', 'sa.registration_id')
                    ->leftJoin('users as u', 'sa.user_id', 'u.id')
                    ->select('student_registrations.*', 'srci.name as registration_class', 'laci.name as last_attended_class', 'sa.id as admission_id', 'u.id as user_id', DB::raw("concat(ucn.first_name, ' ', ucn.middle_name, ' ', ucn.last_name) as created_by_name"), DB::raw("concat(uun.first_name, ' ', uun.middle_name, ' ', uun.last_name) as updated_by_name"))
                    ->get();

                return DataTables($registrations)
                    ->addColumn('full_name', function ($user) {
                        return str_replace('  ', ' ', $user->first_name.' '.$user->middle_name.' '.$user->last_name);
                    })
                    ->addColumn('address', '{{ $address_line1 }} {{ $city }} {{ $state }} {{ $pin_code }}')
                    ->editColumn('date_of_birth', '{{ date("Y-m-d", strtotime($date_of_birth)) }}')
                    ->editColumn('gender', function ($registrations) {
                        if ($registrations->gender == 'M') {
                            return 'Male';
                        }
                        if ($registrations->gender == 'F') {
                            return 'Female';
                        }
                        if ($registrations->gender == 'O') {
                            return 'Other';
                        }
                    })
                    ->editColumn('created_by', '{{ $created_by_name }} {{ date("Y-m-d H:i:s", strtotime($created_at)) }}')
                    ->editColumn('updated_by', '{{ $updated_by_name }} {{ date("Y-m-d H:i:s", strtotime($updated_at)) }}')
                    ->addColumn('action', function ($registrations) {
                        $btn = '';
                        if ($registrations->admission_id) {
                            $btn .= ' <span>ID'.$registrations->user_id.' A'.$registrations->admission_id.'</span>';
                        } elseif (! $registrations->admission_id) {
                            $btn .= '<button class="btn btn-xs btn-primary mt-1"><a href='.route('student.create', ['registration' => $registrations->id]).' class="text-white"><i class="fas fa-user-plus"></i>Admission</a></button>';
                        }
                        if (Auth()->user()->can('registration_delete')) {
                            $btn .= '<button class="btn btn-xs btn-danger mt-1 registration-delete" value="'.$registrations->id.'">Delete</button>';
                        }

                        return $btn;
                    })
                    ->make(true);
            }

            return view('registration.index');
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        if (Auth()->user()->can('registration_create')) {
            $classes = StudentClass::get();

            return view('registration.create', compact('classes'));
        } else {
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Auth check
        if (! auth()->user()->can('registration_create')) {
            return abort(403, "You don't have permission!");
        }

        // Validate response write or wrong
        $request->validate([
            'title' => 'required',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'date_of_birth' => 'required|date',
            'gender' => 'required',
            'father_name' => 'required',
            'father_qualification' => 'required',
            'father_occupation' => 'required',
            'father_contact_number' => 'required|integer',
            'mother_name' => 'required',
            'mother_qualification' => 'required',
            'mother_occupation' => 'required',
            'mother_contact_number' => 'required|integer',
            'address_line1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pin_code' => 'required|integer',
            'registration_class_id' => 'required|integer',
            'last_attended_school' => 'nullable',
            'last_attended_class_id' => 'required|integer',
            'payment_mode' => 'required',
        ]);

        // Check Registration extsts
        // if (StudentRegistration::where(strtolower('first_name'), strtolower($request->first_name))
        //     ->where(strtolower('middle_name'), strtolower($request->middle_name))
        //     ->where(strtolower('last_name'), strtolower($request->last_name))
        //     ->where(strtolower('father_name'), strtolower($request->father_name))
        //     ->where(strtolower('mother_name'), strtolower($request->mother_name))
        //     ->where('father_contact_number', $request->father_contact_number)
        //     ->where('mother_contact_number', $request->mother_contact_number)
        //     ->exists()
        // ) {
        //     return abort(403, 'Registration already exists!');
        // }

        // Check Registration extsts
        if (StudentRegistration::where(strtolower('first_name'), strtolower($request->first_name))
            ->where(strtolower('last_name'), strtolower($request->last_name))
            ->where(strtolower('father_name'), strtolower($request->father_name))
            ->where(strtolower('mother_name'), strtolower($request->mother_name))
            ->where('father_contact_number', $request->father_contact_number)
            ->where('mother_contact_number', $request->mother_contact_number)
            ->exists()
        ) {
            return abort(403, 'Registration already exists!');
        }

        // Registration create
        $registration = StudentRegistration::create([
            'title' => strtoupper($request->title),
            'first_name' => strtoupper($request->first_name),
            'middle_name' => strtoupper($request->middle_name),
            'last_name' => strtoupper($request->last_name),
            'date_of_birth' => strtoupper($request->date_of_birth),
            'gender' => strtoupper($request->gender),
            'father_name' => strtoupper($request->father_name),
            'father_qualification' => strtoupper($request->father_qualification),
            'father_occupation' => strtoupper($request->father_occupation),
            'father_contact_number' => $request->father_contact_number,
            'mother_name' => strtoupper($request->mother_name),
            'mother_qualification' => strtoupper($request->mother_qualification),
            'mother_occupation' => strtoupper($request->mother_occupation),
            'mother_contact_number' => $request->mother_contact_number,
            'address_line1' => strtoupper($request->address_line1),
            'city' => strtoupper($request->city),
            'state' => strtoupper($request->state),
            'pin_code' => $request->pin_code,
            'registration_class_id' => $request->registration_class_id,
            'last_attended_school' => strtoupper($request->last_attended_school),
            'last_attended_class_id' => $request->last_attended_class_id,
            'payment_mode' => $request->payment_mode,
            'created_by' => strtoupper(Auth()->user()->id),
            'updated_by' => strtoupper(Auth()->user()->id),
        ]);

        return redirect()->route('registration.create')->with('message', 'Registration successfully created | Registration number is: '.$registration->id);
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
        return $id;
        //        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth()->user()->can('registration_delete')) {
            $registration = StudentRegistration::where('id', $id)->firstOrFail();
            $registration->delete();

            return response($id);
        } else {
            return abort(403, "You don't have permission!");
        }
    }

    // Restore data
    public function restore($id)
    {
        if (Auth()->user()->can('registration_delete')) {
            StudentRegistration::withTrashed()->where('id', $id)->restore();

            return redirect(route('registration.trashed.index'));
        } else {
            return abort(403, "You don't have permission!");
        }
    }

    public function trashed(Request $request)
    {
        if (Auth()->user()->can('registration_delete')) {
            if ($request->ajax()) {

                $registrations = StudentRegistration::onlyTrashed()
                    ->leftJoin('users as ucn', 'student_registrations.created_by', 'ucn.id')
                    ->leftJoin('users as uun', 'student_registrations.updated_by', 'uun.id')
                    ->leftJoin('student_classes as srci', 'student_registrations.registration_class_id', 'srci.id')
                    ->leftJoin('student_classes as laci', 'student_registrations.last_attended_class_id', 'laci.id')
                    ->leftJoin('student_admissions as sa', 'student_registrations.id', 'sa.registration_id')
                    ->leftJoin('users as u', 'sa.user_id', 'u.id')
                    ->select('student_registrations.*', 'srci.name as registration_class', 'laci.name as last_attended_class', 'sa.id as admission_id', 'u.id as user_id', DB::raw("concat(ucn.first_name, ' ', ucn.middle_name, ' ', ucn.last_name) as created_by_name"), DB::raw("concat(uun.first_name, ' ', uun.middle_name, ' ', uun.last_name) as updated_by_name"))
                    ->get();

                return DataTables($registrations)
                    ->addColumn('full_name', '{{ $first_name }} {{ $middle_name }} {{ $last_name }}')
                    ->addColumn('address', '{{ $address_line1 }} {{ $city }} {{ $state }} {{ $pin_code }}')
                    ->editColumn('gender', function ($registrations) {
                        if ($registrations->gender == 'M') {
                            return 'Male';
                        }
                        if ($registrations->gender == 'F') {
                            return 'Female';
                        }
                        if ($registrations->gender == 'O') {
                            return 'Other';
                        }
                    })
                    ->editColumn('created_by', '{{ $created_by_name }} {{ $created_at }}')
                    ->editColumn('updated_by', '{{ $updated_by_name }} {{ $updated_at }}')
                    ->addColumn('action', function ($registrations) {
                        $btn = '';
                        $btn .= '<a href="'.route('registration.restore', $registrations->id).'" class="p-1"><button class="bg-primary btn btn-xs btn-success mb-1 rounded"><i class="fas fa-trash-restore"></i></button></a>';
                        if ($registrations->admission_id) {
                            $btn .= ' <span class="bg-success p-1 m-1 rounded"><i class="fa-solid fa-circle-check"></i></span>';
                            // $btn .= ' <button class="btn btn-xs btn-success mt-1">U' . $registrations->user_id . '</button>';
                            // $btn .= ' <button class="btn btn-xs btn-success mt-1">A' . $registrations->admission_id . '</button>';
                        } else {
                            $btn .= ' <span class="bg-danger p-1 m-1 rounded"><i class="fa-solid fa-circle-xmark"></i></span>';
                        }

                        return $btn;
                    })
                    ->make(true);
            }

            return view('registration.trashed');
        } else {
            return abort(404);
        }
    }
}
