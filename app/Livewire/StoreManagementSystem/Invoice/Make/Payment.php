<?php

namespace App\Livewire\StoreManagementSystem\Invoice\Make;

use LivewireUI\Modal\ModalComponent;

class Payment extends ModalComponent
{
    public function render()
    {
        return view('livewire.store-management-system.invoice.make.payment');
    }
}
