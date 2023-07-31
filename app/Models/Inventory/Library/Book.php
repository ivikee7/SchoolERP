<?php

namespace App\Models\Inventory\Library;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $primaryKey = 'id';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'book_title',
        'book_edition',
        'author_id',
        'book_author',
        'publisher_id',
        'book_published_at',
        'book_price',
        'book_pages',
        'book_isbn',
        'category_id',
        'location_id',
        'language_id',
        'class_id',
        'subject_id',
        'supplier_id',
        'purchased_at', // Tempreary
        'accession_number', // Tempreary
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];
}
