<?php

namespace App\Http\Controllers\Inventory\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function render(Request $request)
    {
        if (
            !Auth()
                ->user()
                ->can('product_access')
        ) {
            return abort(404);
        }
        if (!$request->ajax()) {
            return view('inventory.product.index');
        }
        $products = \App\Models\Inventory\Product\Product::all();

        return DataTables($products)
            ->addColumn('action', function ($products) {
                $view = "<a href='" . route('inventory.product.edit', $products->product_id) . "' class='btn btn-xs btn-primary'>Edit</a>";
                return $view;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        if (
            !Auth()
                ->user()
                ->can('product_create')
        ) {
            return abort(404);
        }
        return view('inventory.product.create');
    }

    public function store(Request $request)
    {
        if (
            !Auth()
                ->user()
                ->can('product_create')
        ) {
            return abort(404);
        }
        $request->validate([
            'product_name' => 'required',
            'product_description' => 'nullable',
        ]);

        if (
            \App\Models\Inventory\Product\Product::where(strtolower('product_name'), strtolower($request->product_name))
                ->where(strtolower('product_description'), strtolower($request->product_description))
                ->exists()
        ) {
            return abort(403, 'Product already exists!');
        }

        \App\Models\Inventory\Product\Product::create([
            'product_name' => strtoupper($request->product_name),
            'product_description' => strtoupper($request->product_description),
        ]);

        return redirect()->route('inventory.product.render');
    }

    public function edit($id)
    {
        if (! auth()->user()->can('library_edit')) {
            return abort(403, "You don't have permission!");
        }
        $product = \App\Models\Inventory\Product\Product::findOrFail($id);

        return view('inventory.product.edit')->with(['product' => $product]);
    }

    public function update($id, Request $request)
    {
        if (! auth()->user()->can('product_edit')) {
            return abort(403, "You don't have permission!");
        }

        if (! \App\Models\Inventory\Product\Product::find($id)) {
            return abort(404);
        }

        $request->validate([
            'product_name' => 'required',
            'product_description' => 'nullable',
        ]);

        $product = \App\Models\Inventory\Product\Product::findOrFail($id);
        $product->product_name = strtoupper($request->product_name);
        $product->product_description = strtoupper($request->product_description);
        $product->save();

        return redirect()->route('inventory.product.render');
    }
}
