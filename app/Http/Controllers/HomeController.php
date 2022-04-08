<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = $this->__statistics();
        $genres = Genre::all();
        return view('home', ['data' => $data, 'genres' => $genres]);
    }

    private function __statistics()
    {
        $data['NOUsers'] = User::all()->count();
        $data['NOGenres'] = Genre::all()->count();
        $data['NOBooks'] = Book::all()->count();
        $data['NOActiveBookRentals'] = Borrow::all()->where('status', '=', 'ACCEPTED')->count();
        return $data;
    }
}
