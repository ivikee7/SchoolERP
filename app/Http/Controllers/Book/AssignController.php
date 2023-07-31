<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StudentClass;

class AssignController extends Controller
{
    public function render()
    {
        return view('book.assign.index')->render();
    }

    public function getClasses()
    {
        return response()->json(StudentClass::all());
    }

    public function getBooks()
    {
        $data = Product::all();

        return response()->json($data);
    }

    public function classHasProducts($id)
    {
        $data = Product::leftJoin('class_has_products as chp', 'products.id', 'chp.product_id')
            ->where('chp.class_id', 1)
            ->get();

        return response()->json($data);
    }
}
