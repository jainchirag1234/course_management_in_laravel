<!DOCTYPE html>
<html>

<head>
    <title>Students Enrolled in {{ $course->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h2 class="mb-4">Students Enrolled in <strong>{{ $course->title }}</strong></h2>

        @if($students->isEmpty())
        <div class="alert alert-warning">No students enrolled yet.</div>
        @else
        <table class="table table-bordered bg-white">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        <a href="{{ url('/teacher/courses') }}" class="btn btn-secondary mt-3">← Back to Courses</a>
    </div>

</body>

</html>