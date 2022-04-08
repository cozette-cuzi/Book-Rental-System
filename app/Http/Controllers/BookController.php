<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function show($id)
    {
        $data = Book::whereId($id)->with('genres')->first();
        
        return \view('books.show', ['data' => $data]);
    }
}
