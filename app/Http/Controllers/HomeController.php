<?php

namespace App\Http\Controllers;

use App\Http\Repositories\HomePageRepository;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private HomePageRepository $repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(HomePageRepository $repository)
    {
        // $this->middleware('auth');
        $this->repository = $repository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', $this->repository->getData());
    }

    public function profile()
    {
        return view('profile');
    }

    public function search(Request $request)
    {
        $books = Book::where('authors', 'like', "%{$request->input('search')}%")
            ->orWhere('name', 'like', "%{$request->input('search')}%")->get();
        return \view('books.list', ['data' => $books]);
    }
}
