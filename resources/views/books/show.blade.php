@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col col-8">
            <p class="fs-1 fw-bold inline">
                {{ $data->name }}
                {{-- @if (Auth::user() && Auth::user()->is_librarian)
                    <a href="{{ route('books.edit', $data->id) }}" class="inline-block ps-2" style="text-decoration: none">
                        <i class="bi bi-pencil-fill fs-5 text-primary"></i>
                    </a>
                    <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="inline-block"
                        style="text-decoration: none">
                        <i class="bi bi-trash3-fill fs-5 text-danger"></i>
                    </a>
                @endif
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Book</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this book?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <form method="post" action="{{ route('books.destroy', $data->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}
            </p>

        </div>
        <div class="col">

            <div class="float-end row">
                <div class="col">
                    @if (Auth::user() && Auth::user()->is_librarian)
                        <div class="pt-3">
                            <a href="{{ route('books.edit', $data->id) }}" class="inline ps-2"
                                style="text-decoration: none">
                                <i class="bi bi-pencil-fill fs-5 text-primary me-2"></i>
                            </a>
                            <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="inline"
                                style="text-decoration: none">
                                <i class="bi bi-trash3-fill fs-5 text-secondary"></i>
                            </a>
                        </div>
                    @endif
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Book</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this book?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form method="post" action="{{ route('books.destroy', $data->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">

                    @if (Auth::user() && ($borrowed = Auth::user()->borrowed($data->id)))
                        <div>
                            <p class="fs-5  text-success text-end" style="margin-top: 15px">Requested!</p>
                        </div>
                    @elseif(Auth::user())
                        <form method="POST" action="{{ route('books.borrow', $data->id) }}">
                            @csrf
                            <button class="btn btn-outline-success px-4 float-end" type="submit" style="margin-top: 15px">
                                Borrow
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item"></li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Authors:</span> {{ $data->authors }}
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Genres:</span>
            @foreach ($data->genres as $genre)
                <span class="chip border text-{{ $genre->style }}">{{ $genre->name }}</span>
            @endforeach
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Date of Publish: </span>
            {{ $data->released_at }}
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Number of Pages:</span>
            {{ $data->pages }}
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Language:</span>
            {{ $data->language_code }}
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">ISBN:</span>
            {{ $data->isbn }}
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Number of Prints in stock:</span>
            {{ $data->in_stock }}
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Number of Available Books:</span>
            {{ $data->available }}
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Description:</span>
            {{ $data->description }}
        </li>
    </ul>
@endsection
