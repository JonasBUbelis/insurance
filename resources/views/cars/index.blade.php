@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">{{ __('Cars List')}}</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">

            @if(auth()->check() && auth()->user()->type === 'edit')
                <a href="{{ route('cars.create') }}" class="btn btn-primary">{{ __('Add New Car')}}</a>
            @else
                <div></div>
            @endif
                <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ strtoupper(app()->getLocale()) }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('Language', ['language' => 'en']) }}">{{ __('English') }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('Language', ['language' => 'lt']) }}">{{ __('Lithuanian') }}</a>
                        </li>
                    </ul>
                </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead class="table-dark">
                <tr>
                    <th>{{ __('ID')}}</th>
                    <th>{{ __('Photo')}}</th>
                    <th>{{ __('Registration Number')}}</th>
                    <th>{{ __('Brand')}}</th>
                    <th>{{ __('Model')}}</th>
                    <th>{{ __('Owner ID')}}</th>
                    @if(auth()->check() && auth()->user()->type === 'edit')
                    <th>{{ __('Edit')}}</th>
                    <th>{{ __('Delete')}}</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($cars as $car)
                    <tr>
                        <td>{{ $car->id }}</td>
                        <td>
                        @if ($car->photos->isNotEmpty())
                            <img src="{{ asset('storage/car_photos/'.$car->photos->first()->photo) }}" style="width: 100px; height: auto;">
                        @endif
                        </td>
                        <td>{{ $car->reg_number }}</td>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->owner_id }}</td>
                        @if(auth()->check() && auth()->user()->type === 'edit')
                        <td>
                            <a href="{{ route('cars.edit', $car) }}" class="btn btn-warning btn-sm">{{ __('Edit')}}</a>
                        </td>
                        <td>
                            <form method="post" action="{{ route('cars.destroy', $car) }}"
                                  onsubmit="return confirm('{{ __('Are you sure you want to delete this car?')}}');">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete')}}</button>
                            </form>
                        </td>@endif
                    </tr>
                @endforeach
                <div class="d-flex justify-content-between px-2">
                    <span>{{ __('Number')}}: [[Numeris]]</span>
                    <span>{{ __('Email')}}: [[Email]]</span>
                </div>
                </tbody>
            </table>
        </div>
    </div>
@endsection
