<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function create(Request $request)
    {
        $students = User::leftJoin('model_has_roles as mhr', 'users.id', 'mhr.model_id')
            ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
            ->leftJoin('student_admissions as sa', 'users.id', 'sa.user_id')
            ->leftJoin('student_classes as sc', 'sa.current_class_id', 'sc.id')
            ->leftJoin('student_sections as ss', 'sa.current_section_id', 'ss.id')
            ->where('users.status', 1)
            ->where('r.name', 'student')
            ->select('users.id', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.father_name', 'sc.name as student_class', 'ss.name as student_section')
            ->get();

        return view('book.sale.create')->with(['students' => $students])->render();
    }

    public function store(Request $request)
    {
        return $request;
    }

    public function getUserInvoice($id)
    {
        $invoice = Invoice::where('user_id', $id)
            ->all();

        return response()->json($invoice);
    }
}
