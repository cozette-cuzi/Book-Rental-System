@extends('layouts.app')

@section('content')
    <ol class="list-group list-group-numbered">
        <h1>{{ $data['name'] }}</h1>
        @if ($data->books->count() == 0)
            <p class="fs-4">No Books</p>
        @else
            @foreach ($data->books as $book)
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">{{ $book['name'] }}</div>
                    </div>
                    <a href='{{ route('books.show', $book['id']) }}' class=' link-primary'>Visit</a>
                </li>
            @endforeach
        @endif

    </ol>
@endsection
