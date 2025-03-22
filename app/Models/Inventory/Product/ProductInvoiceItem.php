<?php

namespace App\Models\Inventory\Product;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductInvoiceItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_invoice_item_id';

    protected $fillable = [
        'product_invoice_item_product_invoice_id',
        'product_invoice_item_class_has_product_id',
        'product_invoice_item_price',
        'product_invoice_item_quantity',
        'product_invoice_item_created_by',
        'product_invoice_item_updated_by',
    ];

    const CREATED_AT = 'product_invoice_item_created_at';
    const UPDATED_AT = 'product_invoice_item_updated_at';

    public function classHasProduct(): BelongsTo
    {
        return $this->belongsTo(ClassHasProduct::class, 'product_invoice_item_class_has_product_id', 'class_has_product_id');
    }

    public function invoice():BelongsTo{
        return $this->belongsTo(ProductInvoice::class, 'product_invoice_item_product_invoice_id', 'product_invoice_id');
    }
}
