<?php

namespace App\Http\Controllers;

use App\Http\Repositories\HomePageRepository;
use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{


    private HomePageRepository $homePageRepository;

    public function __construct(HomePageRepository $repository)
    {
        $this->middleware('is.librarian')->except('show');
        $this->homePageRepository = $repository;
    }



    public function create()
    {
        return \view('genres.create');
    }

    public function show($id)
    {
        $data = Genre::findOrFail($id);
        return \view('genres.show', ['data' => $data]);
    }

    public function store(GenreRequest $request)
    {
        $data = $request->validated();
        Genre::create($data);
        return redirect()->route('home', $this->homePageRepository->getData());
    }
}
