@extends('layouts.app')

@section('content')
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-pending-tab" data-bs-toggle="tab" data-bs-target="#nav-pending"
                type="button" role="tab" aria-controls="nav-pending" aria-selected="true">Pending</button>

            <button class="nav-link" id="nav-accepted-tab" data-bs-toggle="tab" data-bs-target="#nav-accepted"
                type="button" role="tab" aria-controls="nav-accepted" aria-selected="false">Accepted</button>

            <button class="nav-link" id="nav-late-tab" data-bs-toggle="tab" data-bs-target="#nav-late" type="button"
                role="tab" aria-controls="nav-late" aria-selected="false">Late</button>

            <button class="nav-link" id="nav-rejected-tab" data-bs-toggle="tab" data-bs-target="#nav-rejected"
                type="button" role="tab" aria-controls="nav-rejected" aria-selected="false">Rejected</button>

            <button class="nav-link" id="nav-returned-tab" data-bs-toggle="tab" data-bs-target="#nav-returned"
                type="button" role="tab" aria-controls="nav-rejected" aria-selected="false">Returned</button>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active mt-3" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">
            @if ($data['pending']->count() == 0)
                <p class="fs-4">No Rentals</p>
            @else
                <p class="fs-4">
                    Pending Rentals:
                </p>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Book Title</th>
                            <th scope="col">Authors</th>
                            <th scope="col">Date of Rental</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['pending'] as $borrow)
                            <tr>
                                <th scope="row">
                                    <a href="{{ route('borrows.show', $borrow->id) }}" type="button">
                                        {{ $borrow->id }}
                                    </a>
                                </th>
                                <td>{{ $borrow->book->name }}</td>
                                <td>{{ $borrow->book->authors }}</td>
                                <td>{{ $borrow->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="tab-pane fade mt-3" id="nav-accepted" role="tabpanel" aria-labelledby="nav-accepted-tab">
            @if ($data['accepted']->count() == 0)
                <p class="fs-4">No Rentals</p>
            @else
                <p class="fs-4">
                    Accepted Rentals:
                </p>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Book Title</th>
                            <th scope="col">Authors</th>
                            <th scope="col">Date of Rental</th>
                            <th scope="col">Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['accepted'] as $borrow)
                            <tr>
                                <th scope="row">
                                    <a href="{{ route('borrows.show', $borrow->id) }}" type="button">
                                        {{ $borrow->id }}
                                    </a>
                                </th>
                                <td>{{ $borrow->book->name }}</td>
                                <td>{{ $borrow->book->authors }}</td>
                                <td>{{ $borrow->created_at }}</td>
                                <td>{{ $borrow->deadline }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>


        <div class="tab-pane fade mt-3" id="nav-late" role="tabpanel" aria-labelledby="nav-late-tab">
            @if ($data['late']->count() == 0)
                <p class="fs-4">No Rentals</p>
            @else
                <p class="fs-4">
                    Late Rentals:
                </p>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Book Title</th>
                            <th scope="col">Authors</th>
                            <th scope="col">Date of Rental</th>
                            <th scope="col">Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['late'] as $borrow)
                            <tr>
                                <th scope="row">
                                    <a href="{{ route('borrows.show', $borrow->id) }}" type="button">
                                        {{ $borrow->id }}
                                    </a>
                                </th>
                                <td>{{ $borrow->book->name }}</td>
                                <td>{{ $borrow->book->authors }}</td>
                                <td>{{ $borrow->created_at }}</td>
                                <td>{{ $borrow->deadline }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="tab-pane fade mt-3" id="nav-rejected" role="tabpanel" aria-labelledby="nav-late-rejected">


            @if ($data['rejected']->count() == 0)
                <p class="fs-4">No Rentals</p>
            @else
                <p class="fs-4">
                    Rejected Rentals:
                </p>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Book Title</th>
                            <th scope="col">Authors</th>
                            <th scope="col">Date of Rental</th>
                            <th scope="col">Deadline</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data['rejected'] as $borrow)
                            <tr>
                                <th scope="row">
                                    <a href="{{ route('borrows.show', $borrow->id) }}" type="button">
                                        {{ $borrow->id }}
                                    </a>
                                </th>
                                <td>{{ $borrow->book->name }}</td>
                                <td>{{ $borrow->book->authors }}</td>
                                <td>{{ $borrow->created_at }}</td>
                                <td>{{ $borrow->deadline }}</td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            @endif
        </div>

        <div class="tab-pane fade mt-3" id="nav-returned" role="tabpanel" aria-labelledby="nav-returned-tab">
            @if ($data['returned']->count() == 0)
                <p class="fs-4">No Rentals</p>
            @else
                <p class="fs-4">
                    Returned Rentals:
                </p>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Book Title</th>
                            <th scope="col">Authors</th>
                            <th scope="col">Date of Rental</th>
                            <th scope="col">Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['returned'] as $borrow)
                            <tr>
                                <th scope="row">
                                    <a href="{{ route('borrows.show', $borrow->id) }}" type="button">
                                        {{ $borrow->id }}
                                    </a>
                                </th>
                                <td>{{ $borrow->book->name }}</td>
                                <td>{{ $borrow->book->authors }}</td>
                                <td>{{ $borrow->created_at }}</td>
                                <td>{{ $borrow->deadline }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
