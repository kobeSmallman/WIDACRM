<x-layout>

    <div class="content-header text-center">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
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
                                    <th>Status</th>
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
                                        <td>{{ $employee->Employee_Status }}</td> 
                                        <!-- Add more data columns if needed -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- New Employee Form Section -->
            <div class="col-lg-4">
              
                    <div class="card-body">
                        <!-- Toggle button -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <button class="btn btn-sm btn-outline-primary" id="toggleFormButton">Add New Employee</button>
                        </div>
                        <!-- New Employee Form -->
                        <div id="newEmployeeForm" style="display: none;">
                            <form action="{{ route('employees.create') }}" method="POST" class="p-3 bg-light rounded">
                                @csrf
                                <div class="form-group">
                                    <label for="EmployeeID">Employee ID</label>
                                    <input type="text" class="form-control" name="Employee_ID" id="EmployeeID" placeholder="Employee ID" required>
                                </div>
                                <div class="form-group">
                                    <label for="LastName">Last Name</label>
                                    <input type="text" class="form-control" name="Last_Name" id="LastName" placeholder="Last Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="FirstName">First Name</label>
                                    <input type="text" class="form-control" name="First_Name" id="FirstName" placeholder="First Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="Department">Department</label>
                                    <input type="text" class="form-control" name="Department" id="Department" placeholder="Department" required>
                                </div>
                                <div class="form-group">
                                    <label for="Position">Position</label>
                                    <input type="text" class="form-control" name="Position" id="Position" placeholder="Position" required>
                                </div>
                                <div class="form-group">
                                    <label for="EmployeeStatus">Employee Status</label>
                                    <input type="text" class="form-control" name="Employee_Status" id="EmployeeStatus" placeholder="Employee Status">
                                </div>
                                <div class="form-group">
                                    <label for="RoleID">Role ID</label>
                                    <input type="text" class="form-control" name="Role_ID" id="RoleID" placeholder="Role ID">
                                </div>
                                <div class="form-group">
                                    <label for="Password">Password</label>
                                    <input type="password" class="form-control" name="Password" id="Password" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                    <label for="EmployeeEmail">Email</label>
                    <input type="email" class="form-control" name="Employee_Email" id="EmployeeEmail" placeholder="Employee Email" required>
                </div>
                                <button type="submit" class="btn btn-primary btn-block mt-4">Create Employee</button>
                            </form>
                        </div>
                    </div>
                </div>
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
                                    <th>Status</th> <!-- Example of a new column -->
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
                                        <td>{{ $employee->Employee_Status }}</td> <!-- Example of new data -->
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
        document.getElementById('toggleFormButton').addEventListener('click', function() {
            var form = document.getElementById("newEmployeeForm");
            if (form.style.display === "none" || form.style.display === "") {
                form.style.display = "block";
                this.textContent = "Cancel";
            } else {
                form.style.display = "none";
                this.textContent = "Add New Employee";
            }
        });
    </script>
     <style>
        .content-header h1 {
            font-size: 2.5rem;
            color: #333;
            padding: 1rem 0;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            margin-bottom: 0;
        }
        /* Additional styles for form and button */
        #toggleFormButton {
            padding: 0.375rem 0.75rem;
        }

        #newEmployeeForm {
            background-color: #f8f9fa; /* Light grey background */
            border: 1px solid #ddd; /* Border to match the color scheme */
            border-radius: 0.25rem; /* Rounded corners for the form */
        }

        .card-title {
            font-size: 1.5rem; /* Larger font size for the card title */
            color: #fff; /* White text color */
        }

        .card-header {
            background-color: #007bff; /* Color to match the layout */
        }

        .card-body {
            padding: 2rem; /* More padding for the card body */
        }

        /* Additional custom styles can be added here */
    </style>
</x-layout>
