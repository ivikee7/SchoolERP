<?php

namespace App\Http\Controllers;

use App\Models\StudentAdmission;
use App\Models\TransportRoute;
use App\Models\User;
use App\Models\UserInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Yajra\DataTables\DataTableAbstract
     */
    public function index(Request $request)
    {
        if (
            !auth()
                ->user()
                ->can('user_access')
        ) {
            return abort(403, "You don't have permission!");
        }

        if (!$request->ajax()) {
            return view('user.index');
        }

        $users = DB::table('users as u')
            ->leftJoin('model_has_roles as mhr', 'u.id', 'mhr.model_id')
            ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
            ->leftJoin('student_admissions as sa', 'u.id', 'sa.user_id')
            ->leftJoin('student_classes as sc', 'sa.current_class_id', 'sc.id')
            ->leftJoin('student_sections as ss', 'sa.current_section_id', 'ss.id')
            ->leftJoin('transport_routes as tr', 'u.transport_id', 'tr.id')
            ->leftJoin('transport_vehicles as tv', 'tr.vehicle_id', 'tv.id')
            ->leftJoin('transport_types as tt', 'tv.transport_type_id', 'tt.id')
            ->leftJoin('users as ucn', 'u.created_by', 'ucn.id')
            ->leftJoin('users as uun', 'u.updated_by', 'uun.id')
            ->whereNotIn('r.name', ['Super Admin', 'STUDENT'])
            ->select('u.id', 'u.title', 'u.first_name', 'u.middle_name', 'u.last_name', 'u.contact_number', 'u.contact_number2', 'u.address_line1', 'u.city', 'u.state', 'u.pin_code', 'u.country', 'u.aadhaar_number', 'u.mother_tongue', DB::raw('date(u.date_of_birth) as date_of_birth'), 'u.gender', 'u.father_name', 'u.mother_name', 'u.remarks', 'u.status', 'u.email', 'u.email_alternate', 'u.created_at', 'u.updated_at', 'u.media_id', 'r.name as role_name', 'tr.route_name', 'sc.name as class_name', 'ss.name as section_name', 'tt.name as transport_type_name', DB::raw("concat(ucn.first_name, ' ', ucn.middle_name, ' ', ucn.last_name) as created_by_name"), DB::raw("concat(uun.first_name, ' ', uun.middle_name, ' ', uun.last_name) as updated_by_name"))
            ->get();

        $datatables = DataTables::of($users)
            ->editColumn('id', '{{ $id }}')
            ->addColumn('profile_image', function ($user) {

                $image = '<a href="' . route('image-controller.index', $user->id) . '"><div class="text-center"><img class="img-circle" style="height:3em;width:3em;" src="dist/img/boxed-bg.jpg" alt="' . $user->gender . '"></div></a>';

                if ($user->gender == 'M') {
                    $image = '<a href="' . route('image-controller.index', $user->id) . '"><div class="text-center"><img class="img-circle" style="height:3em;width:3em;" src="dist/img/male.png" alt="' . $user->gender . '"></div></a>';
                } elseif ($user->gender == 'F') {
                    $image = '<a href="' . route('image-controller.index', $user->id) . '"><div class="text-center"><img class="img-circle" style="height:3em;width:3em;" src="dist/img/female.png" alt="' . $user->gender . '"></div></a>';
                } elseif ($user->gender == 'O') {
                    $image = '<a href="' . route('image-controller.index', $user->id) . '"><div class="text-center"><img class="img-circle" style="height:3em;width:3em;" src="dist/img/boxed-bg.jpg" alt="' . $user->gender . '"></div></a>';
                }

                if (!empty($user->media_id)) {
                    if (\App\Models\Media::where('id', $user->media_id)->exists()) {
                        $media = \App\Models\Media::findOrFail($user->media_id)["media_path"];
                        $image = '<a href="' . route('image-controller.index', $user->id) . '"><div class="text-center"><img class="img-circle" style="height:3em;width:3em;" src="' . $media . '" alt="' . str_replace('  ', ' ', $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name) . '"></div>';
                    }
                }
                return $image;
            })
            ->addColumn('full_name', function ($user) {
                return str_replace('  ', ' ', $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name);
            })
            ->addColumn('transport', '{{ $route_name }} {{ $transport_type_name }}')
            ->addColumn('contact_number', '{{ $contact_number }}, {{ $contact_number2 }}')
            ->addColumn('address', '{{ $address_line1 }}, {{ $city }}, {{ $state }}, {{ $country }}, {{ $pin_code }}')
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
            ->editColumn('created_by', '{{ $created_by_name }} {{ $created_at }}')
            ->editColumn('updated_by', '{{ $updated_by_name }} {{ $updated_at }}')
            ->editColumn('status', function ($user) {
                if ($user->status == 0) {
                    return 'Inactive';
                }
                if ($user->status == 1) {
                    return 'Active';
                }
            })
            ->addColumn('action', function ($users) {
                $view = '<a href=' . URL::current() . '/' . $users->id . ' class="btn btn-xs btn-primary">View</a>';

                return $view;
            })
            ->rawColumns(['action', 'profile_image'])
            ->setRowClass(function ($user) {
                if ($user->status == 0) {
                    return 'bg-warning';
                }
            });

        $allGenders = ['Male', 'Female', 'Other'];
        $allRoles = Role::distinct('name')->pluck('name');
        $allStatus = ['Active', 'Inactive'];

        $datatables->with([
            'allGenders' => $allGenders,
            'allRoles' => $allRoles,
            'allStatus' => $allStatus,
        ]);

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (
            !auth()
                ->user()
                ->can('user_create')
        ) {
            return abort(403, "You don't have permission!");
        }

        $roles = Role::all()
            ->whereNotIn('name', 'Super Admin')
            ->whereNotIn('name', 'STUDENT');

        $routes = TransportRoute::all();

        return view('user.create', ['roles' => $roles, 'routes' => $routes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (
            !auth()
                ->user()
                ->can('user_create')
        ) {
            return abort(403, "You don't have permission!");
        }

        // Validate request
        $request->validate([
            // User
            'role' => 'required',
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
            'status' => 'required|boolean',
            'email' => 'nullable|email',

            // User information
            'joining_date' => 'required|date',
            'allocated_casual_leave' => 'required|integer',
            'allocated_sick_leave' => 'required|integer',
            'pf_number' => 'nullable|integer',
            'esi_number' => 'nullable|integer',
            'bank_account_number' => 'nullable|integer',
            'ifsc_code' => 'nullable',
            'un_number' => 'nullable|integer',
            'pan_number' => 'nullable',
            'travel_allowance' => 'nullable|integer',
            'gross_salary' => 'nullable|integer',
            'basic_salary' => 'nullable|integer',
            'grade_salary' => 'nullable|integer',
            'pf' => 'required',
        ]);
        if (
            User::where('first_name', $request->first_name)
            ->where('contact_number', $request->contact_number)
            ->exists()
        ) {
            return abort(403, 'User already exists!');
        } elseif (User::where('email', $request->email)->exists() && $request->email != '') {
            return abort(403, 'Email id already exists');
        } else {
            $user = User::create([
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
                'created_by' => strtoupper(Auth()->user()->id),
                'updated_by' => strtoupper(Auth()->user()->id),
            ])->syncRoles($request->role);

            $user_information = UserInformation::create([
                'user_id' => $user->id,
                'joining_date' => $request->joining_date,
                'allocated_casual_leave' => $request->allocated_casual_leave,
                'allocated_sick_leave' => $request->allocated_sick_leave,
                'pf_number' => $request->pf_number,
                'esi_number' => $request->esi_number,
                'bank_account_number' => $request->bank_account_number,
                'ifsc_code' => $request->ifsc_code,
                'un_number' => $request->un_number,
                'pan_number' => $request->pan_number,
                'travel_allowance' => $request->travel_allowance,
                'gross_salary' => $request->gross_salary,
                'basic_salary' => $request->basic_salary,
                'grade_salary' => $request->grade_salary,
                'pf' => $request->pf,
            ]);

            return view('user.index')->with(['status' => 'success', 'message' => 'User successfully created | User ID: ' . $user->id]);
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
        if (
            !auth()
                ->user()
                ->can('user_show')
        ) {
            return abort(403, "You don't have permission!");
        }

        if (User::find($id) && !User::find($id)->hasAnyRole('STUDENT', 'Super Admin')) {
            $user = User::find($id)
                ->leftJoin('model_has_roles as mhr', 'users.id', 'mhr.model_id')
                ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
                ->leftJoin('user_information as ui', 'users.id', 'ui.user_id')
                ->leftJoin('student_admissions as sa', 'users.id', 'sa.user_id')
                ->leftJoin('student_classes as sc', 'sa.current_class_id', 'sc.id')
                ->leftJoin('student_sections as ss', 'sa.current_section_id', 'ss.id')
                ->leftJoin('transport_routes as tr', 'users.transport_id', 'tr.id')
                ->leftJoin('transport_vehicles as tv', 'tr.vehicle_id', 'tv.id')
                ->leftJoin('transport_types as tt', 'tv.transport_type_id', 'tt.id')
                ->whereNotIn('r.name', ['Super Admin'])
                ->where('users.id', $id)
                ->select(
                    'users.id',
                    'users.title',
                    'users.first_name',
                    'users.middle_name',
                    'users.last_name',
                    'users.contact_number',
                    'users.contact_number2',
                    'users.address_line1',
                    'users.city',
                    'users.state',
                    'users.pin_code',
                    'users.country',
                    'users.media_id',
                    'tr.route_name as transport_route_name',
                    'users.aadhaar_number',
                    'users.blood_group',
                    'users.mother_tongue',
                    'users.date_of_birth',
                    'users.place_of_birth',
                    'users.gender',
                    'users.father_name',
                    'users.mother_name',
                    'users.remarks',
                    'users.status',
                    'users.email',
                    'users.email_alternate',
                    'users.created_at',
                    'users.updated_at',
                    'r.name as role_name',
                    'tr.route_name',
                    'sc.name as class_name',
                    'ss.name as section_name',
                    'ui.joining_date',
                    'ui.termination_date',
                    'ui.allocated_casual_leave',
                    'ui.allocated_sick_leave',
                    'ui.pf_number',
                    'ui.esi_number',
                    'ui.bank_account_number',
                    'ui.ifsc_code',
                    'ui.un_number',
                    'ui.pan_number',
                    'ui.travel_allowance',
                    'ui.gross_salary',
                    'ui.basic_salary',
                    'ui.grade_salary',
                    'ui.salary_review_date',
                    'ui.pf',
                )
                ->get();

            $image = \App\Models\Media::find($user[0]->media_id);
            $admissions = \App\Models\StudentAdmission::all();
            $routes = \App\Models\TransportRoute::all();
            $roles = Role::all()
                ->whereNotIn('name', 'Super Admin')
                ->whereNotIn('name', 'STUDENT');

            return view('user.show')->with(['user' => $user[0], 'image' => $image, 'roles' => $roles, 'routes' => $routes, 'admissions' => $admissions]);
        } elseif (User::find($id) && User::find($id)->hasAnyRole('STUDENT')) {
            return redirect(route('student.show', $id));
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
        if (
            !auth()
                ->user()
                ->can('user_edit')
        ) {
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
        if (
            !auth()
                ->user()
                ->can('user_edit')
        ) {
            return abort(403, "You don't have permission!");
        }

        if (!User::find($id)) {
            return abort(404);
        }

        if (User::find($id)->hasRole('Super Admin')) {
            return abort(404);
        }

        $request->validate([
            'role' => 'required',
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

        $user = User::findOrFail($id);
        $user->title = strtoupper($request->title);
        $user->first_name = strtoupper($request->first_name);
        $user->middle_name = strtoupper($request->middle_name);
        $user->last_name = strtoupper($request->last_name);
        $user->contact_number = strtoupper($request->contact_number);
        $user->contact_number2 = strtoupper($request->contact_number2);
        $user->address_line1 = strtoupper($request->address_line1);
        $user->city = strtoupper($request->city);
        $user->state = strtoupper($request->state);
        $user->pin_code = strtoupper($request->pin_code);
        $user->country = strtoupper($request->country);
        $user->transport_id = strtoupper($request->transport_id);
        $user->aadhaar_number = strtoupper($request->aadhaar_number);
        $user->blood_group = strtoupper($request->blood_group);
        $user->mother_tongue = strtoupper($request->mother_tongue);
        $user->date_of_birth = $request->date_of_birth;
        $user->place_of_birth = strtoupper($request->place_of_birth);
        $user->gender = strtoupper($request->gender);
        $user->father_name = strtoupper($request->father_name);
        $user->mother_name = strtoupper($request->mother_name);
        $user->remarks = strtoupper($request->remarks);
        $user->termination_date = $request->termination_date;
        $user->status = strtoupper($request->status);
        $user->email = strtolower($request->email);
        $user->updated_by = Auth()->user()->id;
        $user->save();
        $user->syncRoles($request->role);

        return Redirect::route('user.show', $id)->with(['status' => 'success', 'message' => 'Success']);
    }

    public function informationUpdate(Request $request, $id)
    {
        if (
            Auth()
            ->user()
            ->can('user_create')
        ) {
            $request->validate([
                'joining_date' => 'required|date',
                'allocated_casual_leave' => 'required|integer',
                'allocated_sick_leave' => 'required|integer',
                'pf_number' => 'nullable|integer',
                'esi_number' => 'nullable|integer',
                'bank_account_number' => 'nullable|integer',
                'ifsc_code' => 'nullable',
                'un_number' => 'nullable|integer',
                'pan_number' => 'nullable',
                'travel_allowance' => 'nullable|integer',
                'gross_salary' => 'nullable|integer',
                'basic_salary' => 'nullable|integer',
                'grade_salary' => 'nullable|integer',
                'pf' => 'required',
            ]);
            if (UserInformation::where('user_id', $id)->exists()) {
                $user_information = UserInformation::where('user_id', $id)->firstOrFail();

                $user_information->joining_date = $request->joining_date;
                $user_information->allocated_casual_leave = $request->allocated_casual_leave;
                $user_information->allocated_sick_leave = $request->allocated_sick_leave;
                $user_information->pf_number = $request->pf_number;
                $user_information->esi_number = $request->esi_number;
                $user_information->bank_account_number = $request->bank_account_number;
                $user_information->ifsc_code = $request->ifsc_code;
                $user_information->un_number = $request->un_number;
                $user_information->pan_number = $request->pan_number;
                $user_information->travel_allowance = $request->travel_allowance;
                $user_information->gross_salary = $request->gross_salary;
                $user_information->basic_salary = $request->basic_salary;
                $user_information->grade_salary = $request->grade_salary;
                $user_information->pf = $request->pf;
                $user_information->save();

                return view('user.index')->with(['status' => 'success', 'message' => 'User successfully updated | User ID: ' . $id]);
            } elseif (UserInformation::where('user_id', $id)->doesntExist()) {
                $user_information = UserInformation::create([
                    'user_id' => $id,
                    'joining_date' => $request->joining_date,
                    'allocated_casual_leave' => $request->allocated_casual_leave,
                    'allocated_sick_leave' => $request->allocated_sick_leave,
                    'pf_number' => $request->pf_number,
                    'esi_number' => $request->esi_number,
                    'bank_account_number' => $request->bank_account_number,
                    'ifsc_code' => $request->ifsc_code,
                    'un_number' => $request->un_number,
                    'pan_number' => $request->pan_number,
                    'travel_allowance' => $request->travel_allowance,
                    'gross_salary' => $request->gross_salary,
                    'basic_salary' => $request->basic_salary,
                    'grade_salary' => $request->grade_salary,
                    'pf' => $request->pf,
                ]);

                return view('user.index')->with(['status' => 'success', 'message' => 'User successfully created | User ID: ' . $id]);
            }
        } else {
            return abort(403, "You don't have permission!");
        }
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
}
