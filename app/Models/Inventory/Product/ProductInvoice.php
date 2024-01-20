<?php

namespace App\Models\Inventory\Product;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInvoice extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'product_invoice_id';

    protected $fillable = [
        'product_invoice_buyer_id',
        'product_invoice_subtotal',
        'product_invoice_discount',
        'product_invoice_gross_total',
        'product_invoice_due',
        'product_invoice_due_date',
        'product_invoice_created_by',
        'product_invoice_updated_by',
    ];

    const CREATED_AT = 'product_invoice_created_at';
    const UPDATED_AT = 'product_invoice_updated_at';
}
