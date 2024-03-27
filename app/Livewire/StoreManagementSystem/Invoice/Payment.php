<?php

namespace App\Livewire\StoreManagementSystem\Invoice;

use App\Models\StoreManagementSystem\ProductPayment;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Payment extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        return view('livewire.store-management-system.invoice.payment', [
            'payments' => ProductPayment::paginate(10)
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
