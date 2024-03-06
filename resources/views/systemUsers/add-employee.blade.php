<x-layout> 

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
            <div class="col-md-12">
                <!-- Profile Details Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Employee Registration</h3>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST" class="p-3  rounded">
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
                                <label for="Password">Password</label>
                                <input type="password" class="form-control" name="Password" id="Password" placeholder="Password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mt-4">Create Employee</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</x-layout>
