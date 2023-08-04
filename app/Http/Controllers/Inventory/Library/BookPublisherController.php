<?php

namespace App\Http\Controllers\Inventory\Library;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Library\BookPublisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookPublisherController extends Controller
{
    public function getPublisher(Request $request)
    {
        if (! Auth()->user()->can('library_edit')) {
            return abort(404);
        }

        $publisher = [];
        if ($request->has('search_input_publisher')) {
            $search_input_publisher = str_replace(' ', '%', $request->search_input_publisher);
            $publisher = BookPublisher::limit(5)
                ->select('book_publishers.id', 'book_publishers.publisher_name', 'book_publishers.publisher_location')
                ->where('book_publishers.publisher_name', 'like', '%'.$search_input_publisher.'%')
                ->orWhere('book_publishers.publisher_location', 'like', '%'.$search_input_publisher.'%')
                ->get();
        }

        return response()->json($publisher);
    }

    public function render(Request $request)
    {
        if (! auth()->user()->can('library_manage')) {
            return abort(403, "You don't have permission!");
        }

        if (! $request->ajax()) {
            return view('inventory.library.book.publisher.index');
        }

        $publishers = BookPublisher::leftJoin('books as b', 'book_publishers.id', 'b.publisher_id')
            ->groupBy('book_publishers.id')
            ->groupBy('book_publishers.publisher_name')
            ->groupBy('book_publishers.publisher_email')
            ->groupBy('book_publishers.publisher_contact')
            ->groupBy('book_publishers.publisher_contact2')
            ->groupBy('book_publishers.publisher_location')
            ->select('book_publishers.id', 'book_publishers.publisher_name', 'book_publishers.publisher_email', 'book_publishers.publisher_contact', 'book_publishers.publisher_contact2', 'book_publishers.publisher_location', DB::raw('COUNT(b.id) as number_of_books'))
            ->get();

        return DataTables($publishers)
            ->addColumn('action', function ($publishers) {
                $view = "<a href='".route('inventry.library.book.publisher.edit', $publishers->id)."' class='btn btn-xs btn-primary'><i class='fas fa-eye'></i> View</a>";

                return $view;
            })
            ->make(true);

    }

    public function create(Request $request)
    {
        return view('inventory.library.book.publisher.create');
    }

    public function store(Request $request)
    {
        if (! auth()->user()->can('library_manage')) {
            return abort(403, "You don't have permission");
        }

        $request->validate([
            'publisher_name' => 'required',
            'publisher_email' => 'nullable|email',
            'publisher_contact' => 'nullable|integer',
            'publisher_contact2' => 'nullable|integer',
            'publisher_location' => 'nullable',
        ]);

        if (BookPublisher::where(strtolower('publisher_name'), strtolower($request->publisher_name))
            ->exists()
        ) {
            return abort(403, 'Publisher already exists!');
        }

        BookPublisher::create([
            'publisher_name' => strtoupper($request->publisher_name),
            'publisher_email' => strtolower($request->publisher_email),
            'publisher_contact' => $request->publisher_contact,
            'publisher_contact2' => $request->publisher_contact2,
            'publisher_location' => strtoupper($request->publisher_location),
        ]);

        return redirect()->route('inventry.library.book.publisher.render');
    }

    public function edit($id)
    {
        if (! auth()->user()->can('library_manage')) {
            return abort(403, "You don't have permission!");
        }
        $publisher = BookPublisher::findOrFail($id);

        return view('inventory.library.book.publisher.edit')->with(['publisher' => $publisher]);
    }

    public function update($id, Request $request)
    {
        if (! auth()->user()->can('library_manage')) {
            return abort(403, "You don't have permission!");
        }
        if (! BookPublisher::find($id)) {
            return abort(404);
        }
        if (BookPublisher::where(strtolower('publisher_name'), strtolower($request->publisher_name))
            ->where('id', '!=', $id)
            ->exists()
        ) {
            return abort(403, 'Publisher already exists. Please entter publisher name!');
        }
        $publisher = BookPublisher::findOrFail($id);
        $publisher->publisher_name = strtoupper($request->publisher_name);
        $publisher->publisher_email = strtolower($request->publisher_email);
        $publisher->publisher_contact = $request->publisher_contact;
        $publisher->publisher_contact2 = $request->publisher_contact2;
        $publisher->publisher_location = strtoupper($request->publisher_location);
        $publisher->save();

        return redirect()->route('inventry.library.book.publisher.render');
    }
}
