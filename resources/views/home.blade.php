@extends('layouts.app')

@section('content')
<div class="h-100 pb-5">
    <h1 class="display-5 fw-bold text-primary">Enjoy The Freedom of Reading</h1>
    <p class="col-md-8 fs-4">We offer smoth, free, easy books rental system. Just rent a book, and enjoy our free service.
        We offer smoth, free, easy books rental system. Just rent a book, and enjoy our free service.</p>
    <a class="btn btn-primary px-4 me-2" href="{{ route('register') }}" type="button">
        Sign Up
    </a>
    <a class="btn btn-outline-primary px-4" href="{{ route('login') }}" type="button">
        Log In
    </a>
</div>

<hr>
<div class="row my-5">
    <h1>We Have</h1>
    <div class="col">
        <div class="card mb-3" style="max-width: 18rem;">
            <div class="card-header fw-bold">Number of users</div>
            <div class="card-body">
                <h5 class="card-text">{{$data['NOUsers']}} user</h5>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card mb-3" style="max-width: 18rem;">
            <div class="card-header">Number of Genres</div>
            <div class="card-body">
                <h5 class="card-text">{{$data['NOGenres']}} Genre</h5>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card  mb-3" style="max-width: 18rem;">
            <div class="card-header">Number of Books</div>
            <div class="card-body">
                <h5 class="card-text">{{$data['NOBooks']}} Books</h5>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card mb-3 " style="max-width: 18rem;">
            <div class="card-header">Number of active book rentals</div>
            <div class="card-body">
                <h5 class="card-text">{{$data['NOActiveBookRentals']}} Active Books Rentals</h5>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row my-5">
    <ol class="list-group list-group-numbered">
        <h1>Our Genres</h1>
        @foreach ($genres as $key => $genre)
        <li class="list-group-item d-flex justify-content-between align-items-start">

            <div class="ms-2 me-auto">
                <div class="fw-bold link-{{ $genre['style'] }}">{{$genre['name'] }}</div>
            </div>
            <a href='{{ route('genres.show', $genre['id']) }}' class=' link-{{ $genre['style'] }}'>Visit</a>
        </li>
        @endforeach
    </ol>
</div>

@endsection