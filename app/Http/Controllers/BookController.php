<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware('is.librarian')->only('create', 'store');
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

    public function store(BookRequest $request)
    {
        $data = $request->validated();
        $genres = $data['genres'];
        unset($data['genres']);
        $book = Book::create($data);
        $genres = $book->genres()->attach($genres);
        return \view('books.show', ['data' => Book::find($book->id)]);
    }

    public function create()
    {
        $genres = Genre::all();
        return \view('books.create', ['genres' => $genres]);
    }
}
