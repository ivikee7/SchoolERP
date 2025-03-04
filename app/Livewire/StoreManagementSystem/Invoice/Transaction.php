<?php

namespace App\Livewire\StoreManagementSystem\Invoice;

use App\Models\AcademicSession;
use App\Models\StoreManagementSystem\ProductPayment;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inventory\Product\ProductInvoice;

class Transaction extends Component
{
    use WithPagination;

    public $search = '';
    public $acadamic_session = '';

    public function render()
    {
        return view('livewire.store-management-system.invoice.transaction', [
            'transactions' => ProductPayment::leftJoin(
                'product_invoices as pi',
                'product_payments.product_payment_product_invoice_id',
                'pi.product_invoice_id'
            )
                ->leftJoin(
                    'product_invoice_items as pii',
                    'pi.product_invoice_id',
                    'pii.product_invoice_item_product_invoice_id'
                )
                ->leftJoin(
                    'class_has_products as chp',
                    'pii.product_invoice_item_class_has_product_id',
                    'chp.class_has_product_id'
                )
                ->where('chp.class_has_product_academic_session_id', $this->acadamic_session)
                ->where(function ($q) {
                    if (!empty($this->search)) {
                        $q->where('product_payment_product_invoice_id', $this->search);
                    }
                })
                ->select('product_payments.*', 'pi.*')
                ->orderBy('product_payment_id', 'desc')
                ->paginate(50000),

            'transactions_total' => self::total(),
            'acadamic_sessions' => self::acadamic_sessions()
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

    public function total()
    {
        if (empty($this->acadamic_session)) {
            return array(
                "sub_total" => "",
                "gross_total" => "",
                "discount" => "",
                "due" => "",
            );
        }

        $product_invoice_subtotal = self::productInvoiceColumnSum($this->acadamic_session, 'product_invoice_subtotal');
        $product_invoice_discount = self::productInvoiceColumnSum($this->acadamic_session, 'product_invoice_discount');
        $product_invoice_gross_total = self::productInvoiceColumnSum($this->acadamic_session, 'product_invoice_gross_total');
        $product_invoice_due = self::productInvoiceColumnSum($this->acadamic_session, 'product_invoice_due');

        return array(
            "sub_total" => $product_invoice_subtotal,
            "discount" => $product_invoice_discount,
            "gross_total" => $product_invoice_gross_total,
            "due" => $product_invoice_due,
        );
    }

    public function productInvoiceColumnSum($acadamic_session, $column_name)
    {
        return ProductInvoice::leftJoin(
            'product_invoice_items as pii',
            'product_invoices.product_invoice_id',
            'pii.product_invoice_item_product_invoice_id'
        )
            ->leftJoin(
                'class_has_products as chp',
                'pii.product_invoice_item_class_has_product_id',
                'chp.class_has_product_id'
            )
            ->where('chp.class_has_product_academic_session_id', $acadamic_session)
            ->sum('product_invoices.' . $column_name);
    }

    public function acadamic_sessions()
    {
        return AcademicSession::select("id", "name")->get();
    }
}
