{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <title>Login</title>
</head>
<body>
    <form action="{{ route('login') }}" method="POST">
        @csrf <!-- CSRF token is required for form submission -->
        
        <div>
            <label for="Employee_ID">Employee ID:</label>
            <input type="Employee_ID" id="Employee_ID" name="Employee_ID" required>
        </div>
        
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>
