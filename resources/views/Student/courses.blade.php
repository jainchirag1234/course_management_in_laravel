<!DOCTYPE html>
<html>

<head>
    <title>Available Courses</title>
</head>

<body>
    <h2>Available Courses</h2>

    <p><a href="{{ route('student.dashboard') }}">Back to Dashboard</a></p>

    @if($courses->count() > 0)
    @foreach($courses as $course)
    <div style="border:1px solid #ccc; padding:10px; margin:10px;">
        <h3>{{ $course->title }}</h3>
        <p>{{ $course->description }}</p>
        <p><strong>Duration:</strong> {{ $course->duration }}</p>
        <p><strong>Teacher:</strong> {{ $course->teacher->name ?? 'N/A' }}</p>

        <form method="POST" action="{{ route('student.enroll', $course->id) }}">
            @csrf
            <button type="submit">Enroll</button>
        </form>
    </div>
    @endforeach
    @else
    <p>No courses available at the moment.</p>
    @endif
</body>

</html>