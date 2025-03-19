<?php

namespace App\Models\StoreManagementSystem;

use App\Models\Inventory\Product\ProductInvoice;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPayment extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_payment_id';

    protected $fillable = [
        'product_payment_product_invoice_id',
        'product_payment_total_due',
        'product_payment_payment_received',
        'product_payment_remaining_due',
        'product_payment_method',
        'product_payment_remarks',
        'product_payment_created_by',
        'product_payment_updated_by',
    ];

    const CREATED_AT = 'product_payment_created_at';
    const UPDATED_AT = 'product_payment_updated_at';

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(ProductInvoice::class, 'product_invoice_id', 'product_payment_product_invoice_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'product_payment_created_by', 'id');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'product_payment_updated_by', 'id');
    }
}
