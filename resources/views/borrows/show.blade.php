@extends('layouts.app')

@section('content')
    <ul class="list-group list-group-flush">
        <p class="fs-3 fw-bold">
            Rental Details
        </p>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Book:</span>
            <a href="{{ route('books.show', $data['book_id']) }}">
                {{ $data->book->name }} </a>
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Authors:</span> {{ $data->book->authors }}
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Date: </span>
            {{ $data->book->released_at }}
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Reader: </span>
            {{ $data->reader->name }}
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Date of Rental Request:</span>
            {{ $data->created_at }}
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Status:</span>
            {{ $data->status }}
        </li>
        @if ($data->status != 'PENDING')
            <li class="list-group-item">
                <span class="fw-bold pe-2">Date of Procession:</span>
                {{ $data->request_processed_at }}
            </li>

            <li class="list-group-item">
                <span class="fw-bold pe-2">Librarian:</span>
                {{ $data->requestManagedBy->name }}
            </li>
        @elseif($data->status == 'RETURNED')
            <li class="list-group-item">
                <span class="fw-bold pe-2">Date of Return:</span>
                {{ $data->returned_at }}
            </li>
            <li class="list-group-item">
                <span class="fw-bold pe-2">Date of Return:</span>
                {{ $data->returnManagedBy->name }}
            </li>
        @endif

        @if ($data->isLate)
            <li class="list-group-item">
                <span class="fw-bold pe-2 fs-3 text-danger">The rental is late!</span>
            </li>
        @endif
    </ul>
@endsection
