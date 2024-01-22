<?php

namespace App\Models\StoreManagementSystem;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_cart_id';

    protected $fillable = [
        'product_cart_buyer_id',
        'product_cart_product_id',
        'product_cart_quantity',
    ];

    const CREATED_AT = 'product_cart_created_at';
    const UPDATED_AT = 'product_cart_updated_at';
}
