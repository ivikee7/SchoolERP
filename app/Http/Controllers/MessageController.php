<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class MessageController extends Controller
{
    // index
    public function index(Request $request)
    {
        if (! Auth()->user()->can('message_access')) {
            return abort(403, "You Don't Have Permission!");
        }

        if ($request->ajax()) {
            $message = Message::get();

            $datatables = DataTables::of($message)
                ->editColumn('public', function ($message) {
                    if ($message->public == 0) {
                        return 'Inactive';
                    }
                    if ($message->public == 1) {
                        return 'Active';
                    }
                })
                ->addColumn('view', function ($message) {
                    $view = '<a href='.route('public.message.show', $message->id).' class="btn btn-xs btn-primary"> <i class="fas fa-eye"></i> </a>';

                    return $view;
                })
                ->addColumn('link', function ($message) {
                    $view = '<p>'.route('public.message.show', $message->id).'</p>';

                    return $view;
                })
                ->addColumn('edit', function ($message) {
                    $view = '<a href='.route('message.edit', $message->id).' class="btn btn-xs btn-primary"> <i class="fa-solid fa-pen-to-square"></i> </a>';

                    return $view;
                })
                ->setRowClass(function ($message) {
                    if ($message->public == 0) {
                        return 'bg-warning';
                    }
                });

            return $datatables->escapeColumns([])->make(true);
        }

        return view('message.index');
    }

    // Create
    public function create()
    {
        if (! Auth()->user()->can('message_create')) {
            return abort(403, "You Don't Have Permission!");
        }

        return view('message.create');
    }

    // Store
    public function store(Request $request)
    {
        if (! Auth()->user()->can('message_create')) {
            return abort(403, "You Don't Have Permission!");
        }

        $request->validate([
            'message' => 'required',
        ]);

        // return $request;
        $enquiry = Message::firstOrCreate(
            [
                'message' => $request->message,
                // 'public' => $request->public
            ],
            [
                'message' => $request->message,
                'public' => 1,
                'created_by' => Auth()->user()->id,
                'updated_by' => Auth()->user()->id,
            ]
        );

        return redirect()->route('message.index')->with(['status' => 'warning', 'message' => 'Message successfully created | Enquiry number is: '.$enquiry->id]);
    }

    // Show
    public function show($id)
    {
        if (! Auth()->user()->can('message_access')) {
            return abort(403, "You Don't Have Permission!");
        }

        // return $id;
        if (! Message::find($id)) {
            return abort(404);
        }

        $message = Message::find($id);

        return view('message.show')->with(['message' => $message]);
    }

    // Public Show
    public function showPublic($id)
    {
        // return $id;
        if (! Message::find($id)) {
            return abort(404, 'Message Not Found!');
        }

        $message = Message::find($id);

        return view('message.show')->with(['message' => $message]);
    }

    // Edit
    public function edit($id)
    {
        if (! Auth()->user()->can('message_edit')) {
            return abort(403, "You Don't Have Permission!");
        }

        if (! Message::find($id)) {
            return abort(403, 'Message Not Found!');
        }

        $message = Message::find($id);

        return view('message.edit')->with(['message' => $message]);
    }

    // Update
    public function update(Request $request, $id)
    {
        if (! Auth()->user()->can('message_edit')) {
            return abort(403, "You don't have permission!");
        }

        if (! Message::find($id)) {
            return abort(404, 'Message Not Found!');
        }

        $request->validate([
            'message' => 'required',
        ]);

        $message = Message::findOrFail($id);
        $message->message = $request->message;
        $message->updated_by = Auth()->user()->id;
        $message->save();

        return Redirect::route('message.index');
    }

    // Distroy
    public function destroy($id)
    {
        if (Auth()->user()->can('message_delete')) {
            return abort(403, "You don't have permission!");
        }

        if (! Message::find($id)) {
            return abort(404, 'Message Not Found!');
        }

        $message = Message::where('id', $id)->firstOrFail();
        $message->delete();

        return response($id);
    }
}
