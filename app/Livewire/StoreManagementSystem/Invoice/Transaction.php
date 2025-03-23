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
    public $date = '';

    public function render()
    {
        return view('livewire.store-management-system.invoice.transaction', [
            // 'transactions' => ProductPayment::leftJoin(
            //     'product_invoices as pi',
            //     'product_payments.product_payment_product_invoice_id',
            //     'pi.product_invoice_id'
            // )
            //     ->leftJoin(
            //         'product_invoice_items as pii',
            //         'pi.product_invoice_id',
            //         'pii.product_invoice_item_product_invoice_id'
            //     )
            //     ->leftJoin(
            //         'class_has_products as chp',
            //         'pii.product_invoice_item_class_has_product_id',
            //         'chp.class_has_product_id'
            //     )
            //     ->where('chp.class_has_product_academic_session_id', $this->acadamic_session)
            //     ->where(function ($q) {
            //         if (!empty($this->search)) {
            //             $q->where('product_payment_product_invoice_id', $this->search);
            //         }
            //     })
            //     ->select('product_payments.*', 'pi.*')
            //     ->orderBy('product_payment_id', 'desc')
            //     ->paginate(50000),
            'transactions' => self::transactions($this->acadamic_session, $this->date, $this->search),
            'transactions_total' => self::total_old(),
            'total' => self::total($this->acadamic_session, $this->date),
            'acadamic_sessions' => self::acadamic_sessions()
        ]);
    }

    public function transactions($acadamic_session_id, $date, $search)
    {
        return ProductPayment::with(array(
            'invoice',
            'invoice.student'
        ))
            ->when(!empty($date), function ($query) use ($date) {
                $query->whereDate('product_payment_created_at', $date);
            })
            ->whereHas('invoice', function ($q) use ($acadamic_session_id) {
                $q->where('product_invoice_academic_session_id', $acadamic_session_id);
            })
            ->whereHas('invoice', function ($q) use ($search) {
                if (!empty($search)) {
                    $q->where('product_payment_product_invoice_id', $search);
                }
            })
            ->orderBy('product_payment_id', 'desc')
            ->paginate(100);
    }

    public function total($acadamic_session_id, $date)
    {
        $user_data = ProductPayment::groupBy('product_payment_created_by')
            ->whereHas('invoice', function ($q) use ($acadamic_session_id) {
                return $q->where('product_invoice_academic_session_id', $acadamic_session_id);
            })
            ->when(!empty($date), function ($query) use ($date) {
                $query->whereDate('product_payment_created_at', $date);
            })
            ->pluck('product_payment_created_by')
            ->map(
                fn($array_map) => collect()
                    ->put(
                        'creator',
                        User::find($array_map)
                    )
                    ->put(
                        'cash',
                        ProductPayment::with('invoice')
                            ->whereHas('invoice', function ($q) use ($acadamic_session_id) {
                                return $q->where('product_invoice_academic_session_id', $acadamic_session_id);
                            })
                            ->where('product_payment_created_by', $array_map)
                            ->when(!empty($date), function ($query) use ($date) {
                                $query->whereDate('product_payment_created_at', $date);
                            })
                            ->where('product_payment_method', 'Cash')
                            ->sum('product_payment_payment_received')
                    )
                    ->put(
                        'online',
                        ProductPayment::where('product_payment_created_by', $array_map)
                            ->whereHas('invoice', function ($q) use ($acadamic_session_id) {
                                return $q->where('product_invoice_academic_session_id', $acadamic_session_id);
                            })
                            ->when(!empty($date), function ($query) use ($date) {
                                $query->whereDate('product_payment_created_at', $date);
                            })
                            ->where('product_payment_method', 'Online')
                            ->sum('product_payment_payment_received')
                    )
                    ->put(
                        'total',
                        ProductPayment::where('product_payment_created_by', $array_map)
                            ->whereHas('invoice', function ($q) use ($acadamic_session_id) {
                                return $q->where('product_invoice_academic_session_id', $acadamic_session_id);
                            })
                            ->when(!empty($date), function ($query) use ($date) {
                                $query->whereDate('product_payment_created_at', $date);
                            })
                            ->sum('product_payment_payment_received')
                    )
            );
        return array(
            "amount_session_total" => ProductInvoice::where('product_invoice_academic_session_id', $acadamic_session_id)
                ->sum('product_invoice_subtotal'),
            "amount_session_discount" => ProductInvoice::where('product_invoice_academic_session_id', $acadamic_session_id)
                ->sum('product_invoice_discount'),
            "amount_session_received" => ProductPayment::with('invoice')->whereHas('invoice', function ($q) use ($acadamic_session_id) {
                $q->where('product_invoice_academic_session_id', $acadamic_session_id);
            })
                ->sum('product_payment_payment_received'),
            "amount_session_due" => ProductInvoice::where('product_invoice_academic_session_id', $acadamic_session_id)
                ->sum('product_invoice_due'),
            "amount_cash" => ProductPayment::with('invoice')->whereHas('invoice', function ($q) use ($acadamic_session_id) {
                $q->where('product_invoice_academic_session_id', $acadamic_session_id);
            })
                ->when(!empty($date), function ($query) use ($date) {
                    $query->whereDate('product_payment_created_at', $date);
                })
                ->where('product_payment_method', 'Cash')
                ->sum('product_payment_payment_received'),
            "amount_online" => ProductPayment::with('invoice')->whereHas('invoice', function ($q) use ($acadamic_session_id) {
                $q->where('product_invoice_academic_session_id', $acadamic_session_id);
            })
                ->when(!empty($date), function ($query) use ($date) {
                    $query->whereDate('product_payment_created_at', $date);
                })
                ->where('product_payment_method', 'Online')
                ->sum('product_payment_payment_received'),
            "amount_cash_and_online" => ProductPayment::with('invoice')->whereHas('invoice', function ($q) use ($acadamic_session_id) {
                $q->where('product_invoice_academic_session_id', $acadamic_session_id);
            })
                ->when(!empty($date), function ($query) use ($date) {
                    $query->whereDate('product_payment_created_at', $date);
                })
                ->sum('product_payment_payment_received'),
            "user_billing" => $user_data
        );
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

    public function total_old()
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
