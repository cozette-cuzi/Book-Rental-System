@extends('layouts.app')

@section('content')
    <h1>{{ $data['name'] }}</h1>
    <ul class="list-group list-group-flush">
        <li class="list-group-item"></li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Authors:</span> {{ $data['authors'] }}
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Genres:</span>
            @foreach ($data->genres as $genre)
                <span class="chip border text-{{ $genre['style'] }}">{{ $genre['name'] }}</span>
            @endforeach
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Date of Publish: </span>
            {{ $data['released_at'] }}
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Number of Pages:</span>
            {{ $data['pages'] }}
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Language:</span>
            {{ $data['language_code'] }}
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">ISBN:</span>
            {{ $data['isbn'] }}
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Number of Prints in stock:</span>
            {{ $data['in_stock'] }}
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Number of Available Books:</span>
            {{ $data->available }}
        </li>
        <li class="list-group-item">
            <span class="fw-bold pe-2">Description:</span>
            {{ $data['description'] }}
        </li>
    </ul>
@endsection
