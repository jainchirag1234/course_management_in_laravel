<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">My LMS</a>
            <div>
                <a href="{{ route('teacher.create') }}" class="btn btn-success btn-sm me-2">Add Course</a>
                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4>Your Courses</h4>
            </div>
            <div class="card-body">

                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($courses->count())
                <table class="table table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Title</th>
                            <th>Duration</th>
                            <th>Description</th>
                            <th style="width: 220px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->duration }}</td>
                            <td>{{ $course->description }}</td>
                            <td>
                                <a href="{{ route('teacher.edit', $course->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('teacher.destroy', $course->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this course?')">Delete</button>
                                </form>
                                <a href="{{ route('teacher.students', $course->id) }}" class="btn btn-info btn-sm">View Students</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="text-center">No courses added yet.</p>
                @endif

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>