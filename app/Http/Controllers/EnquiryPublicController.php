<?php

namespace App\Http\Controllers;

use App\Models\PublicEnquiry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class EnquiryPublicController extends Controller
{
    public function index(Request $request)
    {
        if (Auth()->user()->can('enquiry_access')) {
            if ($request->ajax()) {
                $enquiries = PublicEnquiry::all();

                return DataTables($enquiries)
                    ->editColumn('created_at', function ($data) {
                        return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('Y-m-d H:i:s');
                    })
                    ->make(true);
            }

            return view('public.enquiry.index');
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
            return $validator->errors();
            // return response()->json(['error' => 'failed']);
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
