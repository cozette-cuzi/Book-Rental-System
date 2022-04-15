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
            <span class="fw-bold pe-2">Reader:</span>
            {{ $data->reader->name }}
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
        <form method="POST" action="{{ route('borrows.update', $data->id) }}">
            @csrf
            @method('PUT')

            <li class="list-group-item">
                <div class="row">
                    <div class="col-8">
                        <span class="fw-bold pe-2">Status:</span>
                        {{ $data->status }}
                    </div>
                    <div class="col-4 float-end">
                        <select class="form-select w-75 float-end  @error('deadline') is-invalid @enderror"
                            aria-label="Default select example" name="status">
                            @php
                                $statuses = ['PENDING', 'ACCEPTED', 'REJECTED', 'RETURNED'];
                                
                            @endphp
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}" @php
                                    if ($status == $data->status) {
                                        echo 'selected';
                                    }
                                @endphp>{{ $status }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <div class="fs-6 text-danger fw-light float-end">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror

                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-8">
                        <span class="fw-bold pe-2">Deadline:</span>
                        {{ $data->deadline }}
                    </div>
                    <div class="col-4 float-end">
                        <input type="date" class="form-control w-75 float-end  @error('deadline') is-invalid @enderror"
                            id="deadline" name="deadline" value="{{ old('deadline', $data->deadline) }}" />
                        @error('deadline')
                            <div class="fs-6 text-danger fw-light float-end">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    </div>
                </div>
            </li>
            <input type="hidden" name="id" value="{{ $data->id }}">
            <button type="submit" class="mx-3 mt-2 px-4 float-end btn btn-outline-secondary">Save</button>
        </form>
        @if ($data->isLate)
            <li class="list-group-item">
                <span class="fw-bold pe-2 fs-3 text-danger">The rental is late!</span>
            </li>
        @endif
    </ul>
@endsection
