@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">{{ __('Owners List') }}</h1>

        <div class="d-flex justify-content-between align-items-center mb-3">
            @if(auth()->check() && auth()->user()->type === 'edit')
                <a href="{{ route('owners.create') }}" class="btn btn-primary">{{ __('Add New Owner')}}</a>
            @else
                <div></div>
            @endif
            <div class="dropdown">
                <button class="btn btn-dark dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ strtoupper(app()->getLocale()) }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('Language', ['language' => 'en']) }}">{{ __('English')}}</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('Language', ['language' => 'lt']) }}">{{ __('Lithuanian')}}</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead class="table-dark">
                <tr>
                    <th>{{ __('ID')}}</th>
                    <th>{{ __('Name')}}</th>
                    <th>{{ __('Surname')}}</th>
                    <th>{{ __('Phone')}}</th>
                    <th>{{ __('Email')}}</th>
                    <th>{{ __('Address')}}</th>
                    @if(auth()->check() && auth()->user()->type === 'edit')
                    <th>{{ __('Edit')}}</th>
                    <th>{{ __('Delete')}}</th>
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
                            <a href="{{ route('owners.edit', $owner->id) }}" class="btn btn-warning btn-sm">{{ __('Edit')}}</a>
                        </td>
                        <td>
                            <form method="post" action="{{ route('owners.destroy', $owner) }}" onsubmit="return confirm('Are you sure you want to delete this owner?');">
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
