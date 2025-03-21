<?php

namespace App\Models\Inventory\Product;

use App\Models\StoreManagementSystem\ProductPayment;
use App\Models\StudentClass;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductInvoice extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_invoice_id';

    protected $fillable = [
        'product_invoice_buyer_id',
        'product_invoice_academic_session_id',
        'product_invoice_class_id',
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

    public function items(): HasMany
    {
        return $this->hasMany(ProductInvoiceItem::class, 'product_invoice_item_product_invoice_id', 'product_invoice_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(ProductPayment::class, 'product_payment_product_invoice_id', 'product_invoice_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'product_invoice_buyer_id', 'id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'product_invoice_created_by', 'id');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'product_invoice_updated_by', 'id');
    }

    public function discountBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'product_invoice_discount_by', 'id');
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(StudentClass::class, 'product_invoice_class_id', 'id');
    }
}
