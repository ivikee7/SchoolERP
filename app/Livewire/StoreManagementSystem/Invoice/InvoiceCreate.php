<?php

namespace App\Livewire\StoreManagementSystem\Invoice;

use App\Helpers\Helper;
use App\Models\User;
use Livewire\Component;

class InvoiceCreate extends Component
{
    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }
    public function render()
    {
        return view('livewire.store-management-system.invoice.invoice-create', [
            'products' => Helper::cartUserHasProducts($this->id),
            'user' => User::findOrFail($this->id),
            'total' => Helper::invoiceSubTotal($this->id)
        ]);
    }
}
