@extends('layouts.app')

@section('content')
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Style</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $genre)
                <div class="modal fade" id="exampleModal{{ $genre->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Genre</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this genre?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <form method="post" action="{{ route('genres.destroy', $genre->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <tr>
                    <td><a href='{{ route('genres.show', $genre->id) }}'
                            class="text-{{ $genre->style }}">{{ $genre->name }}</a>
                    </td>
                    <td class="text-{{ $genre->style }}">{{ $genre->style }}</td>
                    <td>
                        <a href="{{ route('genres.edit', $genre->id) }}" class="inline ps-2"
                            style="text-decoration: none">
                            <i class="bi bi-pencil-fill fs-5 text-primary me-2"></i>
                        </a>
                        <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $genre->id }}"
                            class="inline" style="text-decoration: none">
                            <i class="bi bi-trash3-fill fs-5 text-secondary"></i>
                        </a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
