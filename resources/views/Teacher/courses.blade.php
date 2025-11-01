<!DOCTYPE html>
<html>

<head>
    <title>Your Courses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f8f9fa;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            width: 60%;
            margin: 0 auto 30px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .no-data {
            text-align: center;
            color: gray;
            margin-top: 20px;
        }

        .success {
            text-align: center;
            color: green;
            margin-bottom: 15px;
        }

        .btn-view {
            background-color: #28a745;
            padding: 8px 12px;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-view:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <h2>Your Courses</h2>

    @if(session('success'))
    <div class="success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('teacher.courses.store') }}">
        @csrf
        <input type="text" name="title" placeholder="Course Title" required>
        <textarea name="description" placeholder="Course Description" required></textarea>
        <input type="text" name="duration" placeholder="Duration (e.g., 3 Years)" required>
        <button type="submit">Add Course</button>
    </form>

    @if(count($courses) > 0)
    <table>
        <thead>
            <tr>
                <th>Course Title</th>
                <th>Description</th>
                <th>Duration</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->title }}</td>
                <td>{{ $course->description }}</td>
                <td>{{ $course->duration }}</td>
                <td>
                    <a href="{{ route('teacher.courses.students', $course->id) }}" class="btn-view">View Students</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="no-data">No courses found.</div>
    @endif
</body>

</html>