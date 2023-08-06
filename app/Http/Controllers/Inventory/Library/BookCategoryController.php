<?php

namespace App\Http\Controllers\Inventory\Library;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Library\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookCategoryController extends Controller
{
    public function render(Request $request)
    {
        if (! Auth()->user()->can('library_access')) {
            return abort(404);
        }
        if (! $request->ajax()) {
            return view('inventory.library.book.category.index');
        }

        $categories = BookCategory::leftJoin('books as b', 'book_categories.id', 'b.category_id')
            ->groupBy('book_categories.id')
            ->groupBy('book_categories.category_name')
            ->select('book_categories.id', 'book_categories.category_name', DB::raw('COUNT(b.id) as number_of_books'))
            ->get();

        return DataTables($categories)
            ->addColumn('action', function ($categories) {
                $view = "<a href='".route('inventry.library.book.category.edit', $categories->id)."' class='btn btn-xs btn-primary'>Edit</a>";

                return $view;
            })
            ->make(true);
    }

    public function create()
    {
        return view('inventory.library.book.category.create');
    }

    public function store(Request $request)
    {
        if (! auth()->user()->can('library_create')) {
            return abort(403, "You don't have permission!");
        }

        $request->validate([
            'category_name' => 'required',
        ]);

        if (BookCategory::where(strtolower('category_name'), strtolower($request->category_name))
            ->exists()
        ) {
            return abort(403, 'category_name already exists!');
        }

        $category = BookCategory::create([
            'category_name' => strtoupper($request->category_name),
        ]);

        return redirect()->route('inventry.library.book.category.render')->with(['status' => 'success', 'message' => 'Successfully created']);
    }

    public function show($id)
    {
        if (! auth()->user()->can('library_access')) {
            return abort(403, "You don't have permission!");
        }

        if (! BookCategory::find($id)) {
            return abort(404);
        }

        $category = BookCategory::findOrFail($id);

        return view('inventory.library.book.category.show')->with(['category' => $category]);
    }

    public function edit($id)
    {
        if (! auth()->user()->can('library_edit')) {
            return abort(403, "You don't have permission!");
        }
        $category = BookCategory::findOrFail($id);

        return view('inventory.library.book.category.edit')->with(['category' => $category]);
    }

    public function update($id, Request $request)
    {
        if (! auth()->user()->can('library_edit')) {
            return abort(403, "You don't have permission!");
        }

        if (! BookCategory::find($id)) {
            return abort(404);
        }

        $request->validate([
            'category_name' => 'required',
        ]);

        if (BookCategory::where(strtolower('category_name'), strtolower($request->category_name))
            ->where('id', '!=', $id)
            ->exists()
        ) {
            return abort(403, 'Category already exists. Please choose anuther category name!');
        }

        $category = BookCategory::findOrFail($id);
        $category->category_name = strtoupper($request->category_name);
        $category->save();

        return view('inventory.library.book.category.index');
    }
}
