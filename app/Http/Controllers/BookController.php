<?php

namespace App\Http\Controllers;

use App\Http\Repositories\HomePageRepository;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{

    private HomePageRepository $homePageRepository;

    public function __construct(HomePageRepository $repository)
    {
        $this->middleware('is.librarian')->only('create', 'store', 'edit', 'update', 'destroy');
        $this->middleware('auth')->only('borrow');
        $this->homePageRepository = $repository;
    }

    public function show($id)
    {
        $data = Book::findOrFail($id);
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

    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();
        $genres = null;
        if (isset($data['genres'])) {
            $genres = $data['genres'];
            unset($data['genres']);
        }

        if (isset($data['cover_image'])) {
            $file = $data['cover_image'];
            $path =  Storage::disk('public')->put('cover_images', $file);
            $data['cover_image'] = \explode('cover_images/', $path)[1];
        }
        $book = Book::create($data);
        $genres = $book->genres()->attach($genres);
        return \redirect()->route('home');
    }

    public function update(Book $book, UpdateBookRequest $request)
    {
        $data = $request->validated();
        $genres = null;
        if (isset($data['genres'])) {
            $genres = $data['genres'];
            unset($data['genres']);
        }

        if (isset($data['cover_image'])) {
            $file = $data['cover_image'];
            $path =  Storage::disk('public')->put('cover_images', $file);
            $data['cover_image'] = \explode('cover_images/', $path)[1];
        }

        $book->update($data);
        $genres = $book->genres()->sync($genres);
        return \redirect()->route('books.show', $book->id);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return \redirect()->route('home');
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
