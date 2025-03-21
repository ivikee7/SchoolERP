<?php

namespace App\Models\Inventory\Product;

use App\Models\AcademicSession;
use App\Models\StoreManagementSystem\ProductCart;
use App\Models\StudentClass;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassHasProduct extends Model
{
    use HasFactory;

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

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'class_has_product_product_id', 'product_id');
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(StudentClass::class, 'class_has_product_class_id', 'id');
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class, 'class_has_product_academic_session_id', 'id');
    }

    public function cart(): HasMany
    {
        return $this->hasMany(ProductCart::class ,'product_cart_class_has_product_id', 'class_has_product_id');
    }
}
