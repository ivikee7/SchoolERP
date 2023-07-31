<?php

namespace App\Models\Inventory\Library;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
    use HasFactory;

    protected $fillable = ([
        'author_name',
        'author_note',
    ]);
}
