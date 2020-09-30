<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store(Request $request)
    {
        $book = new Book();
        $book->book_title = $request->book_title;
        $book->save();
    }
}
