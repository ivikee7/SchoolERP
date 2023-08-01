<?php

namespace App\Http\Controllers\Inventory\Library;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Library\Book;
use App\Models\Inventory\Library\BookAuthor;
use App\Models\Inventory\Library\BookCategory;
use App\Models\Inventory\Library\BookLocation;
use App\Models\Inventory\Library\BookPublisher;
use App\Models\Inventory\Library\BookSupplier;
use App\Models\Language;
use App\Models\StudentClass;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function render(Request $request)
    {
        if (!Auth()->user()->can('library_access')) {
            return abort(404);
        }
        if (!$request->ajax()) {
            return view('inventry.library.book.index');
        }

        $books = Book::leftJoin('users as ucb', 'books.created_by', 'ucb.id')
            ->leftJoin('users as uub', 'books.updated_by', 'uub.id')
            // ->leftJoin('book_authors as ba', 'books.author_id', 'ba.id')
            ->leftJoin('book_publishers as bp', 'books.publisher_id', 'bp.id')
            ->leftJoin('book_categories as bc', 'books.category_id', 'bc.id')
            ->leftJoin('book_locations as bl', 'books.location_id', 'bl.id')
            ->leftJoin('languages as l', 'books.language_id', 'l.id')
            ->leftJoin('student_classes as sc', 'books.class_id', 'sc.id')
            ->leftJoin('subjects as s', 'books.subject_id', 's.id')
            ->select('books.id', 'books.accession_number', 'books.book_title', 'books.book_edition', 'books.book_price', 'books.book_isbn', 'books.book_pages', 'books.book_note', 'books.book_author as author_name', 'bp.publisher_name', 'bp.publisher_location', 'bl.location_name', 'l.language_name', 'sc.name as class_name', 's.subject_name', 'bc.category_name', DB::raw("concat(ucb.first_name, ' ', ucb.middle_name, ' ', ucb.last_name) as creator"), DB::raw("concat(uub.first_name, ' ', uub.middle_name, ' ', uub.last_name) as updater"))
            ->get();

        return DataTables($books)
            ->editColumn('publisher_name', '{{$publisher_name}} @if(!$publisher_location == "") ({{ $publisher_location }}) @endif')
            ->editColumn('status', function ($books) {
                $status = '<span class="bg-success badge rounded-pill">Available</span>';
                if ($books->from('book_borrows')
                    ->where('borrow_book_id', $books->id)
                    ->whereNull('borrow_lost_at')
                    ->whereNull('borrow_received_at')
                    ->exists()
                ) {
                    $status = '<span class="bg-warning badge rounded-pill">Not Available</span>';
                }
                if ($books->from('book_borrows')
                    ->where('borrow_book_id', $books->id)
                    ->whereNotNull('borrow_lost_at')
                    ->exists()
                ) {
                    $status = '<span class="bg-danger badge rounded-pill">Lost</span>';
                }

                return $status;
            })
            ->addColumn('action', function ($books) {
                $view = "<a href='" . route('inventry.library.book.edit', $books->id) . "' class='btn btn-xs btn-primary'><i class='fas fa-tools'></i> Edit</a>";

                return $view;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function create(Request $request)
    {
        if (!auth()->user()->can('library_create')) {
            return abort(403, "You don't have permission!");
        }

        $authors = BookAuthor::all();
        $publishers = BookPublisher::all();
        $categories = BookCategory::all();
        $locations = BookLocation::all();
        $languages = Language::all();
        $subjects = Subject::all();
        $classes = StudentClass::all();
        $suppliers = BookSupplier::where('supplier_status', 1)->get();

        return view('inventry.library.book.create')->with([
            'authors' => $authors,
            'publishers' => $publishers,
            'categories' => $categories,
            'locations' => $locations,
            'languages' => $languages,
            'subjects' => $subjects,
            'classes' => $classes,
            'suppliers' => $suppliers,
        ]);
    }

    public function store(Request $request, Book $book)
    {

        if (!auth()->user()->can('library_create')) {
            return abort(403, "You don't have permission!");
        }

        $request->validate([
            'book_title' => 'required',
            'book_edition' => 'nullable',
            'book_note' => 'nullable',
            'book_pages' => 'required|integer',
            'book_isbn' => 'nullable',
            'book_author' => 'required',
            'publisher_id' => 'required|integer',
            'book_published_at' => 'nullable|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'location_id' => 'required|integer',
            'language_id' => 'required|integer',
            'class_id' => 'nullable|integer',
            'subject_id' => 'nullable|integer',
            'category_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'number_of_book' => 'nullable|integer',
            'book_price' => 'required|integer',
            'purchased_at' => 'required|date', // Tempreary
            'accession_number' => 'required|integer|unique:books,accession_number', // Tempreary
        ]);

        // DB::insert('insert into books (id, created_at, book_title, book_edition, book_note, book_isbn, book_pages, book_price, book_author, publisher_id, book_published_at, location_id, language_id, class_id, subject_id, category_id, supplier_id, created_by, updated_by)
        // values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        //     [$request->id, $request->created_at, strtoupper($request->book_title), strtoupper($request->book_edition), strtoupper($request->book_note), strtoupper($request->book_isbn), $request->book_pages, $request->book_price, $request->book_author, $request->publisher_id, $request->book_published_at, $request->location_id, $request->language_id, $request->class_id, $request->subject_id, $request->category_id, $request->supplier_id, Auth()->user()->id, Auth()->user()->id]
        // );

        $number_of_book = (int) 1;
        if (!$request->number_of_book == '') {
            $number_of_book = (int) $request->number_of_book;
        }

        for ($cbc = 1; $cbc <= $number_of_book; $cbc++) {
            Book::create([
                'book_title' => strtoupper($request->book_title),
                'book_edition' => strtoupper($request->book_edition),
                'book_note' => strtoupper($request->book_note),
                'book_isbn' => strtoupper($request->book_isbn),
                'book_pages' => $request->book_pages,
                'book_price' => $request->book_price,
                'book_author' => strtoupper($request->book_author),
                'publisher_id' => $request->publisher_id,
                'book_published_at' => $request->book_published_at,
                'location_id' => $request->location_id,
                'language_id' => $request->language_id,
                'class_id' => $request->class_id,
                'subject_id' => $request->subject_id,
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                'purchased_at' => $request->purchased_at,
                'created_by' => Auth()->user()->id,
                'updated_by' => Auth()->user()->id,
                'accession_number' => $request->accession_number,
            ]);
        }

        return redirect()->route('inventry.library.book.render')->with(['status' => 'success', 'message' => 'Successfully created']);
    }

    public function show($id)
    {
        if (!auth()->user()->can('library_access')) {
            return abort(403, "You don't have permission!");
        }

        return $id;
    }

    public function edit($id)
    {
        if (!auth()->user()->can('library_edit')) {
            return abort(403, "You don't have permission!");
        }

        $authors = BookAuthor::all();
        $publishers = BookPublisher::all();
        $categories = BookCategory::all();
        $locations = BookLocation::all();
        $languages = Language::all();
        $subjects = Subject::all();
        $classes = StudentClass::all();
        $suppliers = BookSupplier::where('supplier_status', true)->get();
        $book = Book::findOrFail($id);

        return view('inventry.library.book.edit')->with([
            'authors' => $authors,
            'publishers' => $publishers,
            'categories' => $categories,
            'locations' => $locations,
            'languages' => $languages,
            'subjects' => $subjects,
            'classes' => $classes,
            'suppliers' => $suppliers,
            'book' => $book,
        ]);
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('library_edit')) {
            return abort(403, "You don't have permission!");
        }

        if (!Book::find($id)) {
            return abort(404);
        }

        $request->validate([
            'book_title' => 'required',
            'book_edition' => 'required',
            'book_note' => 'nullable',
            'book_pages' => 'required|integer',
            'book_isbn' => 'nullable',
            'book_author' => 'required',
            'publisher_id' => 'required|integer',
            'book_published_at' => 'nullable|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'location_id' => 'required|integer',
            'language_id' => 'required|integer',
            'class_id' => 'nullable|integer',
            'subject_id' => 'nullable|integer',
            'category_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'book_price' => 'required|integer',
            'purchased_at' => 'required|date', // Tempreary
        ]);

        $book = Book::findOrFail($id);
        $book->book_title = strtoupper($request->book_title);
        $book->book_edition = strtoupper($request->book_edition);
        $book->book_note = strtoupper($request->book_note);
        $book->book_pages = $request->book_pages;
        $book->book_isbn = strtoupper($request->book_isbn);
        $book->book_author = strtoupper($request->book_author);
        $book->publisher_id = $request->publisher_id;
        $book->book_published_at = $request->book_published_at;
        $book->location_id = $request->location_id;
        $book->language_id = $request->language_id;
        $book->class_id = $request->class_id;
        $book->subject_id = $request->subject_id;
        $book->category_id = $request->category_id;
        $book->supplier_id = $request->supplier_id;
        $book->book_price = $request->book_price;
        $book->purchased_at = $request->purchased_at;
        $book->save();

        return redirect()->route('inventry.library.book.render');
    }

    public function getAuthors(Request $request)
    {
        if (!auth()->user()->can('library_create')) {
            return abort(403, "You don't have permission!");
        }
        $authors = Book::get()
            ->limit(100)
            ->select('books.book_author')
            ->get();

        return response()->json($authors);
    }
}
