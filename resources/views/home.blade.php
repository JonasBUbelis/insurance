@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-body text-center">
                        <h1 class="mb-4">Insurance</h1>
                        <a href="{{ route('owners.index') }}" class="btn btn-primary">Check Owners</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
