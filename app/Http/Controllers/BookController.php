<?php

namespace App\Http\Controllers;

use App\Http\Repositories\HomePageRepository;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{

    private HomePageRepository $homePageRepository;

    public function __construct(HomePageRepository $repository)
    {
        $this->middleware('is.librarian')->only('create', 'store', 'edit', 'update');
        $this->middleware('auth')->only('borrow');
        $this->homePageRepository = $repository;
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
        return redirect()->route('home', $this->homePageRepository->getData());
    }

    public function update(Book $book, BookRequest $request)
    {
        $data = $request->validated();
        $genres = $data['genres'];
        unset($data['genres']);
        $book = Book::create($data);
        $genres = $book->genres()->sync($genres);
        return redirect()->route('books.show', ['book' => $book->id]);
    }

    public function create()
    {
        $genres = Genre::all();
        return \view('books.create', ['genres' => $genres]);
    }

    public function edit($id)
    {
        $book = Book::whereId($id)->with('genres')->first();
        $genres = Genre::all();
        return \view('books.edit', ['genres' => $genres, 'book' => $book]);
    }
}
