<!DOCTYPE html>
<html>

<head>
    <title>My Enrolled Courses</title>
</head>

<body>
    <h2>My Enrolled Courses</h2>

    <p><a href="{{ route('student.dashboard') }}">Back to Dashboard</a></p>

    @if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
    @endif

    @if($enrollments->count() > 0)
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Course Title</th>
                <th>Description</th>
                <th>Enrolled At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enrollments as $enrollment)
            <tr>
                <td>{{ $enrollment->course->title }}</td>
                <td>{{ $enrollment->course->description }}</td>
                <td>{{ $enrollment->enrolled_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>You are not enrolled in any courses yet.</p>
    @endif
</body>

</html>