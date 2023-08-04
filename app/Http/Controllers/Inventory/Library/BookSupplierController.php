<?php

namespace App\Http\Controllers\Inventory\Library;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Library\BookSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookSupplierController extends Controller
{
    public function render(Request $request)
    {
        if (! Auth()->user()->can('library_access')) {
            return abort(404);
        }
        if (! $request->ajax()) {
            return view('inventory.library.book.supplier.index');
        }

        $categories = BookSupplier::leftJoin('books as b', 'book_suppliers.id', 'b.supplier_id')
            ->groupBy('book_suppliers.id')
            ->groupBy('book_suppliers.supplier_name')
            ->groupBy('book_suppliers.supplier_address')
            ->groupBy('book_suppliers.supplier_contact')
            ->groupBy('book_suppliers.supplier_contact2')
            ->groupBy('book_suppliers.supplier_email')
            ->groupBy('book_suppliers.supplier_status')
            ->select('book_suppliers.id', 'book_suppliers.supplier_name', 'book_suppliers.supplier_address', 'book_suppliers.supplier_contact', 'book_suppliers.supplier_contact2', 'book_suppliers.supplier_email', 'book_suppliers.supplier_status', DB::raw('COUNT(b.id) as number_of_books'))
            ->get();

        return DataTables($categories)
            ->addColumn('action', function ($categories) {
                $view = "<a href='".route('inventry.library.book.supplier.edit', $categories->id)."' class='btn btn-xs btn-primary'><i class='fas fa-eye'></i> View</a>";

                return $view;
            })
            ->make(true);
    }

    public function create()
    {
        return view('inventory.library.book.supplier.create');
    }

    public function store(Request $request)
    {
        if (! auth()->user()->can('library_create')) {
            return abort(403, "You don't have permission!");
        }

        $request->validate([
            'supplier_name' => 'required',
            'supplier_address' => 'nullable',
            'supplier_contact' => 'nullable|integer',
            'supplier_contact2' => 'nullable|integer',
            'supplier_email' => 'nullable|email',
            'supplier_status' => 'required',
        ]);

        if (BookSupplier::where(strtolower('supplier_name'), strtolower($request->supplier_name))
            ->exists()
        ) {
            return abort(403, 'Supplier already exists!');
        }

        $book = BookSupplier::create([
            'supplier_name' => strtoupper($request->supplier_name),
            'supplier_address' => strtoupper($request->supplier_address),
            'supplier_contact' => $request->supplier_contact,
            'supplier_contact2' => $request->supplier_contact2,
            'supplier_email' => strtolower($request->supplier_email),
            'supplier_status' => $request->supplier_status,
        ]);

        return redirect()->route('inventry.library.book.supplier.render')->with(['status' => 'success', 'message' => 'Successfully created']);
    }

    public function show($id)
    {
        if (! auth()->user()->can('library_access')) {
            return abort(403, "You don't have permission!");
        }

        if (! BookSupplier::find($id)) {
            return abort(404);
        }

        $supplier = BookSupplier::findOrFail($id);

        return view('inventory.library.book.supplier.show')->with(['supplier' => $supplier]);
    }

    public function edit($id)
    {
        if (! auth()->user()->can('library_edit')) {
            return abort(403, "You don't have permission!");
        }
        $supplier = BookSupplier::findOrFail($id);

        return view('inventory.library.book.supplier.edit')->with(['supplier' => $supplier]);
    }

    public function update($id, Request $request)
    {
        if (! auth()->user()->can('library_edit')) {
            return abort(403, "You don't have permission!");
        }

        if (! BookSupplier::find($id)) {
            return abort(404);
        }

        $request->validate([
            'supplier_name' => 'required',
            'supplier_address' => 'nullable',
            'supplier_contact' => 'nullable',
            'supplier_contact2' => 'nullable',
            'supplier_email' => 'nullable|email',
            'supplier_status' => 'required',
        ]);

        if (BookSupplier::where(strtolower('supplier_name'), strtolower($request->supplier_name))
            ->where('id', '!=', $id)
            ->exists()
        ) {
            return abort(403, 'Supplier already exists. Please choose supplier name!');
        }

        $supplier = BookSupplier::findOrFail($id);
        $supplier->supplier_name = strtoupper($request->supplier_name);
        $supplier->supplier_address = strtoupper($request->supplier_address);
        $supplier->supplier_contact = $request->supplier_contact;
        $supplier->supplier_contact2 = $request->supplier_contact2;
        $supplier->supplier_email = strtolower($request->supplier_email);
        $supplier->supplier_status = $request->supplier_status;
        $supplier->save();

        return view('inventory.library.book.supplier.index');
    }
}
