<x-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Include Bootstrap CSS from a CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include your custom register stylesheet if needed -->
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="mb-4 text-center">Registration Form</h2>
                <form action="{{ route('register') }}" method="POST" class="border p-4 shadow">
                    @csrf <!-- CSRF token is required for form submission -->
                    <div class="form-group">
                        <label for="Employee_ID">Employee ID:</label>
                        <input type="text" id="Employee_ID" name="Employee_ID" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="First_Name">First Name:</label>
                        <input type="text" id="First_Name" name="First_Name" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Last_Name">Last Name:</label>
                        <input type="text" id="Last_Name" name="Last_Name" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Department">Department:</label>
                        <input type="text" id="Department" name="Department" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Position">Position:</label>
                        <input type="text" id="Position" name="Position" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Employee_Status">Employee Status:</label>
                        <input type="text" id="Employee_Status" name="Employee_Status" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Role_ID">Role ID</label>
                        <input type="text" id="Role_ID" name="Role_ID" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Password">Password:</label>
                        <input type="password" id="Password" name="Password" required class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
</x-layout>