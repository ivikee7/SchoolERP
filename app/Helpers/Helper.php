<?php

namespace App\Helpers;

use App\Models\Inventory\Product\Product;
use App\Models\Inventory\Product\ProductInvoice;
use App\Models\Inventory\Product\ProductInvoiceItem;
use App\Models\StoreManagementSystem\ProductCart;

class Helper
{
    public static function cartUserHasProducts($user)
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

    public static function classHasProducts($class_id)
    {
        $data = Product::leftJoin('product_categories as pc', 'products.product_product_category_id', 'pc.product_category_id')
            ->leftJoin('class_has_products as chp', 'products.product_id', 'chp.class_has_product_product_id')
            ->where('pc.product_category_name', 'store_management_system')
            ->where('chp.class_has_product_class_id', function ($query) use ($class_id) {
                $query->select('current_class_id')
                    ->from('student_admissions  as sa')
                    ->where('sa.user_id', $class_id);
            })
            ->select('products.*', 'chp.*')
            ->get();

        return $data;
    }

    public static function productInvoiceCreate($user_id, $subTotal, $discount)
    {
        return ProductInvoice::create([
            'product_invoice_buyer_id' => $user_id,
            'product_invoice_subtotal' => $subTotal,
            'product_invoice_discount' => $discount,
            'product_invoice_gross_total' => ($subTotal - $discount),
            'product_invoice_due_date' => now(),
            'product_invoice_created_by' => Auth()->user()->id,
            'product_invoice_updated_by' => Auth()->user()->id,
        ]);
    }

    public static function productInvoiceItemCreate($invoice, $product)
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

    public static function cartSubTotal($user_id)
    {
        $data = self::cartUserHasProducts($user_id);

        $total = 0;

        foreach ($data as $d) {
            $total += $d->class_has_product_price * $d->product_cart_quantity;
        }
        return $total;
    }

    public static function invoiceSubTotal($product_invoice_id)
    {
        $data = self::productInvoiceItemsGet($product_invoice_id);

        $total = 0;

        foreach ($data as $d) {
            $total += $d->product_invoice_item_price * $d->product_invoice_item_quantity;
        }

        return $total;
    }

    public static function productInvoiceGet($product_invoice_id)
    {
        return ProductInvoice::where('product_invoice_id', $product_invoice_id)->get();
    }

    public static function productInvoiceItemGet($product_invoice_item_id)
    {
        return ProductInvoiceItem::where('product_invoice_item_id', $product_invoice_item_id)->get();
    }

    public static function productInvoicesGet($user_id)
    {
        return ProductInvoice::where('product_invoice_buyer_id', $user_id)->get();
    }

    public static function userInvoicesGet($user_id)
    {
        return ProductInvoice::where('product_invoice_buyer_id', $user_id)->get();
    }

    public static function invoicesGet($search)
    {
        $data = ProductInvoice::leftJoin('users as u', 'product_invoice_buyer_id', 'u.id')
            ->where(function ($query) use ($search) {
                // $columns = ['u.*', 'product_invoices.*'];
                $columns = ['product_invoices.product_invoice_id', 'u.id', 'u.first_name', 'u.middle_name', 'u.last_name', 'u.father_name', 'u.mother_name', 'u.contact_number', 'u.contact_number2', 'u.email_alternate', 'u.address_line1', 'u.city', 'u.state', 'u.pin_code'];
                foreach (explode(" ", $search) as $item) {
                    $query->where(function ($q) use ($item, $columns) {
                        foreach ($columns as $column) {
                            $q->orWhere($column, 'like', '%' . $item . '%');
                        }
                    });
                }
            })
            ->paginate(5);

        return $data;
    }

    public static function productInvoiceItemsGet($product_invoice_id)
    {
        return ProductInvoiceItem::leftJoin('class_has_products as chp', 'product_invoice_items.product_invoice_item_class_has_product_id', 'chp.class_has_product_id')
            ->leftJoin('products as p', 'chp.class_has_product_product_id', 'p.product_id')
            ->where('product_invoice_items.product_invoice_item_product_invoice_id', $product_invoice_id)
            ->get();
    }

    public static function addToCart($user_id, $product_id)
    {
        $product_check = ProductCart::where('product_cart_buyer_id', $user_id)->where('product_cart_product_id', $product_id)->first();
        $product_quantity = (!empty($product_check->product_cart_quantity)) ? $product_check->product_cart_quantity : null;
        $product_quantity = $product_quantity + 1;

        if ($product_quantity == 1) {
            ProductCart::create([
                'product_cart_buyer_id' => $user_id,
                'product_cart_product_id' => $product_id,
                'product_cart_quantity' => $product_quantity
            ]);
            return true;
        }

        self::addToCartIncrease($user_id, $product_id);
    }

    public static function addToCartIncrease($user_id, $product)
    {
        $product_check = ProductCart::where('product_cart_buyer_id', $user_id)->where('product_cart_product_id', $product)->first();
        $product_quantity = (!empty($product_check->product_cart_quantity)) ? $product_check->product_cart_quantity : null;

        if (!$product_quantity >= 1) {
            return false;
        }

        if ($product_quantity >= 1) {
            ProductCart::where('product_cart_buyer_id', $user_id)
                ->where('product_cart_product_id', $product)
                ->update(['product_cart_quantity' => ($product_quantity + 1)]);
            return true;
        }
    }

    public static function addToCartDecrease($user, $product)
    {
        $product_check = ProductCart::where('product_cart_buyer_id', $user)
            ->where('product_cart_product_id', $product)
            ->first();

        $product_quantity = (!empty($product_check->product_cart_quantity)) ? $product_check->product_cart_quantity : null;

        if (!$product_quantity >= 1) {
            return false;
        }

        if ($product_quantity > 1) {
            ProductCart::where('product_cart_buyer_id', $user)
                ->where('product_cart_product_id', $product)
                ->update(['product_cart_quantity' => ($product_quantity - 1)]);
            return true;
        } else {
            self::addToCartRemove($user, $product);
        }
    }

    public static function addToCartRemove($user, $product)
    {
        $product_check = ProductCart::where('product_cart_buyer_id', $user)
            ->where('product_cart_product_id', $product)
            ->count();

        if ($product_check > 0) {
            ProductCart::where('product_cart_buyer_id', $user)
                ->where('product_cart_product_id', $product)
                ->delete();
        }
    }

    public static function cartClear($user_id)
    {
        ProductCart::where('product_cart_buyer_id', $user_id)
            ->delete();
    }

    public static function addToCartCountProducts($user)
    {
        $data = ProductCart::where('product_cart_buyer_id', $user)->count();
        return $data;
    }
}
