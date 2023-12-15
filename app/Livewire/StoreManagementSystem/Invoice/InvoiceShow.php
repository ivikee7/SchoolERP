<?php

namespace App\Livewire\StoreManagementSystem\Invoice;

use App\Helpers\Helper;
use App\Models\Inventory\Product\ProductInvoice;
use App\Models\Inventory\Product\ProductInvoiceItem;
use App\Models\StoreManagementSystem\ProductPayment;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class InvoiceShow extends Component
{
    public $id;
    public $product_invoice_id;
    public $remaining_payment;
    public $total;
    public $payment_received;

    public function mount($id, $product_invoice_id)
    {
        $this->id = $id;
        $this->product_invoice_id = $product_invoice_id;
    }

    public function render()
    {
        $this->total = self::invoiceTotal($this->product_invoice_id);
        $this->remaining_payment = self::invoiceRemaining($this->product_invoice_id);

        return view('livewire.store-management-system.invoice.invoice-show', [
            'invoice' => Helper::productInvoiceGet($this->product_invoice_id),
            'products' => Helper::productInvoiceItemsGet($this->product_invoice_id),
            'user' => User::findOrFail(function ($query) {
                $query->from('product_invoices')->select('product_invoice_buyer_id')
                    ->where('product_invoice_id', $this->product_invoice_id)
                    ->get();
            }),
            'invoice_payments' => ProductPayment::where('product_payment_product_invoice_id', $this->product_invoice_id)
                ->get(),
        ]);
    }

    public static function createInvoice($user_id, $subTotal, $discount, $product_id)
    {
        $product_invoice = Helper::productInvoiceCreate($user_id, $subTotal, $discount);
        Helper::productInvoiceItemCreate($product_invoice, Helper::cartUserHasProducts($user_id));
        Helper::cartClear($user_id);
    }

    public function payment($product_invoice_id)
    {
        $product_payment = ProductPayment::where('product_payment_product_invoice_id', $product_invoice_id)->get();

        $product_payment_total = 0;

        if (!empty($product_payment)) {
            foreach ($product_payment as $d) {
                $product_payment_total += $d->product_payment_payment_received;
            }
        }

        if ($this->payment_received > self::invoiceRemaining($product_invoice_id)) {
            $this->redirect(route('store-management-system.invoice', [$this->id, $this->product_invoice_id]));
        }

        if ($this->total > $product_payment_total) {
            ProductPayment::create([
                'product_payment_product_invoice_id' => $product_invoice_id,
                'product_payment_total_due' => $this->total,
                'product_payment_payment_received' => $this->payment_received,
                'product_payment_remaining_due' => ($this->remaining_payment - $this->payment_received),
                'product_payment_created_by' => Auth()->user()->id,
                'product_payment_updated_by' => Auth()->user()->id,
            ]);
        }
        $this->redirect(route('store-management-system.invoice', [$this->id, $product_invoice_id]));
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

    public static function invoiceTotal($product_invoice_id)
    {
        $data = self::productInvoiceItemsGet($product_invoice_id);
        $discount = self::productInvoiceGet($product_invoice_id);

        $total = 0;

        foreach ($data as $d) {
            $total += $d->product_invoice_item_price * $d->product_invoice_item_quantity;
        }

        return ($total - $discount->product_invoice_discount);
    }

    public static function invoiceRemaining($product_invoice_id)
    {
        $invoice_items = ProductPayment::where('product_payment_product_invoice_id', $product_invoice_id)->get();

        $invoiceRemaining = 0;

        foreach ($invoice_items as $invoice_item) {
            $invoiceRemaining += $invoice_item->product_payment_payment_received;
        }

        return (self::invoiceTotal($product_invoice_id) - $invoiceRemaining);
    }

    public static function productInvoiceItemsGet($product_invoice_id)
    {
        return ProductInvoiceItem::leftJoin('class_has_products as chp', 'product_invoice_items.product_invoice_item_class_has_product_id', 'chp.class_has_product_id')
            ->leftJoin('products as p', 'chp.class_has_product_product_id', 'p.product_id')
            ->where('product_invoice_items.product_invoice_item_product_invoice_id', $product_invoice_id)
            ->get();
    }

    public static function productInvoiceGet($product_invoice_id)
    {
        return ProductInvoice::firstOrFail('product_invoice_id', $product_invoice_id)->get()[0];
    }
}
