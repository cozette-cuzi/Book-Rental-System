@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <p class="fs-1 fw-bold">{{ $data->name }}</p>
        </div>
        <div class="col">
            <div class="float-end row">
                <div class="col">
                    @if (Auth::user() && Auth::user()->is_librarian)
                        <a href="{{ route('books.edit', $data->id) }}" class="btn btn-outline-warning px-4">
                            Edit
                        </a>
                    @endif
                </div>
                <div class="col">
                    @if (Auth::user() && ($borrowed = Auth::user()->borrowed($data->id)))
                        <div>
                            <p class="fs-5  text-success text-end">You Have Ongoing Request</p>
                        </div>
                    @elseif(Auth::user())
                        <form method="POST" action="{{ route('books.borrow', $data->id) }}">
                            @csrf
                            <button class="btn btn-outline-success px-4 float-end" type="submit">
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
