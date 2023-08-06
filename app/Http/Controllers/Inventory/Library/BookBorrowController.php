<?php

namespace App\Http\Controllers\Inventory\Library;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Library\Book;
use App\Models\Inventory\Library\BookBorrow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookBorrowController extends Controller
{
    public function render(Request $request)
    {
        if (! Auth()->user()->can('library_access')) {
            return abort(404);
        }
        if (! $request->ajax()) {
            return view('inventory.library.book.borrow.index');
        }

        $borrows = BookBorrow::whereNull('book_borrows.borrow_received_at')
            ->whereNull('book_borrows.borrow_lost_at')
            // ->whereNot('r.name', ['Super Admin', 'Owner', 'principle', 'DIRECTOR'])
            ->leftJoin('books as b', 'book_borrows.borrow_book_id', 'b.id')
            ->leftJoin('users as bib', 'book_borrows.borrow_issued_by', 'bib.id')
            ->leftJoin('users as bui', 'book_borrows.borrow_user_id', 'bui.id')
            ->select('b.id as book_id', 'b.book_title', 'b.accession_number', 'book_borrows.id', 'book_borrows.borrow_issued_at', 'book_borrows.borrow_due_date', 'book_borrows.borrow_lost_at', 'bib.first_name as ussued_by_user', 'bui.id as user_id', 'bui.first_name', 'bui.middle_name', 'bui.last_name', 'bui.father_name')
            ->get();

        return DataTables($borrows)
            ->editColumn('borrow_issued_by', '{{ $ussued_by_user }}')
            ->addColumn('borrow_user', '{{ $user_id }} | {{ $first_name }} {{ $middle_name }} {{ $last_name }} | {{ $father_name }}')
            ->editColumn('status', function ($borrows) {

                $status = '';
                if ($borrows->borrow_due_date >= date(now())) {
                    $status .= '<span class="bg-warning badge rounded-pill">Issued</span>';
                }
                if ($borrows->borrow_due_date < date(now())) {
                    $status .= '<span class="bg-danger badge rounded-pill">Issued</span>';
                }

                return $status;
            })
            ->addColumn('return', function ($borrows) {
                $return = "<a href='".route('inventry.library.book.borrow.return', $borrows->id)."' class='btn btn-xs btn-success text-nowrap'>Return</a>";

                return $return;
            })
            ->addColumn('lost', function ($borrows) {
                $lost = "<a href='".route('inventry.library.book.borrow.lost', $borrows->id)."' class='btn btn-xs btn-danger text-nowrap'>Lost</a>";

                return $lost;
            })
            ->rawColumns(['status', 'return', 'lost'])
            ->make(true);
    }

    public function returneds(Request $request)
    {
        if (! Auth()->user()->can('library_access')) {
            return abort(404);
        }
        if (! $request->ajax()) {
            return view('inventory.library.book.borrow.returneds');
        }

        $borrows = BookBorrow::whereNotNull('book_borrows.borrow_received_at')
            ->leftJoin('books as b', 'book_borrows.borrow_book_id', 'b.id')
            ->leftJoin('users as bib', 'book_borrows.borrow_issued_by', 'bib.id')
            ->leftJoin('users as bui', 'book_borrows.borrow_user_id', 'bui.id')
            ->select('b.id as book_id', 'b.book_title', 'book_borrows.id', 'b.accession_number', 'book_borrows.borrow_issued_at', 'book_borrows.borrow_due_date', 'book_borrows.borrow_lost_at', 'book_borrows.borrow_received_at', 'bib.first_name as ussued_by_user', 'bui.id as user_id', 'bui.first_name', 'bui.middle_name', 'bui.last_name', 'bui.father_name')

            ->get();

        return DataTables($borrows)
            ->editColumn('borrow_issued_by', '{{ $ussued_by_user }}')
            ->addColumn('borrow_user', '{{ $user_id }} | {{ $first_name }} {{ $middle_name }} {{ $last_name }} | {{ $father_name }}')
            ->editColumn('borrow_lost_at', function ($borrows) {

                $status = '';

                if ($borrows->borrow_received_at <= $borrows->borrow_due_date) {
                    $status .= '<span class="bg-success badge rounded-pill">Returned</span>';
                }
                if ($borrows->borrow_received_at > $borrows->borrow_due_date) {
                    $status .= '<span class="bg-warning badge rounded-pill">Returned</span>';
                }

                return $status;
            })
            ->rawColumns(['borrow_lost_at', 'action'])
            ->make(true);
    }

    public function losts(Request $request)
    {
        if (! Auth()->user()->can('library_access')) {
            return abort(404);
        }
        if (! $request->ajax()) {
            return view('inventory.library.book.borrow.losts');
        }

        $borrows = BookBorrow::whereNotNull('book_borrows.borrow_lost_at')
            ->leftJoin('books as b', 'book_borrows.borrow_book_id', 'b.id')
            ->leftJoin('users as bib', 'book_borrows.borrow_issued_by', 'bib.id')
            ->leftJoin('users as bui', 'book_borrows.borrow_user_id', 'bui.id')
            ->select('b.id as book_id', 'b.book_title', 'b.accession_number', 'book_borrows.id', 'book_borrows.borrow_issued_at', 'book_borrows.borrow_due_date', 'book_borrows.borrow_lost_at', 'bib.first_name as ussued_by_user', 'bui.id as user_id', 'bui.first_name', 'bui.middle_name', 'bui.last_name', 'bui.father_name')
            ->get();

        return DataTables($borrows)
            ->editColumn('borrow_issued_by', '{{ $ussued_by_user }}')
            ->addColumn('borrow_user', '{{ $user_id }} | {{ $first_name }} {{ $middle_name }} {{ $last_name }} | {{ $father_name }}')
            ->addColumn('borrow_status', function ($borrows) {

                $status = '';
                if (! $borrows->borrow_lost_at == '') {
                    $status .= '<span class="bg-danger badge rounded-pill">Lost</span>';
                }

                return $status;
            })
            ->addColumn('action', function ($borrows) {
                $view = [];
                // $view .= "<a href='".route('inventry.library.book.borrow.edit', $borrows->book_id)."' class='btn btn-xs btn-primary'><i class='fas fa-eye'></i> View</a>";

                return $view;
            })
            ->rawColumns(['borrow_lost_at', 'action', 'borrow_status'])
            ->make(true);
    }

    public function create(Request $request)
    {
        if (! auth()->user()->can('library_create')) {
            return abort(403, "You don't have permission!");
        }

        $books = Book::all();
        $users = User::all();

        return view('inventory.library.book.borrow.create')->with([
            'books' => $books,
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        if (! auth()->user()->can('library_create')) {
            return abort(403, "You don't have permission!");
        }

        $request->validate([
            'borrow_user_id' => 'required|integer',
            'borrow_book_id' => 'required|integer',
        ]);

        BookBorrow::create([
            'borrow_user_id' => $request->borrow_user_id,
            'borrow_book_id' => $request->borrow_book_id,
            'borrow_issued_by' => Auth()->user()->id,
            'borrow_issued_at' => now(),
            'borrow_due_date' => now()->addDays(7),
        ]);

        return redirect()->route('inventry.library.book.borrow.render')->with(['status' => 'success', 'message' => 'Successfully created']);
    }

    public function return($id)
    {
        if (! auth()->user()->can('library_create')) {
            return abort(403, "You don't have permission!");
        }

        $borrow = BookBorrow::findOrFail($id);
        $borrow->borrow_received_by = Auth()->user()->id;
        $borrow->borrow_received_at = now();
        $borrow->save();

        return redirect()->route('inventry.library.book.borrow.render');
    }

    public function lost($id)
    {
        if (! auth()->user()->can('library_create')) {
            return abort(403, "You don't have permission!");
        }

        $borrow = BookBorrow::findOrFail($id);
        $borrow->borrow_lost_updated_by = Auth()->user()->id;
        $borrow->borrow_lost_at = now();
        $borrow->save();

        return redirect()->route('inventry.library.book.borrow.render');
    }

    public function getUsers(Request $request)
    {
        if (! auth()->user()->can('library_create')) {
            return abort(403, "You don't have permission!");
        }

        $users = User::leftJoin('model_has_roles as mhr', 'users.id', 'mhr.model_id')
            ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
            ->leftJoin('student_admissions as sa', 'users.id', 'sa.user_id')
            ->leftJoin('student_classes as sc', 'sa.current_class_id', 'sc.id')
            ->where('users.status', 1)
            ->whereNot('users.id', 1)
            ->where(function ($query) use ($request) {
                $columns = ['users.id', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.father_name', 'r.name', 'sc.name'];
                foreach ($request->search_input_user as $item) {
                    $query->where(function ($q) use ($item, $columns) {
                        foreach ($columns as $column) {
                            $q->orWhere($column, 'like', '%'.$item.'%');
                        }
                    });
                }
            })
            ->orderBy('users.first_name', 'ASC')
            ->limit(100)
            ->select('users.id as user_id', 'users.father_name as user_farher_anme', DB::raw("concat(users.first_name, ' ', users.middle_name, ' ', users.last_name) as user_name"), 'sc.name as class_name', 'r.name as user_role')
            ->get();

        return response()->json($users);
    }

    public function getBooks(Request $request)
    {
        if (! auth()->user()->can('library_create')) {
            return abort(403, "You don't have permission!");
        }
        $books = Book::leftJoin('book_publishers as bp', 'books.publisher_id', 'bp.id')
            ->whereNotIn('books.id', function ($query) {
                $query->select('borrow_book_id')->from('book_borrows')
                    ->whereNotNull('borrow_lost_at');
            })
            ->whereNotIn('books.id', function ($query) {
                $query->select('borrow_book_id')->from('book_borrows')
                    ->whereNotNull('borrow_issued_at')
                    ->whereNull('borrow_received_at');
            })
            ->where(function ($query) use ($request) {
                $columns = ['books.id', 'books.accession_number', 'books.book_isbn', 'books.book_title', 'books.book_author', 'bp.publisher_name', 'books.book_published_at'];
                foreach ($request->search_input_book as $item) {
                    $query->where(function ($q) use ($item, $columns) {
                        foreach ($columns as $column) {
                            $q->orWhere($column, 'like', '%'.$item.'%');
                        }
                    });
                }
            })
            ->limit(100)
            ->select('books.id as book_id', 'books.accession_number', 'books.book_isbn', 'books.book_title', 'books.book_edition', 'books.book_author', 'books.book_published_at', 'bp.publisher_name')
            ->get();

        return response()->json($books);
    }
}
