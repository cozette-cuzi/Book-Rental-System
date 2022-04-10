<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{

    public function __construct()
    {
        // $this->middleware('is.librarian')->only();
        $this->middleware('auth')->except('show');
    }
    public function show($id)
    {
        $data = Book::whereId($id)->with('genres')->first();

        return \view('books.show', ['data' => $data]);
    }

    public function borrow($id)
    {
        if (Auth::user()->borrowed($id)) {
            return \abort(403, "You already have ongoing request");
        }
        $book = Book::find($id);
        $borrow = [
            'reader_id' => Auth::id(),
            'status' => 'PENDING'
        ];
        $book->borrows()->create($borrow);
        return redirect()->back()->withInput();
    }
}
