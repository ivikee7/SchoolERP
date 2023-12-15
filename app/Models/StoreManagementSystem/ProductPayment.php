<?php

namespace App\Models\StoreManagementSystem;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPayment extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'product_payment_id';

    protected $fillable = [
        'product_payment_product_invoice_id',
        'product_payment_total_due',
        'product_payment_payment_received',
        'product_payment_remaining_due',
        'product_payment_created_by',
        'product_payment_updated_by',
    ];

    const CREATED_AT = 'product_payment_created_at';
    const UPDATED_AT = 'product_payment_updated_at';
}
