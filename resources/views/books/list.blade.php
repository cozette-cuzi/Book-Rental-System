@extends('layouts.app')

@section('content')
    <ol class="list-group list-group-numbered">
        @foreach ($data as $book)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">{{ $book->name }}</div>
                </div>
                <a href='{{ route('books.show', $book->id) }}' class=' link-primary'>Visit</a>
            </li>
        @endforeach

    </ol>
@endsection
