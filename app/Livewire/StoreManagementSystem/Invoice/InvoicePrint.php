<?php

namespace App\Livewire\StoreManagementSystem\Invoice;

use App\Helpers\Helper;
use App\Models\User;
use Livewire\Component;

class InvoicePrint extends Component
{
    public $id;
    public $product_invoice_id;

    public function mount($id, $product_invoice_id)
    {
        $this->id = $id;
        $this->product_invoice_id = $product_invoice_id;
    }

    public function render()
    {
        return view('livewire.store-management-system.invoice.invoice-print', [
            'invoice' => Helper::productInvoiceGet($this->product_invoice_id),
            'products' => Helper::productInvoiceItemsGet($this->product_invoice_id),
            'user' => User::findOrFail($this->id),
            'total' => Helper::invoiceSubTotal($this->product_invoice_id)
        ])->layout('components.layouts.base');
    }
}
