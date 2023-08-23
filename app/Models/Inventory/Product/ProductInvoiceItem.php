<?php

namespace App\Models\Inventory\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInvoiceItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_invoice_item_id';

}
