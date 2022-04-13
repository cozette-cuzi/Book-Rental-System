@extends('layouts.app')

@section('content')
    <form class="w-50 m-auto" method="POST" action="{{ route('genres.store') }}">
        <p class="fs-4">Add New Genre</p>
        @csrf
        <div class="mb-3">
            <div class="form-floating">
                <input class="form-control @error('name') is-invalid @enderror" placeholder="name" id="name" name="name"
                    value="{{ old('name') }}">
                <label for="name">Name</label>
                @error('name')
                    <div class="fs-6 text-danger fw-light">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <select class="form-select" aria-label="Default select example" name="style">
                @php
                    $styles = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
                    
                @endphp
                @foreach ($styles as $style)
                    <option class={{ 'text-' . $style }} value="{{ $style }}">{{ $style }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-outline-primary">Submit</button>
    </form>
@endsection
