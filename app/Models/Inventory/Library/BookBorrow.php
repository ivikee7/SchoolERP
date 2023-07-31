<?php

namespace App\Models\Inventory\Library;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookBorrow extends Model
{
    use HasFactory;

    protected $fillable = ([
        'borrow_book_id',
        'borrow_user_id',
        'borrow_issued_by',
        'borrow_issued_at',
        'borrow_received_by',
        'borrow_received_at',
        'borrow_due_date',
        'borrow_lost_at',
    ]);
}
