<?php

namespace App\Http\Repositories;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Genre;
use App\Models\User;

class HomePageRepository
{

    public function getData()
    {
        return ['data' => $this->__statistics(), 'genres' => $this->__genres()];
    }

    private function __statistics()
    {
        $data['NOUsers'] = User::all()->count();
        $data['NOGenres'] = Genre::all()->count();
        $data['NOBooks'] = Book::all()->count();
        $data['NOActiveBookRentals'] = Borrow::all()->where('status', '=', 'ACCEPTED')->count();
        return $data;
    }

    private function __genres()
    {
        return $genres = Genre::all();
    }
}
