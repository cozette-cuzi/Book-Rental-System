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

    public function index()
    {
        return \view('genres.list', ['data' => Genre::all()]);
    }

    public function create()
    {
        return \view('genres.create');
    }

    public function edit($id)
    {
        $genre = Genre::find($id);
        return \view('genres.edit', ['genre' => $genre]);
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
        return \view('home', $this->homePageRepository->getData());
    }

    public function update(Genre $genre, GenreRequest $request)
    {
        $data = $request->validated();
        $genre->update($data);
        return \view('genres.list', ['data' => Genre::all()]);
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('genres.index')->with('data', Genre::all());
    }
}
