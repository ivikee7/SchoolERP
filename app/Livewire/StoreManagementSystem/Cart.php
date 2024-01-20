<?php

namespace App\Livewire\StoreManagementSystem;

use App\Models\StoreManagementSystem\ProductCart;
use App\Helpers\Helper;
use App\Livewire\Alert\Notification;
use App\Models\Inventory\Product\ProductInvoice;
use App\Models\Inventory\Product\ProductInvoiceItem;
use Livewire\Component;

class Cart extends Component
{
    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        return view(
            'livewire.store-management-system.cart',
            [
                'products' => self::cartUserHasProducts($this->id),
                'total' => self::cartSubTotal($this->id)
            ]
        );
    }

    public function addToCartIncrease($user, $product)
    {
        if (!auth()->user()->can('user_create')) {
            return abort(403, "You don't have permission!");
        }

        Helper::addToCartIncrease($user, $product);

        Notification::alert($this, 'success', 'Success!', 'Successfully increased!');
    }

    public function addToCartDecrease($user, $product)
    {
        if (!auth()->user()->can('user_create')) {
            return abort(403, "You don't have permission!");
        }

        Helper::addToCartDecrease($user, $product);

        Notification::alert($this, 'success', 'Success!', 'Successfully decreased!');
    }

    public function addToCartRemove($user, $product)
    {
        if (!auth()->user()->can('user_create')) {
            return abort(403, "You don't have permission!");
        }

        $product_check = ProductCart::where('product_cart_buyer_id', $user)
            ->where('product_cart_product_id', $product)
            ->count();

        if ($product_check > 0) {
            ProductCart::where('product_cart_buyer_id', $user)
                ->where('product_cart_product_id', $product)
                ->delete();

            Notification::alert($this, 'success', 'Success!', 'Product successfully removed from cart!');
        }
    }

    public function addToCartTotalCalculate($data)
    {
        $total = 0;
        foreach ($data as $d) {
            $total += $d->class_has_product_price * $d->product_quantity;
        }
        return $total;
    }

    public function cartClear($user_id)
    {
        Helper::cartClear($user_id);

        Notification::alert($this, 'success', 'Success!', 'Cart successfully cleared!');
    }

    public function createInvoice($user, $discount = 0)
    {
        if (!self::cartUserHasProducts($user)->count() > 0) {
            exit();
        }

        $invoiceSubTotal = self::cartSubTotal($user);

        $productInvoice = self::productInvoiceCreate($user, $invoiceSubTotal, $discount);

        foreach (self::cartUserHasProducts($user) as $product) {
            self::productInvoiceItemCreate($productInvoice, $product);
        }

        self::cartClear($user);

        Notification::alert($this, 'success', 'Success!', 'Invoice successfully created!');

        // $this->redirect(route('store-management-system.invoice', [$this->id, $productInvoice->product_invoice_id]));
    }

    public function cartUserHasProducts($user)
    {
        return ProductCart::leftJoin('products as p', 'product_carts.product_cart_product_id', 'p.product_id')
            ->leftJoin('class_has_products as chp', 'p.product_id', 'chp.class_has_product_product_id')
            ->leftJoin('product_categories as pc', 'p.product_product_category_id', 'pc.product_category_id')
            ->where('chp.class_has_product_class_id', function ($query) use ($user) {
                $query->select('current_class_id')
                    ->from('student_admissions  as sa')
                    ->where('sa.user_id', $user);
            })
            ->where('product_carts.product_cart_buyer_id', $user)
            ->where('pc.product_category_name', 'store_management_system')
            ->select('product_carts.*', 'p.*', 'chp.*')
            ->get();
    }

    public function cartSubTotal($user_id)
    {
        $data = self::cartUserHasProducts($user_id);

        $total = 0;

        foreach ($data as $d) {
            $total += $d->class_has_product_price * $d->product_cart_quantity;
        }
        return $total;
    }

    public static function productInvoiceCreate($user_id, $subTotal, $discount)
    {
        return ProductInvoice::create([
            'product_invoice_buyer_id' => $user_id,
            'product_invoice_subtotal' => $subTotal,
            'product_invoice_discount' => $discount,
            'product_invoice_gross_total' => ($subTotal - $discount),
            'product_invoice_due' => ($subTotal - $discount),
            'product_invoice_due_date' => now(),
            'product_invoice_created_by' => Auth()->user()->id,
            'product_invoice_updated_by' => Auth()->user()->id,
        ]);
    }

    public function productInvoiceItemCreate($invoice, $product)
    {
        return ProductInvoiceItem::create([
            'product_invoice_item_product_invoice_id' => $invoice->product_invoice_id,
            'product_invoice_item_class_has_product_id' => $product->class_has_product_id,
            'product_invoice_item_price' => $product->class_has_product_price,
            'product_invoice_item_quantity' => $product->product_cart_quantity,
            'product_invoice_item_created_by' => Auth()->user()->id,
            'product_invoice_item_updated_by' => Auth()->user()->id,
        ]);
    }
}
