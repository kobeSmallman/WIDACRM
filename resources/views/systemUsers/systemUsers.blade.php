<x-layout>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">System Users</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Active Users Section -->
            <div class="col-md-6">
                <h3>Active Users</h3>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Position</th>
                                    <!-- Add more headers if needed -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activeEmployees as $employee)
                                    <tr>
                                        <td>{{ $employee->Employee_ID }}</td>
                                        <td>{{ $employee->First_Name }} {{ $employee->Last_Name }}</td>
                                        <td>{{ $employee->Department }}</td>
                                        <td>{{ $employee->Position }}</td>
                                        <!-- Add more data columns if needed -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
 <!-- Button to Show/Hide New Employee Form -->
 <div class="mb-3">
        <button class="btn btn-primary" onclick="toggleNewEmployeeForm()">Add New Employee</button>
    </div>

    <!-- New Employee Form -->
    <div id="newEmployeeForm" style="display: none;">
    {{-- Add this form to your view where you want to create new employees --}}
<form action="{{ route('employees.create') }}" method="POST">
    @csrf
    <input type="text" name="Employee_ID" placeholder="Employee ID" required>
    <input type="text" name="Last_Name" placeholder="Last Name" required>
    <input type="text" name="First_Name" placeholder="First Name" required>
    <input type="text" name="Department" placeholder="Department" required>
    <input type="text" name="Position" placeholder="Position" required>
    <input type="text" name="Employee_Status" placeholder="Employee Status">
    <input type="text" name="Role_ID" placeholder="Role ID">
    <input type="password" name="Password" placeholder="Password" required>
    <button type="submit">Create Employee</button>
</form>
    </div>

            <!-- Inactive Users Section -->
            <div class="col-md-6">
                <h3>Inactive Users</h3>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Position</th>
                                    <!-- Add more headers if needed -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inactiveEmployees as $employee)
                                    <tr>
                                        <td>{{ $employee->Employee_ID }}</td>
                                        <td>{{ $employee->First_Name }} {{ $employee->Last_Name }}</td>
                                        <td>{{ $employee->Department }}</td>
                                        <td>{{ $employee->Position }}</td>
                                        <!-- Add more data columns if needed -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleNewEmployeeForm() {
            var x = document.getElementById("newEmployeeForm");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
</x-layout>
