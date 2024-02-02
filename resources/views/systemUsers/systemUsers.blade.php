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
</x-layout>
