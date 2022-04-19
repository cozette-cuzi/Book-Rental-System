@extends('layouts.app')

@section('content')
    <div class="row">
        <p class="fs-4">
            Search Results:
        </p>
        @if ($data->count() == 0)
            <p class="fs-5">No Matching Results!</p>
        @endif
        @foreach ($data as $key => $book)
            @php
                $styles = ['secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark', 'primary'];
            @endphp
            <div class="col-4">
                <div class="card m-2" style="max-width: 18rem;">
                    <div class="card-body border-5 border-start border-{{ $styles[$key % 8] }}">
                        <a href='{{ route('books.show', $book->id) }}'
                            class=' link-{{ $styles[$key % 8] }} fs-5'>{{ $book->name }}</a>
                        <p class="fs5">By {{ $book->authors }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
