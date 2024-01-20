<?php

namespace App\Models\Inventory\Product;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassHasProduct extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'class_has_product_id';

    protected $fillable = [
        'class_has_product_class_id',
        'class_has_product_academic_session_id',
        'class_has_product_product_id',
        'class_has_product_price',
        'class_has_product_created_by',
        'class_has_product_updated_by'
    ];

    const CREATED_AT = 'class_has_product_created_at';
    const UPDATED_AT = 'class_has_product_updated_at';
}
