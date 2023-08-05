<?php

namespace App\Models\Inventory\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassHasProduct extends Model
{
    use HasFactory;

    protected $primaryKey = 'class_has_product_id';
}
