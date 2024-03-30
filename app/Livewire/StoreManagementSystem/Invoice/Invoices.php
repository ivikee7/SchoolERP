<?php

namespace App\Livewire\StoreManagementSystem\Invoice;

use App\Helpers\Helper;
use App\Livewire\Alert\Notification;
use App\Models\Inventory\Product\ProductInvoice;
use App\Models\Inventory\Product\ProductInvoiceItem;
use App\Models\StoreManagementSystem\ProductPayment;
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

    public function getClass($invoice_id)
    {
        if ($invoice_id == null) {
            return null;
        }

        // $user =  User::leftJoin('student_admissions as sa', 'users.id', 'sa.user_id')
        //     ->leftJoin('student_classes as sc', 'sa.current_class_id', 'sc.id')
        //     ->where('users.id', $user_id)
        //     ->select('sc.name as class_name')
        //     ->first();

        $user = ProductInvoice::leftJoin('product_invoice_items as pii', 'product_invoices.product_invoice_id', 'pii.product_invoice_item_product_invoice_id')
            ->leftJoin('class_has_products as chp', 'pii.product_invoice_item_class_has_product_id', 'chp.class_has_product_id')
            ->leftJoin('student_classes as sc', 'chp.class_has_product_class_id', 'sc.id')
            ->select('sc.name as class_name')
            ->where('product_invoices.product_invoice_id', $invoice_id)
            ->first();

        return $user->class_name;
    }

    public function paymentNotReceived($invoice_id)
    {
        return ProductPayment::where('product_payment_product_invoice_id', $invoice_id)
            ->exists();
    }

    public function destroy($invoice_id)
    {
        if (!auth()->user()->can('store_management_system_owner')) {
            return Notification::alert($this, 'warning', 'Failed!', "You don't have permission!");
        }

        if (!ProductInvoice::find($invoice_id)) {
            return Notification::alert($this, 'warning', 'Failed!', "Invoice not exists!");
        }

        ProductPayment::where('product_payment_product_invoice_id', $invoice_id)->delete();
        ProductInvoiceItem::where('product_invoice_item_product_invoice_id', $invoice_id)->delete();
        ProductInvoice::where('product_invoice_id', $invoice_id)->delete();

        return Notification::alert($this, 'success', 'Success!', 'Successfully deleted!');
    }
}
