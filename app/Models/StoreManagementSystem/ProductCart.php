<?php

namespace App\Models\StoreManagementSystem;

use App\Models\Inventory\Product\ClassHasProduct;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductCart extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_cart_id';

    protected $fillable = [
        'product_cart_buyer_id',
        'product_cart_product_id',
        'product_cart_class_has_product_id',
        'product_cart_quantity',
    ];

    const CREATED_AT = 'product_cart_created_at';
    const UPDATED_AT = 'product_cart_updated_at';

    public function classHasProduct(): BelongsTo
    {
        return $this->belongsTo(ClassHasProduct::class, 'product_cart_class_has_product_id', 'class_has_product_id');
    }
}
