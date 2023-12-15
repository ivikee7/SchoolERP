<?php

namespace App\Http\Controllers\Inventory\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClassHasProductController extends Controller
{
    public function render(Request $request)
    {
        if (!Auth()->user()->can('product_access')) {
            return abort(404);
        }
        if (!$request->ajax()) {
            return view('inventory.product.class_has_product.index');
        }

        $classes = \App\Models\StudentClass::select('id as class_id', 'name as class_name')->get();

        return DataTables($classes)
            ->addColumn('products', function ($q) {
                $products = null;
                foreach (\App\Models\Inventory\Product\ClassHasProduct::where('class_has_product_class_id', $q->class_id)
                    ->select('class_has_product_product_id', 'class_has_product_price')
                    ->get()
                    as $chp) {
                    $products .=
                        '<div class="rounded-pill bg-success pl-2 pr-2 d-inline-block m-1" style="display: inline; padding:2px;">' .
                        $chp->class_has_product_product_id .
                        ' | ' .
                        \App\Models\Inventory\Product\Product::where('product_id', $chp->class_has_product_product_id)
                            ->select('product_name')
                            ->get()[0]->product_name .
                        ' (₹' .
                        $chp->class_has_product_price .
                        ')</div> ';
                }
                return $products;
            })
            ->addColumn('action', function ($classes) {
                $link = null;
                $link .= "<a href='" . route('inventory.product.class.has_product.render', $classes->class_id) . "' class='btn btn-xs btn-primary'>Manage</a> ";
                // $link .= "<a href='" . route('inventory.product.class.render') . "' class='btn btn-xs btn-success'>Has Products</a> ";
                return $link;
            })
            ->rawColumns(['action', 'products'])
            ->make(true);
    }

    public function classHasProducts($id, Request $request)
    {
        if (!Auth()->user()->can('product_access')) {
            return abort(404);
        }
        if (!$request->ajax()) {
            return view('inventory.product.class_has_product.has_products')->with(['id' => $id]);
        }

        $class_has_products = \App\Models\Inventory\Product\ClassHasProduct::leftJoin('products as p', 'class_has_products.class_has_product_product_id', 'p.product_id')
            ->leftJoin('product_categories as pc', 'p.product_product_category_id', 'pc.product_category_id')
            ->where('class_has_products.class_has_product_class_id', $id)
            ->select('class_has_products.class_has_product_id', 'class_has_products.class_has_product_price', 'p.product_name', 'p.product_description', 'pc.product_category_name')
            ->get();

        return DataTables($class_has_products)
            ->addColumn('product', '{{ $product_name }} ({{ $product_description }})')
            ->addColumn('class_has_product_price', '₹{{ $class_has_product_price }}')
            ->addColumn('action', function ($class_has_products) {
                $link = null;
                $link .= "<a href='" . route('inventory.product.class.edit', $class_has_products->class_has_product_id) . "' class='btn btn-xs btn-primary'>Edit</a> ";
                return $link;
            })
            ->rawColumns(['action', 'products'])
            ->make(true);
    }

    public function create($id)
    {
        if (!Auth()->user()->can('product_create')) {
            return abort(404);
        }

        $products = \App\Models\Inventory\Product\Product::whereNotIn('product_id', function ($q) use ($id) {
            $q->select('class_has_product_class_id')->from('class_has_products')->where('class_has_product_class_id', '!=', $id)->get();
        })
            ->select('products.product_id', 'products.product_name')
            ->get();

        return view('inventory.product.class_has_product.create')->with([
            'id' => $id,
            'products' => $products,
        ]);
    }

    public function store($id, Request $request)
    {
        if (
            !Auth()
                ->user()
                ->can('product_create')
        ) {
            return abort(404);
        }

        $request->validate([
            'class_has_product_id' => 'nullable',
            'class_has_product_price' => 'required',
        ]);

        if (
            \App\Models\Inventory\Product\ClassHasProduct::where('class_has_product_class_id', $id)
            ->where('class_has_product_product_id', $request->product_id)
            ->exists()
        ) {
            return abort(403, 'Product already exists!');
        }

        \App\Models\Inventory\Product\ClassHasProduct::create([
            'class_has_product_class_id' => $id,
            'class_has_product_product_id' => $request->product_id,
            'class_has_product_price' => $request->class_has_product_price,
            'class_has_product_created_by' => Auth()->user()->id,
            'class_has_product_updated_by' => Auth()->user()->id,
        ]);

        return redirect()->route('inventory.product.class.render');
    }

    public function edit($id)
    {
        if (!auth()->user()->can('library_edit')) {
            return abort(403, "You don't have permission!");
        }
        if (!\App\Models\Inventory\Product\ClassHasProduct::find($id)->exists()) {
            return abort(404);
        }

        $class_has_products = \App\Models\Inventory\Product\ClassHasProduct::findOrFail($id);

        return view('inventory.product.class_has_product.edit')->with(['class_has_products' => $class_has_products]);
    }

    public function update($id, Request $request)
    {
        if (!auth()->user()->can('product_edit')) {
            return abort(403, "You don't have permission!");
        }

        if (!\App\Models\Inventory\Product\ClassHasProduct::find($id)->exists()) {
            return abort(500);
        }

        $request->validate([
            'class_has_product_price' => 'required',
        ]);

        $product = \App\Models\Inventory\Product\ClassHasProduct::findOrFail($id);
        $product->class_has_product_price = $request->class_has_product_price;
        $product->save();

        return redirect()->route('inventory.product.class.has_product.render', $product->class_id);
    }
}
