<?php

namespace App\Http\Controllers;

use App\Models\StudentAdmission;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort(404);
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
        return abort(404);
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
        if (Auth()->user()->can('admission_edit') && StudentAdmission::find($id)) {
            $request->validate([
                'acadamic_session' => 'required|integer',
                'quota' => 'required|integer',
                'class' => 'required|integer',
                'section' => 'required|integer',
                'local_guardian' => 'nullable|integer',
                'relationship' => 'required',
                'admission_status' => 'required|boolean',
            ]);
            $admission = StudentAdmission::findOrFail($id);
            $admission->academic_session_id = $request->acadamic_session;
            $admission->student_quota_id = $request->quota;
            $admission->current_class_id = $request->class;
            $admission->current_section_id = $request->section;
            $admission->local_guardian_profile_id = $request->local_guardian;
            $admission->relationship = strtoupper($request->relationship);
            $admission->admission_status = $request->admission_status;
            $admission->updated_by_id = Auth()->user()->id;
            $admission->save();

            return redirect(route('student.show', $admission->user_id));
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
        return abort(404);
    }
}
