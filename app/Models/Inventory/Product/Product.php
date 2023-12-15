<?php

namespace App\Models\Inventory\Product;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_name',
        'product_description',
        'product_product_category_id',
        'product_created_by',
        'product_updated_by',
    ];

    const CREATED_AT = 'product_created_at';
    const UPDATED_AT = 'product_updated_at';
}
