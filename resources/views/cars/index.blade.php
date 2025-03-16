@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Cars List</h1>

        @php
            $hasOwners = \App\Models\Owners::where('user_id', Auth::id())->exists();
        @endphp
        @if (!$hasOwners)
            <div class="alert alert-danger">
                 You must have at least one owner to add a car.
                <a href="{{ route('create') }}" class="alert-link">Click here to add an owner.</a>
            </div>
        @else
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('cars.create') }}" class="btn btn-primary">Add New Car</a>
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Registration Number</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Owner ID</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cars as $car)
                    <tr>
                        <td>{{ $car->id }}</td>
                        <td>{{ $car->reg_number }}</td>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->owner_id }}</td>
                        <td>
                            <form method="post" action="{{ route('cars.destroy', $car) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
