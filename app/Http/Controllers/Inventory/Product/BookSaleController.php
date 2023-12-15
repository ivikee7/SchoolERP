<?php

namespace App\Http\Controllers\Inventory\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookSaleController extends Controller
{
    public function render(Request $request)
    {
        if (
            !Auth()
                ->user()
                ->can('product_sale')
        ) {
            return abort(403, "You don't have permission");
        }
        if (!$request->ajax()) {
            return view('inventory.product.sale.index');
        }

        $sales = \App\Models\Inventory\Product\ProductInvoice::leftJoin('users as buyer', 'product_invoices.product_invoice_buyer_id', 'buyer.id')
            ->leftJoin('users as saler', 'product_invoices.created_by', 'saler.id')
            ->select('product_invoices.product_invoice_id', 'buyer.first_name as buyer_first_name', 'buyer.middle_name as buyer_middle_name', 'buyer.last_name as buyer_last_name', 'saler.first_name as saler_first_name', 'saler.middle_name as saler_middle_name', 'saler.last_name as saler_last_name', 'product_invoices.product_invoice_subtotal as total', 'product_invoices.product_invoice_discount as discount', 'product_invoices.product_invoice_gross_total as gross_total', 'product_invoices.created_by')
            ->get();

        return DataTables($sales)
            ->addColumn('invoice', function ($q) {
                return date('Y', $q->created_at) . '/' . date('m', $q->created_at) . '/' . $q->product_invoice_id;
            })
            ->addColumn('buyer', function ($q) {
                return str_replace('  ', ' ', $q->buyer_first_name . ' ' . $q->buyer_middle_name . ' ' . $q->buyer_last_name);
            })
            ->addColumn('saler', function ($q) {
                return str_replace('  ', ' ', $q->saler_first_name . ' ' . $q->saler_middle_name . ' ' . $q->saler_last_name);
            })
            ->editColumn('created_by', function ($q) {
                return '';
            })

            ->addColumn('action', function ($q) {
                return '<a href="' . route('inventory.product.sale.show', $q->product_invoice_id) . '" class="btn btn-xs btn-primary">View</a>';
            })
            ->make(true);
    }

    public function create(Request $request)
    {
        if (
            !Auth()
                ->user()
                ->can('product_sale')
        ) {
            return abort(403, "You don't have permission");
        }

        $classes = \App\Models\StudentClass::all();

        $products = \App\Models\Inventory\Product\ClassHasProduct::leftJoin('products as p', 'class_has_products.product_id', 'p.product_id')
            ->select('class_has_products.class_has_product_id', 'class_has_products.class_has_product_price', 'p.product_name')
            ->get();

        return view('inventory.product.sale.create')->with([
            'classes' => $classes,
            'products' => $products,
        ]);
    }

    public function store(Request $request, $student_id, $class_id)
    {
        if (
            !Auth()
                ->user()
                ->can('product_sale')
        ) {
            return abort(403, "You don't have permission");
        }

        // $this->validate($request, [
        //     '*.product_id' => 'required|integer',
        //     '*.quantity' => 'required|integer',
        // ]);

        dd($request);

        $ids = $request->product_id;
        $qty = $request->quantity;

        // $invoice = \App\Models\Inventory\Product\ProductInvoice::create([
        //     'product_invoice_buyer_id'=>$student_id,
        //     'product_invoice_subtotal'=>,
        //     'product_invoice_discount'=>,
        //     'product_invoice_gross_total'=>,
        //     'product_invoice_due_date'=>now(),
        //     'created_by'=>Auth()->user()->id,
        //     'updated_by'=>Auth()->user()->id,
        // ]);

        foreach ($ids = $request->product_id as $product_id) {
            dd(\App\Models\Inventory\Product\ClassHasProduct::find($product_id)->select('class_has_product_price'));
            \App\Models\Inventory\Product\ProductInvoiceItem::create([
                'product_invoice_id' => $invoice->product_invoice_id,
                'product_id' => $product_id,
                'product_invoice_item_price' => \App\Models\Inventory\Product\ClassHasProduct::find($id)->select('class_has_product_price'),
                'product_invoice_item_quantity' => null,
                'product_invoice_item_subtotal' => null,
                'created_by' => Auth()->user()->id,
                'updated_by' => Auth()->user()->id,
            ]);
        }
    }

    public function show($id)
    {
        if (
            !Auth()
                ->user()
                ->can('product_sale')
        ) {
            return abort(403, "You don't have permission");
        }

        $invoice = \App\Models\Inventory\Product\ProductInvoice::findOrFail($id);

        $invoice_items = \App\Models\Inventory\Product\ProductInvoiceItem::where('product_invoice_id', $id)
            ->leftJoin('products as p', 'product_invoice_items.product_id', 'p.product_id')
            ->select('product_invoice_items.product_invoice_item_price', 'product_invoice_items.product_invoice_item_quantity', 'product_invoice_items.product_invoice_item_subtotal', 'p.product_name', 'p.product_description')
            ->get();

        $buyer = \App\Models\User::find($invoice->product_invoice_buyer_id);

        return view('inventory.product.sale.show')->with([
            'invoice' => $invoice,
            'invoice_items' => $invoice_items,
            'buyer' => $buyer,
        ]);
    }

