{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <form action="{{ route('register') }}" method="POST">
        @csrf <!-- CSRF token is required for form submission -->
        
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div>
            <button type="submit">Register</button>
        </div>
    </form>
</body>
</html>
