<!DOCTYPE html>
<html>

<head>
    <title>Student Registration</title>
    <meta charset="utf-8">
</head>

<body>
    <h2>Register as Student</h2>

    @if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('student.register') }}">
        @csrf
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Confirm Password:</label><br>
        <input type="password" name="password_confirmation" required><br><br>

        <button type="submit">Register</button>
    </form>

    <p>Already registered? <a href="{{ route('login.submit') }}">Login here</a></p>
</body>

</html>