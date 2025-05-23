<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Edit Car')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="text-center mb-0">{{ __('Edit Car')}}</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('cars.update', $car)}}">
                @csrf
                @method('put')

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
                    <input type="text" name="reg_number" class="form-control" value="{{ old('reg_number', $car->reg_number) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Brand')}}</label>
                    <input type="text" name="brand" class="form-control" value="{{ old('brand', $car->brand) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Model')}}</label>
                    <input type="text" name="model" class="form-control" value="{{ old('model', $car->model) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Owner')}}</label>
                    <select name="owner_id" class="form-select">
                        @foreach($owners as $owner)
                            <option value="{{ $owner->id }}" {{ $car->owner_id == $owner->id ? 'selected' : '' }}>
                                {{ $owner->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('cars.index') }}" class="btn btn-secondary">{{ __('Cancel')}}</a>
                    <button type="submit" class="btn btn-success">{{ __('Update')}}</button>
                </div>
            </form>

            <hr>
            <form method="post" action="{{ route('photos.store', $car->id)}}" enctype="multipart/form-data" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ __('Upload Car Photo')}}</label>
                    <input type="file" name="photo" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Upload Photo')}}</button>
            </form>

            @if($car->photos && $car->photos->count())
                <h5 class="mt-4">{{ __('Existing Photos') }}</h5>
                <div class="row">
                    @foreach($car->photos as $photo)
                        <div class="col-md-3 text-center mb-3">
                            <img src="{{ asset('storage/car_photos/' . $photo->photo) }}" class="img-fluid img-thumbnail" alt={{ __('Car Photo')}}>
                            <form method="post"  class="mt-2" action="{{ route('photos.delete', $photo->id) }}"
                                  onsubmit="return confirm('{{ __('Are you sure you want to delete this car?')}}');">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete')}}</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

</body>
</html>
