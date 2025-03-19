<?php

namespace App\Livewire\StoreManagementSystem;

use App\Models\StoreManagementSystem\ProductCart;
use App\Helpers\Helper;
use App\Livewire\Alert\Notification;
use App\Models\Inventory\Product\ProductInvoice;
use App\Models\Inventory\Product\ProductInvoiceItem;
use App\Models\StudentAdmission;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
                'products' => self::cart($this->id),
                // 'products' => self::cartUserHasProducts($this->id)
                //     ->whereIn(
                //         'class_has_product_academic_session_id',
                //         StudentAdmission::where('user_id', $this->id)
                //             ->pluck('academic_session_id')
                //     ),
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

    public function createInvoice($user_id, $discount = 0)
    {
        if (!self::cart($user_id)->count() > 0) {
            exit();
        }

        $invoiceSubTotal = self::cartSubTotal($user_id);
        $productInvoice = self::productInvoiceCreate($user_id, $invoiceSubTotal, $discount);

        // dd(self::cartUserHasProducts($user_id));
        // dd($productInvoice);

        // foreach (self::cartUserHasProducts($user_id) as $product) {
        //     self::productInvoiceItemCreate($productInvoice, $product);
        // }

        foreach (self::cart($user_id) as $product) {
            self::productInvoiceItemCreate($productInvoice, $product);
        }

        self::cartClear($user_id);

        Notification::alert($this, 'success', 'Success!', 'Invoice successfully created!');
        $this->redirect(route('store-management-system.invoice', [$this->id, $productInvoice->product_invoice_id]), navigate: true);
    }

    public function cartUserHasProducts($user)
    {
        $data = ProductCart::leftJoin('products as p', 'product_carts.product_cart_product_id', 'p.product_id')
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

        return $data;
    }

    public function cartSubTotal($user_id)
    {
        // $data = self::cartUserHasProducts($user_id)
        //     ->whereIn(
        //         'class_has_product_academic_session_id',
        //         StudentAdmission::where('user_id', $this->id)
        //             ->pluck('academic_session_id')
        //     );

        $data = self::cart($user_id);

        $total = 0;

        foreach ($data as $d) {
            $total += $d->classHasProduct->class_has_product_price * $d->product_cart_quantity;
        }
        return $total;
    }

    public static function productInvoiceCreate($user_id, $sub_total, $discounted_amount)
    {
        return ProductInvoice::create([
            'product_invoice_buyer_id' => $user_id,
            'product_invoice_subtotal' => $sub_total,
            'product_invoice_discount' => $discounted_amount,
            'product_invoice_gross_total' => ($sub_total - $discounted_amount),
            'product_invoice_due' => ($sub_total - $discounted_amount),
            'product_invoice_due_date' => now(),
            'product_invoice_created_by' => auth()->user()->id,
            'product_invoice_updated_by' => auth()->user()->id,
        ]);
    }

    public function productInvoiceItemCreate($invoice, $cart_item)
    {
        return ProductInvoiceItem::create([
            'product_invoice_item_product_invoice_id' => $invoice->product_invoice_id,
            'product_invoice_item_class_has_product_id' => $cart_item->classHasProduct->class_has_product_id,
            'product_invoice_item_price' => $cart_item->classHasProduct->class_has_product_price,
            'product_invoice_item_quantity' => $cart_item->product_cart_quantity,
            'product_invoice_item_created_by' => Auth()->user()->id,
            'product_invoice_item_updated_by' => Auth()->user()->id,
        ]);
    }

    public function cart($user_id)
    {
        return ProductCart::with('classHasProduct', 'classHasProduct.product')->where('product_cart_buyer_id', $user_id)->get();
    }
}
