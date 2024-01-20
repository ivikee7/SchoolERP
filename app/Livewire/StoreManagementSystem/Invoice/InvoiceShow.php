<?php

namespace App\Livewire\StoreManagementSystem\Invoice;

use App\Helpers\Helper;
use App\Livewire\Alert\Notification;
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
    public $product_invoice;
    public $remaining_payment;
    public $total;
    public $payment_received;
    public $product_payment_method;
    public $product_payment_remarks;
    public $payment_discount;

    public function mount($id, $product_invoice_id)
    {
        $this->id = $id;
        $this->product_invoice_id = $product_invoice_id;
    }

    public function render()
    {
        $this->product_invoice = ProductInvoice::findOrFail($this->product_invoice_id);
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

    public function user($user_id)
    {
        $user =  User::findOrFail($user_id);
        return $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name;
    }

    public static function createInvoice($user_id, $subTotal, $discount, $product_id)
    {
        $product_invoice = Helper::productInvoiceCreate($user_id, $subTotal, $discount);
        Helper::productInvoiceItemCreate($product_invoice, Helper::cartUserHasProducts($user_id));
        Helper::cartClear($user_id);
    }

    public function productInvoicePaidAmount($product_invoice_id)
    {
        $product_payment = ProductPayment::where('product_payment_product_invoice_id', $product_invoice_id)->get();

        $product_payment_total = 0;

        if (!empty($product_payment)) {
            foreach ($product_payment as $d) {
                $product_payment_total += $d->product_payment_payment_received;
            }
        }

        return $product_payment_total;
    }

    public function discount($product_invoice_id)
    {
        if (!auth()->user()->can('store_management_system_owner')) {
            $this->dispatch('modal_close_discount');
            Notification::alert($this, 'failed', 'Failed!', "You don't have permission!");
            die();
        }
        $product_payment = ProductPayment::where('product_payment_product_invoice_id', $product_invoice_id)->get();

        $product_payment_total = 0;

        if (!empty($product_payment)) {
            foreach ($product_payment as $d) {
                $product_payment_total += $d->product_payment_payment_received;
            }
        }

        $product_invoice = ProductInvoice::findOrFail($product_invoice_id);
        $product_invoice->product_invoice_discount = $this->payment_discount;
        $product_invoice->product_invoice_gross_total = ($product_invoice->product_invoice_subtotal - $this->payment_discount);
        $product_invoice->product_invoice_due = ($product_invoice->product_invoice_subtotal - $this->payment_discount) - $product_payment_total;
        $product_invoice->save();

        $this->payment_discount = null;
        $this->dispatch('modal_close_discount');
        Notification::alert($this, 'success', 'Success!', 'Discounted!');
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

        if ($this->product_invoice->product_invoice_gross_total < $product_payment_total) {
            $this->dispatch('modal_close_payment');
            Notification::alert($this, 'warning', 'Failed!', 'Please enter valid amount!');
            return;
            die();
        }

        if ($this->payment_received < 0) {
            $this->dispatch('modal_close_payment');
            Notification::alert($this, 'warning', 'Failed!', 'Negative amount not valid!');
            return;
            die();
        }

        if ($this->product_invoice->product_payment_remaining_due >= $this->payment_received) {
            $this->dispatch('modal_close_payment');
            Notification::alert($this, 'warning', 'Failed!', 'Please enter valid amount!');
            return;
            die();
        }

        ProductPayment::create([
            'product_payment_product_invoice_id' => $product_invoice_id,
            'product_payment_total_due' => $this->remaining_payment,
            'product_payment_payment_received' => $this->payment_received,
            'product_payment_remaining_due' => ($this->remaining_payment - $this->payment_received),
            'product_payment_method' => $this->product_payment_method,
            'product_payment_remarks' => $this->product_payment_remarks,
            'product_payment_created_by' => Auth()->user()->id,
            'product_payment_updated_by' => Auth()->user()->id,
        ]);
        $invoice = ProductInvoice::findOrFail($product_invoice_id);
        $invoice->product_invoice_due = ($this->remaining_payment - $this->payment_received);
        $invoice->save();

        $this->payment_received = null;
        $this->dispatch('modal_close_payment');
        Notification::alert($this, 'success', 'Success!', 'Payment successfully!');
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
