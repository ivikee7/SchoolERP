<?php

namespace App\Models\Inventory\Library;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_name',
        'location_note',
    ];
}
