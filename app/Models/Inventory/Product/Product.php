<?php

namespace App\Models\Inventory\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_name',
        'product_description',
        'product_category_id',
        'created_by',
        'updated_by',
    ];
}
