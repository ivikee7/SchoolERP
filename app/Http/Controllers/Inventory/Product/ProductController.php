<?php

namespace App\Http\Controllers\Inventory\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function render(Request $request)
    {
        if (!Auth()->user()->can('product_access')) {
            return abort(404);
        }
        if (!$request->ajax()) {
            return view('inventory.product.index');
        }
        $products = \App\Models\Inventory\Product\Product::leftJoin('product_categories as pc', 'products.product_product_category_id', 'pc.product_category_id')
            ->select('products.product_id', 'products.product_name', 'products.product_description', 'pc.product_category_name')
            ->get();

        return DataTables($products)
            ->addColumn('action', function ($products) {
                $link = null;
                $link .= "<a href='" . route('inventory.product.edit', $products->product_id) . "' class='btn btn-xs btn-primary'>Edit</a> ";
                return $link;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        if (!Auth()->user()->can('product_create')) {
            return abort(403, "You don't have permission!");
        }
        $categories = \App\Models\Inventory\Product\ProductCategory::all();
        return view('inventory.product.create')->with(['categories' => $categories]);
    }

    public function store(Request $request)
    {
        if (!Auth()->user()->can('product_create')) {
            return abort(404);
        }
        $request->validate([
            'product_name' => 'required',
            'product_description' => 'nullable',
            'product_product_category_id' => 'required|uuid',
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
            'product_product_category_id' => $request->product_product_category_id,
            'product_created_by' => Auth()->user()->id,
            'product_updated_by' => Auth()->user()->id,
        ]);

        return redirect()->route('inventory.product.render');
    }

    public function edit($id)
    {
        if (
            !auth()
                ->user()
                ->can('library_edit')
        ) {
            return abort(403, "You don't have permission!");
        }
        $product = \App\Models\Inventory\Product\Product::findOrFail($id);
        $categories = \App\Models\Inventory\Product\ProductCategory::all();

        return view('inventory.product.edit')->with(['product' => $product, 'categories' => $categories]);
    }

    public function update($id, Request $request)
    {
        if (
            !auth()
                ->user()
                ->can('product_edit')
        ) {
            return abort(403, "You don't have permission!");
        }

        if (!\App\Models\Inventory\Product\Product::find($id)) {
            return abort(404);
        }

        $request->validate([
            'product_name' => 'required',
            'product_description' => 'nullable',
            'product_product_category_id' => 'required|integer',
        ]);

        $product = \App\Models\Inventory\Product\Product::findOrFail($id);
        $product->product_name = strtoupper($request->product_name);
        $product->product_description = strtoupper($request->product_description);
        $product->product_product_category_id = $request->product_product_category_id;
        $product->updated_by = Auth()->user()->id;
        $product->save();

        return redirect()->route('inventory.product.render');
    }
}
