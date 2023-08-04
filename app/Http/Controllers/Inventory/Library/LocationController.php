<?php

namespace App\Http\Controllers\Inventory\Library;

use App\Http\Controllers\Controller;
use App\Models\Inventory\Library\BookLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function render(Request $request)
    {
        if (! Auth()->user()->can('library_access')) {
            return abort(404);
        }
        if (! $request->ajax()) {
            return view('inventory.library.book.location.index');
        }

        $location = BookLocation::leftJoin('books as b', 'book_locations.id', 'b.location_id')
            ->groupBy('book_locations.id')
            ->groupBy('book_locations.location_name')
            ->groupBy('book_locations.location_note')
            ->select('book_locations.id', 'book_locations.location_name', 'book_locations.location_note', DB::raw('COUNT(b.id) as number_of_books'))
            ->get();

        return DataTables($location)
            ->editColumn('location_name', '{{ $location_name }} @if(!$location_note == "") ({{ $location_note }}) @endif')
            ->addColumn('action', function ($location) {
                $view = "<a href='".route('inventry.library.book.location.edit', $location->id)."' class='btn btn-xs btn-primary'><i class='fas fa-eye'></i> View</a>";

                return $view;
            })
            ->make(true);
    }

    public function create()
    {
        if (! auth()->user()->can('library_create')) {
            return abort(403, "You don't have permission!");
        }

        return view('inventory.library.book.location.create');
    }

    public function store(Request $request)
    {
        if (! auth()->user()->can('library_create')) {
            return abort(403, "You don't have permission!");
        }

        $request->validate([
            'location_name' => 'required',
            'location_note' => 'nullable',
        ]);

        if (BookLocation::where(strtolower('location_name'), strtolower($request->location_name))
            ->exists()
        ) {
            return abort(403, 'Location already exists!');
        }

        $book = BookLocation::create([
            'location_name' => strtoupper($request->location_name),
            'location_note' => strtoupper($request->location_note),
        ]);

        return redirect()->route('inventry.library.book.location.render')->with(['status' => 'success', 'message' => 'Successfully created', 'book' => $book]);
    }

    public function show($id)
    {
        if (! auth()->user()->can('library_access')) {
            return abort(403, "You don't have permission!");
        }

        if (! BookLocation::find($id)) {
            return abort(404);
        }
        $location = BookLocation::all();

        return view('inventory.library.book.location.show')->with(['location' => $location]);
    }

    public function edit($id)
    {
        if (! auth()->user()->can('library_edit')) {
            return abort(403, "You don't have permission!");
        }
        $location = BookLocation::findOrFail($id);

        return view('inventory.library.book.location.edit')->with(['location' => $location]);
    }

    public function update($id, Request $request)
    {
        if (! auth()->user()->can('library_edit')) {
            return abort(403, "You don't have permission!");
        }

        if (! BookLocation::find($id)) {
            return abort(404);
        }

        $request->validate([
            'location_name' => 'required',
            'location_note' => 'nullable',
        ]);

        $location = BookLocation::findOrFail($id);
        $location->location_name = strtoupper($request->location_name);
        $location->location_note = strtoupper($request->location_note);
        $location->save();

        return redirect()->route('inventry.library.book.location.render');
    }
}
