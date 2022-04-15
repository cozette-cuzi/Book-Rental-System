@extends('layouts.app')

@section('content')
    <h1 class="text-{{ $data->style }}">{{ $data['name'] }}</h1>
    @if ($data->books->count() == 0)
        <p class="fs-4">No Books</p>
    @else
        <div class="row">

            @foreach ($data->books as $key => $book)
                @php
                    $styles = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
                @endphp
                <div class="col-4">
                    <div class="card m-2" style="max-width: 18rem;">
                        <div class="card-body border-5 border-start border-{{ $styles[$key % 8] }}">
                            <a href='{{ route('books.show', $book['id']) }}'
                                class=' link-{{ $styles[$key % 8] }} fs-5'>{{ $book['name'] }}</a>
                        </div>
                    </div>

                    {{-- <li class="list-group-item d-flex justify-content-between align-items-start bg-body w-50">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">
                                <a href='{{ route('books.show', $book['id']) }}'
                                    class=' link-primary'>{{ $book['name'] }}</a>
                            </div>
                        </div>
                        
                    </li> --}}
                </div>
            @endforeach
        </div>
    @endif


@endsection
