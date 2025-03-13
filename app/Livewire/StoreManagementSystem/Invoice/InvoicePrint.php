<?php

namespace App\Livewire\StoreManagementSystem\Invoice;

use App\Helpers\Helper;
use App\Models\Inventory\Product\ProductInvoice;
use App\Models\Inventory\Product\ProductInvoiceItem;
use App\Models\StoreManagementSystem\ProductPayment;
use App\Models\StudentAdmission;
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
            'invoice' => self::productInvoiceGet($this->product_invoice_id),
            'products' => self::productInvoiceItemsGet($this->product_invoice_id)
                ->whereIn(
                    'class_has_product_academic_session_id',
                    StudentAdmission::where('user_id', $this->id)
                        ->pluck('academic_session_id')
                ),
            'total' => self::invoiceSubTotal($this->id, $this->product_invoice_id)

        ])->layout('components.layouts.base');
    }

    public static function productInvoiceGet($product_invoice_id)
    {
        return ProductInvoice::where('product_invoice_id', $product_invoice_id)
            ->get();
    }

    public static function productInvoiceItemsGet($product_invoice_id)
    {
        return ProductInvoiceItem::leftJoin('class_has_products as chp', 'product_invoice_items.product_invoice_item_class_has_product_id', 'chp.class_has_product_id')
            ->leftJoin('products as p', 'chp.class_has_product_product_id', 'p.product_id')
            ->where('product_invoice_items.product_invoice_item_product_invoice_id', $product_invoice_id)
            ->get();
    }

    public static function invoiceSubTotal($user_id, $product_invoice_id)
    {
        $data = self::productInvoiceItemsGet($product_invoice_id)
            ->whereIn(
                'class_has_product_academic_session_id',
                StudentAdmission::where('user_id', $user_id)
                    ->pluck('academic_session_id')
            );

        $total = 0;

        foreach ($data as $d) {
            $total += $d->product_invoice_item_price * $d->product_invoice_item_quantity;
        }

        return $total;
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
