<?php

namespace App\Livewire\StoreManagementSystem\Invoice;

use App\Models\StoreManagementSystem\ProductPayment;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Transaction extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        return view('livewire.store-management-system.invoice.transaction', [
            'transactions' => ProductPayment::leftJoin('product_invoices as pi', 'product_payments.product_payment_product_invoice_id', 'pi.product_invoice_id')
                ->where(function ($q) {
                    if (!empty($this->search)) {
                        $q->where('product_payment_product_invoice_id', $this->search);
                    }
                })
                ->select('product_payments.*', 'pi.*')
                ->orderBy('product_payment_id', 'desc')
                ->paginate(2000)
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function user($user_id)
    {
        $user =  User::findOrFail($user_id);
        return $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name;
    }
}
