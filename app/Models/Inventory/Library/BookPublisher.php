<?php

namespace App\Models\Inventory\Library;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookPublisher extends Model
{
    use HasFactory;

    protected $fillable = ([
        'publisher_name',
        'publisher_email',
        'publisher_location',
        'publisher_contact',
        'publisher_contact2',
    ]);
}
