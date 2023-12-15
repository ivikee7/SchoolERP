<?php

namespace App\Models\Inventory\Product;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'product_category_id';

    protected $fillable = [
        'product_category_name'
    ];

    const CREATED_AT = 'product_category_created_at';
    const UPDATED_AT = 'product_category_updated_at';
}
