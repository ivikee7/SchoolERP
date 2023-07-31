<?php

namespace App\Models\Inventory\Library;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookSupplier extends Model
{
    use HasFactory;

    protected $fillable = ([
        'supplier_name',
        'supplier_address',
        'supplier_contact',
        'supplier_contact2',
        'supplier_email',
        'supplier_status',
    ]);
}
