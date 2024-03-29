<?php

namespace App\Livewire\StoreManagementSystem\Invoice;

use App\Helpers\Helper;
use App\Models\Inventory\Product\ProductInvoice;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Invoices extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        return view('livewire.store-management-system.invoice.invoices', [
            'invoices' => self::invoicesGet($this->search),
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public static function invoicesGet($search)
    {
        $data = ProductInvoice::leftJoin('users as u', 'product_invoice_buyer_id', 'u.id')
            ->where(function ($query) use ($search) {
                $columns = ['product_invoices.product_invoice_id', 'u.id', 'u.first_name', 'u.middle_name', 'u.last_name', 'u.father_name', 'u.mother_name', 'u.contact_number', 'u.contact_number2', 'u.email_alternate', 'u.address_line1', 'u.city', 'u.state', 'u.pin_code'];
                foreach (explode(" ", $search) as $item) {
                    $query->where(function ($q) use ($item, $columns) {
                        foreach ($columns as $column) {
                            $q->orWhere($column, 'like', '%' . $item . '%');
                        }
                    });
                }
            })
            ->orderBy('product_invoice_id', 'desc')
            ->paginate(2000);

        return $data;
    }

    public function user($user_id)
    {
        if ($user_id == null) {
            return null;
        }

        $user =  User::findOrFail($user_id);
        return $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name;
    }

    public function getClass($user_id)
    {
        if ($user_id == null) {
            return null;
        }

        $user =  User::leftJoin('student_admissions as sa', 'users.id', 'sa.user_id')
            ->leftJoin('student_classes as sc', 'sa.current_class_id', 'sc.id')
            ->where('users.id', $user_id)
            ->select('sc.name as class_name')
            ->get();

        return $user[0]->class_name;
    }
}
