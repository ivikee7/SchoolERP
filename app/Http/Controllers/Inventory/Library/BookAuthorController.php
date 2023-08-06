<?php

namespace App\Http\Controllers\Inventory\Library;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Library\BookAuthor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookAuthorController extends Controller
{
    public function getAuthor(Request $request)
    {
        if (! Auth()->user()->can('library_edit')) {
            return abort(404);
        }

        $author = [];
        if ($request->has('search_input_author')) {
            $search_input_author = str_replace(' ', '%', $request->search_input_author);
            $author = BookAuthor::limit(5)
                ->select('book_authors.id', 'book_authors.author_name')
                ->where('book_authors.author_name', 'like', '%'.$search_input_author.'%')
                ->orderBy('book_authors.author_name', 'ASC')
                ->get();
        }

        return response()->json($author);
    }

    public function render(Request $request)
    {
        if (! Auth()->user()->can('library_access')) {
            return abort(404);
        }
        if (! $request->ajax()) {
            return view('inventory.library.book.author.index');
        }

        $authors = BookAuthor::leftJoin('books as b', 'book_authors.id', 'b.author_id')
            ->groupBy('book_authors.id')
            ->groupBy('book_authors.author_name')
            ->groupBy('book_authors.author_note')
            ->select('book_authors.id', 'book_authors.author_name', 'book_authors.author_note', DB::raw('COUNT(b.id) as number_of_books'))
            ->get();

        return DataTables($authors)
            ->addColumn('action', function ($author) {
                $view = "<a href='".route('inventry.library.book.author.edit', $author->id)."' class='btn btn-xs btn-primary'>Edit</a>";

                return $view;
            })
            ->make(true);
    }

    public function create()
    {
        return view('inventory.library.book.author.create');
    }

    public function store(Request $request)
    {
        if (! auth()->user()->can('library_manage')) {
            return abort(403, "You don't have permission!");
        }
        $request->validate([
            'author_name' => 'required',
            'author_note' => 'nullable',
        ]);

        if (BookAuthor::where(strtolower('author_name'), strtolower($request->author_name))
            ->exists()
        ) {
            return abort(403, 'Author already exists. Please choose anuther name!');
        }

        BookAuthor::create([
            'author_name' => strtoupper($request->author_name),
            'author_note' => strtoupper($request->author_note),
        ]);

        return redirect()->route('inventry.library.book.author.render');
    }

    public function edit($id)
    {
        $author = BookAuthor::findOrFail($id);

        return view('inventory.library.book.author.edit')->with(['author' => $author]);
    }

    public function update($id, Request $request)
    {
        if (! auth()->user()->can('user_edit')) {
            return abort(403, "You don't have permission!");
        }

        if (! BookAuthor::find($id)) {
            return abort(404);
        }

        $request->validate([
            'author_name' => 'required',
            'author_note' => 'nullable',
        ]);

        if (BookAuthor::where(strtolower('author_name'), strtolower($request->author_name))
            ->where('id', '!=', $id)
            ->exists()
        ) {
            return abort(403, 'Author already exists. Please enter anuther name!');
        }

        $author = BookAuthor::findOrFail($id);
        $author->author_name = strtoupper($request->author_name);
        $author->author_note = strtoupper($request->author_note);
        $author->save();

        return redirect()->route('inventry.library.book.author.render');
    }
}
