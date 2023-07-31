<?php

namespace App\Http\Controllers;

use App\Models\PublicEnquiry;
use App\Models\StudentEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth()->user()->can('enquiry_access')) {
            if ($request->ajax()) {

                $enquiries = StudentEnquiry::leftJoin('users as ucn', 'student_enquiries.created_by', 'ucn.id')
                    ->leftJoin('users as uun', 'student_enquiries.updated_by', 'uun.id')
                    ->leftJoin('student_classes as sc', 'student_enquiries.enquiry_class_id', 'sc.id')
                    ->select('student_enquiries.*', 'sc.name as classname', DB::raw("concat(ucn.first_name, ' ', ucn.middle_name, ' ', ucn.last_name) as created_by_name"), DB::raw("concat(uun.first_name, ' ', uun.middle_name, ' ', uun.last_name) as updated_by_name"))
                    ->get();

                return DataTables($enquiries)
                    ->addColumn('full_name', function ($user) {
                        return str_replace('  ', ' ', $user->first_name.' '.$user->middle_name.' '.$user->last_name);
                    })
                    ->editColumn('date_of_birth', function ($user) {
                        return \Carbon\Carbon::parse($user->date_of_birth)->isoFormat('YYYY-MM-DD');
                    })
                    ->addColumn('address', '{{ $address_line1 }} {{ $city }} {{ $state }} {{ $pin_code }}')
                    ->editColumn('contact_number', '{{ $contact_number }}, {{ $contact_number2 }}')
                    ->editColumn('gender', function ($enquiries) {
                        if ($enquiries->gender == 'M') {
                            return 'Male';
                        }
                        if ($enquiries->gender == 'F') {
                            return 'Female';
                        }
                        if ($enquiries->gender == 'O') {
                            return 'Other';
                        }
                    })
                    ->editColumn('created_by', '{{ $created_by_name }} {{ date("Y-m-d H:i:s", strtotime($created_at)) }}')
                    ->editColumn('updated_by', '{{ $updated_by_name }} {{ date("Y-m-d H:i:s", strtotime($updated_at)) }}')
                    ->addColumn('action', function ($enquiries) {
                        $btn = '';
                        if (Auth()->user()->can('enquiry_delete')) {
                            $btn .= ' <button class="btn btn-xs btn-danger mt-1 enquiry-delete" value="'.$enquiries->id.'"><i class="fas fa-trash"></i> </button>';
                        }

                        return $btn;
                    })
                    ->make(true);
            }

            return view('enquiry.index');
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth()->user()->can('enquiry_create')) {
            $classes = DB::table('student_classes')->get();

            return view('enquiry.create', compact('classes'));
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
        if (Auth()->user()->can('enquiry_create')) {
            $request->validate([
                'title' => 'required',
                'first_name' => 'required',
                'middle_name' => 'nullable',
                'last_name' => 'required',
                'gender' => 'required',
                'date_of_birth' => 'required|date',
                'enquiry_class_id' => 'required|integer',
                'father_name' => 'required',
                'mother_name' => 'nullable',
                'contact_number' => 'required|integer',
                'contact_number2' => 'nullable|integer',
                'address_line1' => 'nullable',
                'city' => 'nullable',
                'state' => 'nullable',
                'pin_code' => 'nullable|integer',
                'country' => 'nullable',
                'last_attended_school' => 'nullable',
                'last_attended_class' => 'nullable|integer',
                'source' => 'required|string',
            ]);

            $enquiry = StudentEnquiry::firstOrCreate(
                [
                    'title' => strtoupper($request->title),
                    'first_name' => strtoupper($request->first_name),
                    'middle_name' => strtoupper($request->middle_name),
                    'last_name' => strtoupper($request->last_name),
                    'gender' => strtoupper($request->gender),
                    'date_of_birth' => strtoupper($request->date_of_birth),
                    'enquiry_class_id' => $request->enquiry_class_id,
                    'father_name' => strtoupper($request->father_name),
                    'mother_name' => strtoupper($request->mother_name),
                    'contact_number' => $request->contact_number,
                    'contact_number2' => $request->contact_number2,
                    'address_line1' => strtoupper($request->address_line1),
                    'city' => strtoupper($request->city),
                    'state' => strtoupper($request->state),
                    'pin_code' => $request->pin_code,
                    'country' => strtoupper($request->country),
                    'last_attended_school' => strtoupper($request->last_attended_school),
                    'last_attended_class' => $request->last_attended_class,
                    'source' => strtoupper($request->source),
                ],
                [
                    'title' => strtoupper($request->title),
                    'first_name' => strtoupper($request->first_name),
                    'middle_name' => strtoupper($request->middle_name),
                    'last_name' => strtoupper($request->last_name),
                    'gender' => strtoupper($request->gender),
                    'date_of_birth' => strtoupper($request->date_of_birth),
                    'enquiry_class_id' => $request->enquiry_class_id,
                    'father_name' => strtoupper($request->father_name),
                    'mother_name' => strtoupper($request->mother_name),
                    'contact_number' => $request->contact_number,
                    'contact_number2' => $request->contact_number2,
                    'address_line1' => strtoupper($request->address_line1),
                    'city' => strtoupper($request->city),
                    'state' => strtoupper($request->state),
                    'pin_code' => $request->pin_code,
                    'country' => strtoupper($request->country),
                    'last_attended_school' => strtoupper($request->last_attended_school),
                    'last_attended_class' => $request->last_attended_class,
                    'source' => strtoupper($request->source),
                    'created_by' => Auth()->user()->id,
                    'updated_by' => Auth()->user()->id,
                ]
            );

            return redirect()->route('enquiry.create')->with(['status' => 'warning', 'message' => 'Enquiry successfully created | Enquiry number is: '.$enquiry->id]);
        } else {
            return abort(404);
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
        if (Auth()->user()->can('enquiry_delete')) {
            $enquirie = StudentEnquiry::where('id', $id)->firstOrFail();
            $enquirie->delete();

            return response($id);
        } else {
            return abort(403, "You don't have permission!");
        }
    }

    public function trashed(Request $request)
    {
        if (Auth()->user()->can('enquiry_delete')) {
            if ($request->ajax()) {

                $enquiries = StudentEnquiry::onlyTrashed()
                    ->leftJoin('users as ucn', 'student_enquiries.created_by', 'ucn.id')
                    ->leftJoin('users as uun', 'student_enquiries.updated_by', 'uun.id')
                    ->leftJoin('student_classes as sc', 'student_enquiries.enquiry_class_id', 'sc.id')
                    ->select('student_enquiries.*', 'sc.name as classname')
                    ->get();

                return DataTables($enquiries)
                    ->editColumn('gender', function ($enquiries) {
                        if ($enquiries->gender == 'M') {
                            return 'Male';
                        }
                        if ($enquiries->gender == 'F') {
                            return 'Female';
                        }
                        if ($enquiries->gender == 'O') {
                            return 'Other';
                        }
                    })
                    ->addColumn('action', function ($enquiries) {
                        $btn = '';
                        if (Auth()->user()->can('enquiry_delete')) {
                            $btn .= ' <button class="btn btn-xs btn-danger mt-1 enquiry-delete" value="'.$enquiries->id.'"><i class="fas fa-trash"></i> </button>';
                        }

                        return $btn;
                    })
                    ->make(true);
            }

            return view('enquiry.trashed');
        } else {
            return abort(404);
        }
    }

    public function publicStore(Request $request)
    {
        $rules = [
            'full_name' => 'required|string',
            'contact_number' => 'required|numeric|min:5000000000|max:10000000000',
            'email' => 'required|email',
            'message' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // return $validator->errors();
            return response()->json(['error' => 'failed']);
        } else {
            $enquiry = PublicEnquiry::create([
                'full_name' => strtoupper($request->full_name),
                'contact_number' => strtoupper($request->contact_number),
                'email' => strtolower($request->email),
                'message' => strtoupper($request->message),
            ]);
        }

        return response()->json(['success' => 'success']);
    }
}
