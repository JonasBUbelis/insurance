<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="text-center mb-0">Edit Car</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('cars.update', $car) }}">
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
                    <label class="form-label">Registration Number</label>
                    <input type="text" name="reg_number" class="form-control" value="{{ old('reg_number', $car->reg_number) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Brand</label>
                    <input type="text" name="brand" class="form-control" value="{{ old('brand', $car->brand) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Model</label>
                    <input type="text" name="model" class="form-control" value="{{ old('model', $car->model) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Owner</label>
                    <select name="owner_id" class="form-select" required>
                        @foreach($owners as $owner)
                            <option value="{{ $owner->id }}" {{ $car->owner_id == $owner->id ? 'selected' : '' }}>
                                {{ $owner->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('cars.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
