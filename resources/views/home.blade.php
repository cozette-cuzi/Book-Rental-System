@extends('layouts.app')

@section('content')
    <div class="h-100 pb-5 row">
        <div class="col-9">
            <h1 class="display-5 fw-bold text-primary">Enjoy The Freedom of Reading</h1>
            <p class="col-md-9 fs-4">We offer smoth, free, easy books rental system. Just rent a book, and enjoy our free
                service.
                We offer smoth, free, easy books rental system. Just rent a book, and enjoy our free service.<br>
                To try out our service start by searching your favorite book down here.
                <br>
            </p>

            <form action="{{ route('search') }}" class="d-flex w-50">
                @csrf
                @method('POST')
                <input class="form-control me-2" type="search" placeholder="Search for Books" aria-label="Search"
                    name="search">
                <button class="btn btn-outline-primary " type="submit">Search</button>
            </form>
        </div>
        <div class="col-3">
            <div class="row my-1">
                <div class="col-12">

                    <div class="card mb-3" style="max-width: 18rem;">
                        <div class="card-body  border-5 border-start border-danger">
                            <h5 class="card-text">{{ $data['NOUsers'] }} users</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card mb-3" style="max-width: 18rem;">
                        <div class="card-body border-5 border-start border-primary">
                            <h5 class="card-text">{{ $data['NOGenres'] }} Genres</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card  mb-3" style="max-width: 18rem;">
                        <div class="card-body border-5 border-start border-secondary">
                            <h5 class="card-text">{{ $data['NOBooks'] }} Books</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card mb-3 " style="max-width: 18rem;">
                        <div class="card-body border-5 border-start border-warning">
                            <h5 class="card-text">{{ $data['NOActiveBookRentals'] }} Active Rentals</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>
    <div class="row my-5">
        <h1 class="fs-4 text-primary">Books By Genres</h1>
        @foreach ($genres as $key => $genre)
            <div class="col-4">
                <div class="card m-2" style="max-width: 18rem;">
                    <div class="card-body border-5 border-start border-{{ $genre['style'] }}">
                        <a href='{{ route('genres.show', $genre->id) }}'
                            class=' link-{{ $genre->style }} fs-5'>{{ $genre->name }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
