<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-4">
        <h2 class="text-center">Welcome, {{ $student->name }}</h2>
        <p class="text-center text-muted">Email: {{ $student->email }}</p>

        <hr>

        <h3>🎓 Enrolled Courses</h3>
        @if($enrollments->count())
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Course Title</th>
                    <th>Description</th>
                    <th>Duration</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enrollments as $enroll)
                <tr>
                    <td>{{ $enroll->course->title }}</td>
                    <td>{{ $enroll->course->description }}</td>
                    <td>{{ $enroll->course->duration }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>No enrolled courses yet.</p>
        @endif

        <hr>

        <h3>📚 Available Courses</h3>
        @if($courses->count())
        <div class="row">
            @foreach($courses as $course)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5>{{ $course->title }}</h5>
                        <p>{{ $course->description }}</p>
                        <p><strong>Duration:</strong> {{ $course->duration }}</p>
                        <form action="{{ route('student.enroll', $course->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary btn-sm">Enroll</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p>No courses available right now.</p>
        @endif

        <hr>

        <div class="text-center mt-4">
            <a href="{{ route('logout.page') }}" class="btn btn-danger">Logout</a>
        </div>
    </div>

</body>

</html>