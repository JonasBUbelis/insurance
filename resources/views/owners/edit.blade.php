<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Owner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="text-center mb-0">Edit Owner</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('update', ['owner' => $owner]) }}">
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
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $owner->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Surname</label>
                    <input type="text" class="form-control" name="surname" value="{{ $owner->surname }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" value="{{ $owner->phone }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $owner->email }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" value="{{ $owner->address }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('owners') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
