<!DOCTYPE html>
<html>

<head>
    <title>Students Enrolled</title>
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

        a.back {
            display: block;
            width: fit-content;
            margin: 20px auto;
            text-decoration: none;
            color: white;
            background: #007bff;
            padding: 8px 15px;
            border-radius: 5px;
        }

        a.back:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
    <h2>Students Enrolled in "{{ $course->title }}"</h2>

    @if($course->students->count() > 0)
    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Email</th>
                <th>Enrolled Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($course->students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->pivot->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="no-data">No students have enrolled in this course yet.</div>
    @endif

    <a href="{{ route('teacher.courses') }}" class="back">← Back to Courses</a>
</body>

</html>