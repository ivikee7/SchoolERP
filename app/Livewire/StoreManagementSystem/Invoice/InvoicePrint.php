<?php

namespace App\Livewire\StoreManagementSystem\Invoice;

use App\Helpers\Helper;
use App\Models\Inventory\Product\ProductInvoice;
use App\Models\StoreManagementSystem\ProductPayment;
use App\Models\User;
use Livewire\Component;

class InvoicePrint extends Component
{
    public $id;
    public $product_invoice_id;
    public $product_invoice;
    public $user;

    public function mount($id, $product_invoice_id)
    {
        $this->id = $id;
        $this->product_invoice_id = $product_invoice_id;
    }

    public function render()
    {
        $this->product_invoice = ProductInvoice::findOrFail($this->product_invoice_id);
        $this->user = User::leftJoin('student_admissions as sa', 'users.id', 'sa.user_id')
            ->leftJoin('student_classes as sc', 'sa.current_class_id', 'sc.id')
            ->leftJoin('student_sections as ss', 'sa.current_section_id', 'ss.id')
            ->where('users.id', $this->id)
            ->select('users.*', 'sc.name as class_name', 'ss.name as section_name')
            ->first();

        return view('livewire.store-management-system.invoice.invoice-print', [
            'invoice' => Helper::productInvoiceGet($this->product_invoice_id),
            'products' => Helper::productInvoiceItemsGet($this->product_invoice_id),
            'total' => Helper::invoiceSubTotal($this->product_invoice_id)
        ])->layout('components.layouts.base');
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
}
