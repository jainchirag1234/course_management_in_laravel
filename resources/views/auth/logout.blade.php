<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-lg p-4 text-center mx-auto" style="max-width: 400px;">
            <h3 class="mb-4 text-danger">Are you sure you want to logout?</h3>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger w-100">Logout</button>
            </form>

            <a href="javascript:history.back()" class="btn btn-secondary w-100 mt-3">Cancel</a>
        </div>
    </div>

</body>

</html>