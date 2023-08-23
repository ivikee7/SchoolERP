<?php

namespace App\Models\Inventory\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_category_id';
}
