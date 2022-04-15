@extends('layouts.app')

@section('content')
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <span class="fw-bold pe-2">Username:</span> {{ Auth::user()->name }}
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Email:</span> {{ Auth::user()->email }}
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Role: </span>
            {{ Auth::user()->is_librarian ? 'Librarian' : 'Reader' }}
        </li>
    </ul>
@endsection
