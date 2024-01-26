{{-- resources/views/auth/register.blade.php --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <title>Register</title>
    <!-- Include any additional CSS or JS here -->
</head>
<body>
    <form action="{{ route('register') }}" method="POST">
        @csrf <!-- CSRF token is required for form submission -->
        <div>
            <label for="Employee_ID">Employee ID:</label>
            <input type="text" id="Employee_ID" name="Employee_ID" required>
        </div>
        <div>
            <label for="First_Name">First Name:</label>
            <input type="text" id="First_Name" name="First_Name" required>
        </div>

        <div>
            <label for="Last_Name">Last Name:</label>
            <input type="text" id="Last_Name" name="Last_Name" required>
        </div>
        <div>
    <label for="Department">Department:</label>
    <input type="text" id="Department" name="Department" required>
</div>
<div>
    <label for="Position">Position:</label>
    <input type="text" id="Position" name="Position" required>
</div>
<div>
    <label for="Employee_Status">Employee Status:</label>
    <input type="text" id="Employee_Status" name="Employee_Status" required>
</div>
<div>
    <label for="Role_ID">Role ID:</label>
    <input type="text" id="Role_ID" name="Role_ID" required>
</div>
<div>
    <label for="Password">Password:</label>
    <input type="Password" id="Password" name="Password" required>
</div>

        
       
        <div>
            <button type="submit">Register</button>
        </div>
    </form>
</body>
</html>
