@extends('layouts.app')

@section('content')
    <form class="w-50 m-auto" method="POST" action="{{ route('genres.update', $genre->id) }}">
        @csrf
        @method('PUT')
        <p class="fs-4">Edit Genre</p>
        <div class="mb-3">
            <div class="form-floating">
                <input class="form-control @error('name') is-invalid @enderror" placeholder="name" id="name" name="name"
                    value="{{ old('name', $genre->name) }}">
                <label for="name">Name</label>
                @error('name')
                    <div class="fs-6 text-danger fw-light">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="style" class="mb-2">Style</label>
            <select class="form-select" aria-label="Default select example" name="style">
                @php
                    $styles = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
                    
                @endphp
                @foreach ($styles as $style)
                    <option class={{ 'text-' . $style }} value="{{ $style }}" @php
                        if ($style == $genre->style) {
                            echo 'selected';
                        }
                    @endphp>{{ $style }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-outline-primary">Submit</button>
    </form>
@endsection
