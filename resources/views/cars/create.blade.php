@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="text-center mb-0">{{ __('Add New Car')}}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('cars.store') }}" method="POST">
                    @csrf
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">{{ __('Registration Number')}}</label>
                        <input type="text" class="form-control" name="reg_number" value="{{ old('reg_number') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('Brand')}}</label>
                        <input type="text" class="form-control" name="brand" value="{{ old('brand') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('Model')}}</label>
                        <input type="text" class="form-control" name="model" value="{{ old('model') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('Owner')}}</label>
                        <select name="owner_id" class="form-control">
                            @foreach($owners as $owner)
                                <option value="{{ $owner->id }}" {{ old('owner_id') == $owner->id ? 'selected' : '' }}>
                                    {{ $owner->id }} - {{ $owner->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('cars.index') }}" class="btn btn-secondary">{{ __('Cancel')}}</a>
                        <button type="submit" class="btn btn-success">{{ __('Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
