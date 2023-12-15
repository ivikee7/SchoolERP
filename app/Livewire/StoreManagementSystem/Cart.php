<?php

namespace App\Livewire\StoreManagementSystem;

use App\Models\StoreManagementSystem\ProductCart;
use App\Helpers\Helper;
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
                'products' => Helper::cartUserHasProducts($this->id),
                'total' => Helper::cartSubTotal($this->id)
            ]
        );
    }

    public function addToCartIncrease($user, $product)
    {
        if (!auth()->user()->can('user_create')) {
            return abort(403, "You don't have permission!");
        }

        Helper::addToCartIncrease($user, $product);
    }

    public function addToCartDecrease($user, $product)
    {
        if (!auth()->user()->can('user_create')) {
            return abort(403, "You don't have permission!");
        }

        Helper::addToCartDecrease($user, $product);
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
        return true;
    }

    public function createInvoice($user, $discount = 0)
    {
        if (!Helper::cartUserHasProducts($user)->count() > 0) {
            exit();
        }

        $invoiceSubTotal = Helper::invoiceSubTotal($user);
        $productInvoice = Helper::productInvoiceCreate($user, $invoiceSubTotal, $discount);

        foreach (Helper::cartUserHasProducts($user) as $product) {
            Helper::productInvoiceItemCreate($productInvoice, $product);
        }

        Helper::cartClear($user);

        $this->redirect(route('store-management-system.invoice', [$this->id, $productInvoice->product_invoice_id]));
    }
}
