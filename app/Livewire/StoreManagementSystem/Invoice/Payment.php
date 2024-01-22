<?php

namespace App\Livewire\StoreManagementSystem\Invoice;

use App\Models\StoreManagementSystem\ProductPayment;
use Livewire\Component;
use Livewire\WithPagination;

class Payment extends Component
{
    use WithPagination;

    public $search = '';
    // public $payments;

    public function render()
    {
        // $this->payments =
        return view('livewire.store-management-system.invoice.payment', [
            'payments' => ProductPayment::get()->partition(5)
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
