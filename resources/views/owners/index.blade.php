@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Owners List</h1>
        @if(auth()->check() && auth()->user()->type === 'edit')
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('owners.create') }}" class="btn btn-primary">Add New Owner</a>
        </div>
        @endif

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
                    @if(auth()->check() && auth()->user()->type === 'edit')
                    <th>Edit</th>
                    <th>Delete</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($owners as $index => $owner)
                    <tr>
                        <td>{{ $owner->id }}</td>
                        <td>{{ $owner->name }}</td>
                        <td>{{ $owner->surname }}</td>
                        <td>{{ $owner->phone }}</td>
                        <td>{{ $owner->email }}</td>
                        <td>{{ $owner->address }}</td>
                        @if(auth()->check() && auth()->user()->type === 'edit')
                        <td>
                            <a href="{{ route('owners.edit', $owner->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                        <td>
                            <form method="post" action="{{ route('owners.destroy', $owner) }}" onsubmit="return confirm('Are you sure you want to delete this owner?');">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>@endif
                    </tr>
                @endforeach
                <div class="d-flex justify-content-between px-2">
                    <span>Number: [[Numeris]]</span>
                    <span>Email: [[Email]]</span>
                </div>
                </tbody>
            </table>
        </div>
    </div>
@endsection