    public function edit($id, Request $request)
    {
        if (
            !Auth()
                ->user()
                ->can('product_sale')
        ) {
            return abort(403, "You don't have permission");
        }
        return $request;
    }

    public function update($id, Request $request)
    {
        if (
            !Auth()
                ->user()
                ->can('product_sale')
        ) {
            return abort(403, "You don't have permission");
        }
        return $request;
    }

    public function invoicePrint($id)
    {
        if (
            !Auth()
                ->user()
                ->can('product_sale')
        ) {
            return abort(403, "You don't have permission");
        }

        $invoice = \App\Models\Inventory\Product\ProductInvoice::findOrFail($id);

        $invoice_items = \App\Models\Inventory\Product\ProductInvoiceItem::where('product_invoice_id', $id)
            ->leftJoin('products as p', 'product_invoice_items.product_id', 'p.product_id')
            ->select('product_invoice_items.product_invoice_item_price', 'product_invoice_items.product_invoice_item_quantity', 'product_invoice_items.product_invoice_item_subtotal', 'p.product_name', 'p.product_description')
            ->get();

        $buyer = \App\Models\User::find($invoice->product_invoice_buyer_id);

        return view('inventory.product.sale.invoice_print')->with([
            'invoice' => $invoice,
            'invoice_items' => $invoice_items,
            'buyer' => $buyer,
        ]);
    }

    public function getUsers(Request $request)
    {
        if (
            !auth()
                ->user()
                ->can('library_create')
        ) {
            return abort(403, "You don't have permission!");
        }

        if (!$request->ajax()) {
            return view('inventory.product.sale.student');
        }

        $users = \App\Models\User::leftJoin('model_has_roles as mhr', 'users.id', 'mhr.model_id')
            ->leftJoin('roles as r', 'mhr.role_id', 'r.id')
            ->leftJoin('student_admissions as sa', 'users.id', 'sa.user_id')
            ->leftJoin('student_classes as sc', 'sa.current_class_id', 'sc.id')
            ->where('users.status', 1)
            ->where('r.name', 'STUDENT')
            ->whereNot('users.id', 1)
            ->where(function ($query) use ($request) {
                $columns = ['users.id', 'users.first_name', 'users.middle_name', 'users.last_name', 'users.father_name', 'r.name', 'sc.name'];
                foreach ($request->search_input_user as $item) {
                    $query->where(function ($q) use ($item, $columns) {
                        foreach ($columns as $column) {
                            $q->orWhere($column, 'like', '%' . $item . '%');
                        }
                    });
                }
            })
            ->orderBy('users.first_name', 'ASC')
            ->limit(100)
            ->select('users.id as user_id', 'users.father_name as user_farher_anme', \Illuminate\Support\Facades\DB::raw("concat(users.first_name, ' ', users.middle_name, ' ', users.last_name) as user_name"), 'sc.name as class_name', 'r.name as user_role')
            ->get();

        return response()->json($users);
    }

    public function getProducts(Request $request)
    {
        // return $request;
        if (
            !Auth()
                ->user()
                ->can('product_sale')
        ) {
            return abort(403, "You don't have permission");
        }
        if (!$request->ajax()) {
            return view('inventory.product.sale.products');
        }

        $sales = \App\Models\Inventory\Product\ClassHasProduct::leftJoin('products as p', 'class_has_products.class_has_product_id', 'p.product_id')
            ->select('p.*')
            ->get();
        dd($sales);
        return DataTables($sales)
            ->make(true);
    }

    public function getBooksOfClass(Request $request)
    {
        if (
            !auth()
                ->user()
                ->can('library_create')
        ) {
            return abort(403, "You don't have permission!");
        }

        if ($request->search_input_class == '') {
            exit();
        }

        if (!\App\Models\StudentClass::find($request->search_input_class)->exists()) {
            exit();
        }

        $users = \App\Models\Inventory\Product\ClassHasProduct::where('class_id', $request->search_input_class)
            ->leftJoin('products as p', 'class_has_products.product_id', 'p.product_id')
            ->select('p.product_id', 'p.product_name')
            ->get();

        return response()->json($users);
    }

    public function addToCart($id)
    {
        $product = \App\Models\Inventory\Product\ClassHasProduct::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        return redirect()
            ->back()
            ->with('success', 'Product added to cart successfully!');
    }

    public function updateToCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function removeFromCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
