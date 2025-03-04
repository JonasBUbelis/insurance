@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Owners List</h1>

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('create') }}" class="btn btn-primary">Add New Owner</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @php $loopIndex = 1; @endphp
                @foreach($owners as $owner)
                    <tr>
                        <td>{{ $loopIndex }}</td>
                        <td>{{ $owner->name }}</td>
                        <td>{{ $owner->surname }}</td>
                        <td>{{ $owner->phone }}</td>
                        <td>{{ $owner->email }}</td>
                        <td>{{ $owner->address }}</td>
                        <td>
                            <a href="{{ route('edit', $owner) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                        <td>
                            <form method="post" action="{{ route('destroy', $owner) }}" onsubmit="return confirm('Are you sure you want to delete this owner?');">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @php $loopIndex++; @endphp
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
