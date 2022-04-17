@extends('layouts.app')

@section('content')
    <form class="w-50 m-auto" method="POST" action="{{ route('books.update', $book->id) }}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <p class="fs-4">Edit Book</p>
        <input type="hidden" name="id" value="{{ $book->id }}">
        <div class="mb-3">
            <div class="form-floating">
                <input class="form-control @error('name') is-invalid @enderror" placeholder="name" id="name" name="name"
                    value="{{ old('name', $book->name) }}">
                <label for="name">Name</label>
                @error('name')
                    <div class="fs-6 text-danger fw-light">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input class="form-control @error('authors') is-invalid @enderror" placeholder="authors" id="authors"
                    name="authors" value="{{ old('authors', $book->authors) }}">
                <label for="authors">Authors</label>
                @error('authors')
                    <div class="fs-6 text-danger fw-light">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input type="date" class="form-control  @error('released_at') is-invalid @enderror" id="date"
                    name="released_at" value="{{ old('released_at', $book->released_at) }}" />
                <label for="date">Released At</label>
                @error('released_at')
                    <div class="fs-6 text-danger fw-light">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input class="form-control  @error('pages') is-invalid @enderror" placeholder="pages" id="pages"
                    name="pages" value="{{ old('pages', $book->pages) }}">
                <label for="pages">Pages</label>
                @error('pages')
                    <div class="fs-6 text-danger fw-light">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input class="form-control  @error('isbn') is-invalid @enderror" placeholder="ISBN" id="isbn" name="isbn"
                    value="{{ old('isbn', $book->isbn) }}">
                <label for="isbn">ISBN</label>
                @error('isbn')
                    <div class="fs-6 text-danger fw-light">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <div class="form-floating">
                <input class="form-control  @error('description') is-invalid @enderror" placeholder="Description"
                    id="description" name="description" value="{{ old('description', $book->description) }}"
                    style="height: 100px">
                <label for="description">Description</label>
                @error('description')
                    <div class="fs-6 text-danger fw-light">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <div class="dropdown">
                <label for="book-genres inline">Book Genres</label>
                <select class="form-select text-primary w-50 inline text-start dropdown-toggle" aria-label="Book Genres"
                    type="button" id="book-genres" data-bs-toggle="dropdown" aria-expanded="false">
                </select>

                <div class="dropdown-menu  px-3">
                    @foreach ($genres as $genre)
                        <div class="form-check">
                            <input @php
                                if (in_array($genre->id, $book->genres->pluck('id')->toArray())) {
                                    echo 'checked=checked';
                                }
                            @endphp class="form-check-input" type="checkbox" name="genres[]"
                                value="{{ $genre->id }}" id={{ 'flexCheckDefault' . $genre->id }}>
                            <label class="form-check-label" for={{ 'flexCheckDefault' . $genre->id }}>
                                {{ $genre->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mb-3">
            <div class="form-floating">
                <input class="form-control  @error('in_stock') is-invalid @enderror" placeholder="in_stock" id="in_stock"
                    name="in_stock" value="{{ old('in_stock', $book->in_stock) }}">
                <label for="in_stock">In Stock</label>
                @error('in_stock')
                    <div class="fs-6 text-danger fw-light">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="cover_image" class="pb-1">Cover Image</label>
            <input type="file" class="form-control  @error('cover_image') is-invalid @enderror" placeholder="cover image"
                id="cover_image" name="cover_image" value="{{ old('cover_image') }}">
            @error('cover_image')
                <div class="fs-6 text-danger fw-light">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-outline-primary">Submit</button>
    </form>
@endsection
