<?php

namespace App\Models;

use App\Models\Inventory\Product\ClassHasProduct;
use App\Models\Inventory\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentClass extends Model
{
    use HasFactory;

    public function students(): HasMany
    {
        return $this->hasMany(StudentAdmission::class, 'id', 'current_class_id');
    }

    public function classHasProduct(): HasMany
    {
        return $this->hasMany(ClassHasProduct::class, 'class_has_product_class_id', 'id');
    }
}
