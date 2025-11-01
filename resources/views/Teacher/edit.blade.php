<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">My LMS</a>
            <div>
                <a href="{{ route('teacher.index') }}" class="btn btn-outline-light btn-sm">Dashboard</a>
                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm ms-2">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-white">
                <h4>Edit Course</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('teacher.update', $course->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Course Title</label>
                        <input type="text" name="title" value="{{ $course->title }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" required>{{ $course->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Duration</label>
                        <input type="text" name="duration" value="{{ $course->duration }}" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success">Update Course</button>
                    <a href="{{ route('teacher.index') }}" class="btn btn-secondary ms-2">Back</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>